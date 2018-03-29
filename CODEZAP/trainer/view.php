<?php

	session_start();
	include_once('../questionb.php');
	if(isset($_SESSION['sessionid'])&&isset($_SESSION['tid'])){
		$sid=$_SESSION['sessionid'];
		$tid=$_SESSION['tid'];
		$query="SELECT * FROM trainer WHERE sessionid='$sid'";
		$res=mysqli_query($conn, $query);
		$count=mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		if($count==1 && $row['tid']==$tid){
			$name=$row['tname'];
		}
		else{
			header("Location:index.php");
		}
	}
	else{
		header("Location:index.php");
	}
	
	$qid=$_GET['question_id'];
?>
<!doctype html>
<html>
<head>
	<title>View Challenge</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<link rel="stylesheet" href="../css/bootstrap.css">
<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

<body>
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.html">CODEZAP</a>
			<a href="dashboard.php" class="ml-auto"><button class="btn btn-success ml-auto" type="button">My Dashboard</button></a>
			<a href="../logout.php" class="ml-2"><button class="btn btn-success ml-auto" type="button">Logout</button></a>
		</div>
	</nav>
	<div class="container my-4">
		<?php q_view($qid,"../challenges/");?>
	</div>
	<div class="bg-dark p-4 text-white fixed-bottom">
		<ul class="text-muted text-center list-unstyled" style="margin-bottom:0px">
			<li>Copyright RJ Technologies</li>
			<li>This product is solely made by RJ Technologies and is customised according to the needs of Team Horizon</li>
			<li><a class="text-muted" href="https://www.linkedin.com/in/rjrakshit/"><u>Developers</u></a></li>
		</ul>
	</div>
	
	
</body>
</html>