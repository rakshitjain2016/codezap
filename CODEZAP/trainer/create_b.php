<?php
	function generate_qid(){
		return sprintf('%04x%04x',mt_rand(0,0xffff),mt_rand(0,0xffff));
	}
	if(isset($_POST['btn-submit'])){
		$challengeName=$_POST['challengeName'];
		$prblmstmt=$_POST['prblmstmt'];
		$inputfrmt=$_POST['inputfrmt'];
		$outputfrmt=$_POST['outputfrmt'];
		$constraints=$_POST['constraints'];
		$samplein=$_POST['samplein'];
		$sampleout=$_POST['sampleout'];
		$difficulty=$_POST['difficulty'];
		
		$uploadOk=1;
		if(empty($challengeName) || empty($prblmstmt) || empty($inputfrmt) || empty($outputfrmt) || empty($constraints) || empty($samplein) || empty($sampleout)){
			$uploadOk=0;
			$Error[4]="All are required fields.";
		}
		$flag=0;
		do{
			$qid=generate_qid();
			$query="SELECT qid FROM questionbank WHERE qid='$qid'";
			$res=mysqli_query($conn,$query);
			if(mysqli_num_rows($res)==0){
				$flag=1;
			}
		}while($flag==0);
		
		$target_dir="../challenges/".$qid."/";
		mkdir($target_dir);
		
		if($uploadOk==1){
			
			$qfile=fopen($target_dir.$qid.".txt","w") or die("Unable to Open File");
			$txt="~Challenge Name~";
			fputs($qfile, $txt);
			fputs($qfile,"\n");
			fputs($qfile, $challengeName);
			fputs($qfile,"\n");
			$txt="~Problem Statement~";
			fputs($qfile, $txt);
			fputs($qfile,"\n");
			fputs($qfile, $prblmstmt);
			fputs($qfile,"\n");
			$txt="~Input Format~";
			fputs($qfile, $txt);
			fputs($qfile,"\n");
			fputs($qfile, $inputfrmt);
			fputs($qfile,"\n");
			$txt="~Output Format~";
			fputs($qfile, $txt);
			fputs($qfile,"\n");
			fputs($qfile, $outputfrmt);
			fputs($qfile,"\n");
			$txt="~Constraints~";
			fputs($qfile, $txt);
			fputs($qfile,"\n");
			fputs($qfile, $constraints);
			fputs($qfile,"\n");
			$txt="~Sample Input~";
			fputs($qfile, $txt);
			fputs($qfile,"\n");
			fputs($qfile, $samplein);
			fputs($qfile,"\n");
			$txt="~Sample Output~";
			fputs($qfile, $txt);
			fputs($qfile,"\n");
			fputs($qfile, $sampleout);
			fputs($qfile,"\n");
			fclose($qfile);
		}	
		//upload testcase files
		$file_name_array=array("input01","output01","input02","output02");
		for($i=0; $i<4 && $uploadOk==1; $i++){
			$target_file=$target_dir.$file_name_array[$i].".txt";
			$docType=strtolower(pathinfo($_FILES[$file_name_array[$i]]["name"], PATHINFO_EXTENSION));
			if($_FILES[$file_name_array[$i]]["size"] > 2*1024*1024){
				
				$uploadOk=0;
				$Error[0]=basename($_FILES[$file_name_array[$i]]["name"])." is too large. It should be less than 2MB.";
			}else if($_FILES[$file_name_array[$i]]["size"] == 0){
				$Error[0]="It is mandatory to upload 2 Input Files and 2 Output Files.";
			}
			if($docType!="txt"){
				$uploadOk=0;
				$Error[1]="Only files with extension as .txt are allowed.";
			}
			if($uploadOk==1){
				if (move_uploaded_file($_FILES[$file_name_array[$i]]["tmp_name"], $target_file)) {
				} else {
					$Error[2]="Sorry, there was an error uploading your file.";
				}
			}
		}
		if($uploadOk==0){
			array_map('unlink', glob("$target_dir/*.*"));
			rmdir($target_dir);
		}else{
			$query="INSERT INTO questionbank(qid,qtitle,difficulty,tid) VALUES('$qid', '$challengeName', '$difficulty', '$tid')";
			$res=mysqli_query($conn, $query);
			if($res){
				header("Location:dashboard.php");
			}else{
				$uploadOk=0;
				$Error[3]="Sorry there was an error uploading the challenge. Please Try Again.";
				array_map('unlink', glob("$target_dir/*.*"));
				rmdir($target_dir);
			}
		}
	}
?>