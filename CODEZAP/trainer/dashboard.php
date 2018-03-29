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
	if(isset($_POST['btn-update'])){
		$qid=$_POST['update_id'];
		header("Location: updateq.php?qid=".$qid);
	}
	if(isset($_POST['btn-remove'])){
		$qid=$_POST['remove_id'];
		q_remove($qid, $tid);
	}
?>
<!doctype html>
<html>
<head>
	<title>Dashboard</title>
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
			<a href="../logout.php" class="ml-auto"><button class="btn btn-success ml-auto" type="button">Logout</button></a>
		</div>
	</nav>
	<div class="container">
		<div class="row my-3">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<h5 class="mr-auto">Hello! Trainer <?php echo $name; ?></h5>
			</div>
		</div>
		<hr>
		<div class="row my-3">
			<div class="col-sm-12 col-md-12 col-lg-8">
				<?php 
					$q2disp=q_list($tid);
					foreach($q2disp as $q){
						$query="SELECT * FROM questionbank WHERE qid='$q'";
						$res=mysqli_query($conn, $query);
						$row=mysqli_fetch_array($res);
						echo '
						<div class="row">
							<div class="card border-success col-sm-12 col-md-12 col-lg-12 my-2">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-9 col-md-8 col-sm-8 my-auto">
											<h5 class="text-success">'.$row["qtitle"].'</h5>
											<h6 class="text-muted">Question ID: '.$q.'</h6>
											<div class="row">
												<p class="col-lg-5 col-md-5 col-sm-5">Success Rate: '.round(($row["qsuccess"]/$row["qattempts"])*100) .'%</p>
												<p class="col-lg-5 col-md-5 col-sm-5">Difficulty: '.$row["difficulty"].'</p>
											</div>
										</div>
										<div class="col-lg-1 col-md-1 col-sm-1 my-auto ml-auto mr-3">
											<a href="view.php?question_id='.$q.'"><button type="button" class="btn btn-success ml-auto">View</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>';
					}
				?>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-4">
				<div class="row mb-3 mt-2">
					<div class="col-lg-8 ml-auto">
						<a href="createq.php" class="btn btn-success btn-block">Create Challenge</a>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-lg-8 ml-auto">
						<a href="#updatecard" class="btn btn-success btn-block" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="updatecard">Update Challenge</a>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-lg-12 collapse" id="updatecard">
						<form class="form-inline float-right" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<div class="form-group">
								<input type="text" class="form-control mx-auto" id="update_id" name="update_id" placeholder="Question ID">
							</div>
							<button type="submit" name="btn-update"class="btn btn-success mx-auto">Submit</button>
						</form>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-lg-8 ml-auto">
						<a href="#removecard" class="btn btn-success btn-block" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="removecard">Delete Challenge</a>
					</div>
				</div>
				<div class="row mb-2" >
					<div class="col-lg-12 collapse" id="removecard">
						<form class="form-inline float-right" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<div class="form-group">
								<input type="text" class="form-control mx-auto" id="remove_id" name="remove_id" placeholder="Question ID">
							</div>
							<button type="submit" name="btn-remove" class="btn btn-success mx-auto">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
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