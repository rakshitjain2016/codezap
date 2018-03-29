<?php 
	session_start();
	include_once('questionb.php');
	if(isset($_SESSION['sessionid'])&&isset($_SESSION['regid'])){
		$sid=$_SESSION['sessionid'];
		$regid=$_SESSION['regid'];
		$query="SELECT * FROM userdb WHERE sessionid='$sid'";
		$res=mysqli_query($conn, $query);
		$count=mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		if($count==1 && $row['regid']==$regid){
			$name=$row['name'];
			$points=$row['points'];
			$success=$row['success'];
			$attempts=$row['attempts'];
			$successpercentage=($success/$attempts)*100;
		}
		else{
			header("Location:index.php");
		}
	}
	else{
		header("Location:index.php");
	}
	if(isset($_POST['btn-chng'])){
		$psw=$_POST['cpsw'];
		$repsw=$_POST['crepsw'];
		if($psw!=$repsw)
		{
			$errmsg="Re-enter the correct new password";
		}
		else{
			$password=hash('sha256', $psw);
			$query="UPDATE userdb SET password='$password' WHERE regid='$regid'";
			$res=mysqli_query($conn, $query);
			$errmsg="Password changed successfully";
		}
	}
?>
<!doctype html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<link rel="stylesheet" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.html">CODEZAP</a>
			<a href="#chngpsw" class="ml-auto" data-toggle="modal"><button class="btn btn-success ml-auto" type="button" >Change Password</button></a>
			<a href="logout.php" class="ml-2"><button class="btn btn-success ml-2" type="button">Logout</button></a>
		</div>
	</nav>
	<div class="container">
		<div class="progress my-3">
			<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $successpercentage ?>%" aria-valuemin="0" aria-valuemax="100"><?php echo $success.'/'.$attempts; ?></div>
		</div>
		<div class="row my-3">
			<h5 class="mr-auto">Hey, <?php echo $name; ?> </h5>
			<h5 id="pointnrank" class="ml-auto"></h5>
		</div>
	</div>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-8">
				<h3>Unsolved Challenges</h3>
				<hr>
				<?php 
				$q2disp=q_list_disp($regid);
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
										<div class="row">
											<p class="col-lg-5 col-md-5 col-sm-5">Success Rate: '.round(($row["qsuccess"]/$row["qattempts"])*100) .'%</p>
											<p class="col-lg-5 col-md-5 col-sm-5">Difficulty: '.$row["difficulty"].'</p>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2 my-auto">
										<a href="challenge.php?question_id='.$q.'"><button type="button" class="btn btn-success ml-auto">Solve Challenge</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>';
				}
				?>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-4">
				<div class="card border-success">
					<div class="card-body">
						<table class="table table-hover">
							<thead class="thead-light">
								<tr>
									<th scope="col">Rank</th>
									<th scope="col">Username</th>
									<th scope="col">Points</th>
								</tr>
							</thead>
							<tbody id="score">
							</tbody>
						</table>
						<a href="scoreboard.php" class="btn btn-success">View Scoreboard...</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="modal fade" id="chngpsw" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Change Password</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-10 col-md-10 col-lg-10 offset-sm-1 offset-md-1 offset-lg-1">
						<form class="needs-validation" novalidate style="margin-top:2vh;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-6 col-lg-12 offset-sm-0 offset-md-3 offset-lg-0">
									<input type="password" class="form-control" id="cpsw" placeholder="New Password" name="cpsw" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-6 col-lg-12 offset-sm-0 offset-md-3 offset-lg-0">
									<input type="password" class="form-control" id="crepsw" placeholder="Re-Enter New Password" name="crepsw" required>
								</div>
							</div>
							<div class="form-row">
								<button type="submit" class="btn btn-success btn-block col-sm-12 col-md-6 col-lg-6 offset-sm-0 offset-md-3 offset-lg-3" name="btn-chng">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="errors" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Status</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php 
						echo '<ul class="list-unstyled">';
						echo '<li>'.$errmsg.'</li>';
						echo '</ul>';
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="instructions" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Rules and Regulations</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php 
						echo '<ul class="">';
						echo '<li>At the start of the competition, you will be given 500 points.</li>';
						echo '<li>You will be able to view the unsolved challenges on the website (after logging in) and you can solve the challenges in any order. Solved challenges will no longer be visible to you.</li>';
						echo '<li>Before running your code for a particular problem, you will have to bet a certain number of points on it. The space to bet will be present at the bottom of the code area. DO NOT forget to place the bet before you submit your code. </li>';
						echo '<li>If your code passes all the test cases, your points will increase by twice the amount that you had bet on the problem. If your code fails to pass all the test cases, your points will decrease by the amount of points you had bet on the problem.
For example, if your points are 100 and you bet 30 points on a problem. If you solve the problem successfully (i.e. all test cases pass), your points will become 160. On the other hand, if your code is unsuccessful, your points will become 70.</li>';
						echo '<li>In Case that you have lost points because of an unsuccessful code, you can change your bet before you edit and re-submit the code. </li>';
						echo '<li>The SAVE option will only save your code and not validate it. In order to run your code and check it against the test cases, you have to click SUBMIT. Points will be added/deducted only if you SUBMIT the code. So be sure to SUBMIT your code and not just save it.</li>';
						echo '<li>When your points become zero or lesser, you will be eliminated from the competition.</li>';
						echo '<li>In case of any discrepancies, the decisions of Team ISTE will be final and abiding.</li>';
						echo '</ul>';
					?>
				</div>
			</div>
		</div>
	</div>
	<br><br><br><br><br>
	<div class="bg-dark p-4 text-white fixed-bottom">
		<ul class="text-muted text-center list-unstyled" style="margin-bottom:0px">
			<li>Copyright RJ Technologies</li>
			<li>This product is solely made by RJ Technologies and is customised according to the needs of Team Horizon</li>
			<li><a class="text-muted" href="https://www.linkedin.com/in/rjrakshit/"><u>Developers</u></a></li>
		</ul>
	</div>
	<?php 
			if(isset($errmsg)){ 
			echo "<script>$('#errors').modal('show');</script>";
		}
	?>
	<script>
		$(document).ready(setInterval(function getscore(){
			var val="<?php echo $regid; ?>";
			$.ajax({
				url:"scoreboard_b.php",
				data:"",
				dataType: "json",
				success:function(data){
					var i=0;
					var x="";
					var flag=0;
					if (data.length>10){
						for(i=0;i<10; i++){
							x+="<tr><th>"+(i+1)+"</th><td>"+data[i]["regid"]+"</td><td>"+data[i]["points"]+"</td></tr>"
							if(data[i]['regid']==val)
								flag=i+1;
						}
					}else{
						for(i=0;i<data.length; i++){
							x+="<tr><th>"+(i+1)+"</th><td>"+data[i]["regid"]+"</td><td>"+data[i]["points"]+"</td></tr>"
							if(data[i]['regid']==val)
								flag=i+1;
						}
					}
					if(flag==0){
						for(i=i;i<data.length;i++){
							if(data[i]['regid']==val)
								flag=i+1;
						}
					}
					document.getElementById('score').innerHTML=x;
					var y="Points : "+data[(flag-1)]['points']+" | Rank : "+flag+"";
					document.getElementById('pointnrank').innerHTML=y;
				}
			});
		},1000));
	</script>
	<script>
		$(document).ready(function(){
			$('#instructions').modal('show');
		});
	</script>
</body>
</html>