<?php 
	include_once('dbconnect.php');
	$query="SELECT regid, points FROM userdb ORDER BY points DESC, times";
	$res=mysqli_query($conn, $query);
	$arr=array();
	while($row=mysqli_fetch_array($res)){
		array_push($arr, $row);
	}
	echo json_encode($arr);
?>