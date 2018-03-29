<?php
	include_once 'dbconnect.php';

	function codeSave($data){
		$qid=$_POST['qid'];
		$regid=$_POST['regid'];
		$mode=$_POST['mode'];
		$cfile=fopen("submissions/".$qid."_".$regid.".txt", "w") or die("Unable to Open File");
		fputs($cfile, $mode);
		fputs($cfile, "\n");
		fputs($cfile, $data);
		fclose($cfile);
	}
	function codeView(){
		$qid=$_POST['qid'];
		$regid=$_POST['regid'];
		$file="submissions/".$qid."_".$regid.".txt";
		if(file_exists($file)){
			$cfile=fopen($file, "r") or die("Unable to Open File");
			$mode=fgets($cfile);
			$content=fpassthru($cfile);
			$fsize=filesize($file);
			$content=rtrim($content,($fsize-strlen($mode)));
			fclose($cfile);
			echo $content;
		}else{
			$content="//Write your code here.";
			echo $content;
		}
	}
	function modeView(){
		$qid=$_POST['qid'];
		$regid=$_POST['regid'];
		$file="submissions/".$qid."_".$regid.".txt";
		if(file_exists($file)){
			$cfile=fopen($file, "r") or die("Unable to Open File");
			$mode=fgets($cfile);
			fclose($cfile);
			$mode=rtrim($mode);
			echo $mode;
		}else{
			$mode="C";
			echo $mode;
		}
	}
	if(isset($_POST['action'])){
		switch($_POST['action']){
			case "codeSave": codeSave($_POST['x']);
			break;
			case "codeView": codeView();
			break;
			case "modeView": modeView();
			break;
		}
	}
?>