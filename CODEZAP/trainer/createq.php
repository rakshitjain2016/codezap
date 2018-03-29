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
	$uploadOk=1;
	include_once('create_b.php');
?>
<html>
<head>
	<title>Create Challenge</title>
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
		<h3 class="mt-4 mb-3">Create Challenge</h3>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
			<div class="form-group row">
				<label for="challengeName" class="col-sm-2 col-form-label">Challenge Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="challengeName" name="challengeName">
				</div>
			</div>
			<div class="form-group row">
				<label for="prblmstmt" class="col-sm-2 col-form-label">Problem Statement</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="prblmstmt" name="prblmstmt" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputfrmt" class="col-sm-2 col-form-label">Input Format</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="inputfrmt" name="inputfrmt" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="outputfrmt" class="col-sm-2 col-form-label">Output Format</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="outputfrmt" name="outputfrmt" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="constraints" class="col-sm-2 col-form-label">Constraints</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="constraints" name="constraints" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="samplein" class="col-sm-2 col-form-label">Sample Input</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="samplein" name="samplein" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="sampleout" class="col-sm-2 col-form-label">Sample Output</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="sampleout" name="sampleout" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="difficulty" class="col-sm-2 col-form-label">Difficulty</label>
				<div class="col-sm-10">
					<select class="form-control" id="difficulty" name="difficulty">
					  <option>Easy</option>
					  <option>Medium</option>
					  <option>Hard</option>
					  <option>Very Hard</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="input01" class="col-sm-2 col-form-label">Input File 1</label>
				<div class="col-sm-4">
					<input type="file" class="form-control-file" id="input01" name="input01">
				</div>
				<label for="output01" class="col-sm-2 col-form-label">Output File 1</label>
				<div class="col-sm-4">
					<input type="file" class="form-control-file" id="output01" name="output01">
				</div>
			</div>
			<div class="form-group row">
				<label for="input02" class="col-sm-2 col-form-label">Input File 2</label>
				<div class="col-sm-4">
					<input type="file" class="form-control-file" id="input02" name="input02">
				</div>
				<label for="output02" class="col-sm-2 col-form-label">Output File 2</label>
				<div class="col-sm-4">
					<input type="file" class="form-control-file" id="output02" name="output02">
				</div>
			</div>
			<div class="row">
				<button type="submit" class="btn btn-success offset-sm-6" name="btn-submit" id="btn-submit">Submit</button>
			</div>
		</form>
	</div>
	<div class="modal fade" id="errors" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Error</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php 
						if($uploadOk==0){
							echo '<ul class="list-unstyled">';
							for($i=0; $i<5; $i++){
								if(!empty($Error[$i])){
									echo '<li class="my-2">'.$Error[$i].'</li>';
								}
							}
							echo '</ul>';
						}
					?>
				</div>
			</div>
		</div>
	</div>	
	<div class="bg-dark p-4 text-white">
		<ul class="text-muted text-center list-unstyled" style="margin-bottom:0px">
			<li>Copyright RJ Technologies</li>
			<li>This product is solely made by RJ Technologies and is customised according to the needs of Team Horizon</li>
			<li><a class="text-muted" href="https://www.linkedin.com/in/rjrakshit/"><u>Developers</u></a></li>
		</ul>
	</div>
	<?php 
			if($uploadOk==0){ 
			echo "<script>$('#errors').modal('show');</script>";
		}
	?>
</body>
</html>