<?php
	include_once 'dbconnect.php';

	function q_list_disp($regid){
		
		global $conn;
		
		$qcomplete=array();
		$qtotal=array();
		$query="SELECT qid FROM submissions WHERE regid='$regid' AND status=1";
		$res=mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($res)){
			array_push($qcomplete, $row['qid']);
		}
		$query="SELECT qid FROM questionbank";
		$res=mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($res)){
			array_push($qtotal, $row['qid']);
		}
		return array_diff($qtotal, $qcomplete);
	}
	
	function q_list($tid){
		global $conn;
		
		$qcomplete=array();
		$query="SELECT qid FROM questionbank WHERE tid='$tid'";
		$res=mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($res)){
			array_push($qcomplete, $row['qid']);
		}
		return $qcomplete;
	}
	
	function q_remove($qid,$tid){
		global $conn;
		$query="DELETE FROM questionbank WHERE qid='$qid' AND tid='$tid'";
		$res=mysqli_query($conn, $query);
		$target_dir="trainer/challenge/".$qid;
		array_map('unlink', glob("$target_dir/*.*"));
		rmdir($target_dir);
	}
	
	function q_view($qid, $target_dir){
		
		global $conn;
		$target_dir=$target_dir.$qid."/";
		$qfile=fopen($target_dir.$qid.".txt","r") or die("Unable to Open File");
		while(!feof($qfile)){
			$text=fgets($qfile);
			if($text[0]=="~"){
				$text=trim($text);
				$text=trim($text,'~');
				if($text=="Challenge Name"){
					echo "<h4 class='my-4'>".fgets($qfile)."</h4>";
				}else{
					echo "<h5 class='my-3'>$text</h5>";
				}
			}else{
				echo "<p class='my-1'>$text</p>";
			}
		}
		fclose($qfile);
	}
?>