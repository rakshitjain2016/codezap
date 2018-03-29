<?php
//Import the SDK 
require_once 'hackerrank_run_compile.php';
require_once 'dbconnect.php';

//Reading Hidden Input Files
$target_dir="challenges/".$_POST['qid']."/";
$cfile1=fopen($target_dir."input01.txt","r") or die ("Unable to Open File");
$testcase1=file_get_contents($target_dir."input01.txt");
$testcase1=rtrim($testcase1, filesize($target_dir."input01.txt"));
fclose($cfile1);
$cfile2=fopen($target_dir."input02.txt","r") or die ("Unable to Open File");
$testcase2=file_get_contents($target_dir."input02.txt");
$testcase2=rtrim($testcase2, filesize($target_dir."input02.txt"));
fclose($cfile2);

//Setting up the Hackerearth API
$hackerearth = Array(
		'client_secret' => 'hackerrank|893644-1648|9847fba2cc7dd416de690ed70c8c51504bd4507c', 
        'time_limit' => '5',   //Time Limit (MAX = 5 seconds )
        'memory_limit' => '262144'  //Memory Limit (MAX = 262144 [256 MB])
	);

//Feeding Data Into Hackerearth API
$config = Array();
$config['time']='5';	 	// Your time limit in integer and in unit seconds
$config['memory']='262144'; // Your memory limit in integer and in unit kb
$config['source']=$_POST['source'];			
$config['input']='["'.$testcase1.'", "'.$testcase2.'"]';     	//Properly Formatted Input against which you have to test your source code
$config['language']=$_POST['lang'];   

//Sending request to the API to compile and run and record JSON responses
$response = run($hackerearth,$config); // Use this $response the way you want , it consists data in PHP Array

//Checking Output
$cfile1=fopen($target_dir."output01.txt","r") or die ("Unable to Open File");
$testcase1=file_get_contents($target_dir."output01.txt");
$testcase1=rtrim($testcase1, filesize($target_dir."output01.txt"));
fclose($cfile1);
$cfile2=fopen($target_dir."output02.txt","r") or die ("Unable to Open File");
$testcase2=file_get_contents($target_dir."output02.txt");
$testcase2=rtrim($testcase2, filesize($target_dir."output02.txt"));
fclose($cfile2);

$flag=0;
if($response['result']['result']== 0){
	if(strcmp($testcase1, $response['result']['stdout'][0])==0){
		if(strcmp($testcase2, $response['result']['stdout'][1])==0){
			$flag=1;
			$msg="";
		}
		else{
			$msg="Hidden Test Cases Failed";
		}
	}
	else{
		$msg="Hidden Test Cases Failed";
	}
}else{
	$msg=utf8_decode($response['result']['compilemessage']);
}
if($flag==0){
	$points=$_POST['points']-$_POST['bet'];
	$query="UPDATE userdb SET points=$points, attempts=attempts+1 WHERE regid='".$_POST['regid']."'";
	$res=mysqli_query($conn,$query);
	$query="UPDATE questionbank SET qattempts=qattempts+1 WHERE qid='".$_POST['qid']."'";
	$res=mysqli_query($conn,$query);
	$query="INSERT INTO submissions(regid, qid, bid, status) VALUES ('".$_POST['regid']."', '".$_POST['qid']."',".$_POST['bet'].", 0)";
	$res=mysqli_query($conn, $query);
}else{
	$points=$_POST['points']+($_POST['bet']*2);
	$query="UPDATE userdb SET points=$points, attempts=attempts+1, success=success+1 WHERE regid='".$_POST['regid']."'";
	$res=mysqli_query($conn,$query);
	$query="UPDATE questionbank SET qattempts=qattempts+1, qsuccess=qsuccess+1 WHERE qid='".$_POST['qid']."'";
	$res=mysqli_query($conn,$query);
	$query="INSERT INTO submissions(regid, qid, bid, status) VALUES ('".$_POST['regid']."', '".$_POST['qid']."',".$_POST['bet'].", 1)";
	$res=mysqli_query($conn, $query);
	
}
$result=array(
	"flag" => $flag,
	"msg" => $msg,
	"points" => $points
);
echo json_encode($result);
?>