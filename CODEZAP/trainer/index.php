<?php
	session_start();
	include_once('../dbconnect.php');
	
	function generate_sessionid(){
		return sprintf('%04x%04x%04x%04x',mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff));
	}
	function generate_tid(){
		return sprintf('%04x%04x',mt_rand(0,0xffff),mt_rand(0,0xffff));
	}
	
	if(isset($_SESSION['sessionid'])&& isset($_SESSION['tid'])){
		$sid=$_SESSION['sessionid'];
		$tid=$_SESSION['tid'];
		$query="SELECT tid FROM trainer WHERE sessionid='$sid'";
		$res=mysqli_query($conn, $query);
		$count=mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		if($count==1 && $row['tid']==$tid){
			header("Location:dashboard.php");
		}else{
			$sid="";
			$tid="";
			$error=true;
			$Error[6]='Multiple Login Attempts.';
		}
	}else{
		$error=false;
		if(isset($_POST['btn-login'])){
		
			$uname=trim($_POST['trainer_id']);
			$uname=strip_tags($uname);
			$uname=htmlspecialchars($uname);
			
			$psw=trim($_POST['trainer_password']);
			$psw=strip_tags($psw);
			$psw=htmlspecialchars($psw);
			
			// username validation
			if (empty($uname)) {
				$error = true;
				$Error[0] = "Please enter your Username.";
			} else if ( !filter_var($uname,FILTER_VALIDATE_EMAIL)) {
				$error = true;
				$Error[0] = "Invalid Username";
			}else{
				$query = "SELECT temail FROM trainer WHERE temail='$uname'";
				$result = mysqli_query($conn,$query);
				$count = mysqli_num_rows($result);
				if($count==0){
					$error = true;
					$Error[0] = "Provided Username is not registered. Kindly SIGNUP";
				}
			}		
		
			// password validation
			if (empty($psw)){
				$error = true;
				$Error[1] = "Please enter password.";
			}else if(strlen($psw) < 6) {
				$error = true;
				$Error[1] = "Invalid password.";
			}
			$password=hash('sha256',$psw);
			
			if( $error==false ) {
				$query = "SELECT tid, temail, password FROM trainer WHERE temail='$uname'";
				$res = mysqli_query($conn, $query);
				$row=mysqli_fetch_array($res);
				$count = mysqli_num_rows($res);
				$tid=$row['tid'];
				// if uname/pass correct it returns must be 1 row
				if( $count == 1 && strcmp($row['password'],$password)==0) {
					do{
						$sid=generate_sessionid();
						$query="SELECT sessionid FROM trainer WHERE sessionid='$sid'";
						$res=mysqli_query($conn,$query);
						if(mysqli_num_rows($res)==0){
							$flag=1;
						}
					}while($flag==0);
					$query="UPDATE trainer SET sessionid='$sid' WHERE temail='$uname'";
					$res=mysqli_query($conn, $query);
					
					$_SESSION['sessionid']=$sid;
					$_SESSION['tid']=$tid;					
					header("Location:dashboard.php");
				} else {
					$error=true;
					$Error[2] ="Invalid Credentials";
				}
			}
		}
		if(isset($_POST['btn-logup'])){
			
			$name=trim($_POST['trainer_name']);
			$name=strip_tags($name);
			$name=htmlspecialchars($name);
					
			$email=trim(strtolower($_POST['trainer_email']));
			$email=strip_tags($email);
			$email=htmlspecialchars($email);
			
			$psw=trim($_POST['trainer_psw']);
			$psw=strip_tags($psw);
			$psw=htmlspecialchars($psw);
			
			$repsw=trim($_POST['trainer_repsw']);
			$repsw=strip_tags($repsw);
			$repsw=htmlspecialchars($repsw);
			
			// name validation
			if (empty($name)) {
				$error = true;
				$Error[3] = "Please enter your Name.";
			} else if (strlen($name) < 3) {
				$error = true;
				$Error[3] = "Name must have atleast 3 characters.";
			}
			
			//basic email validation
			if ( !filter_var($email,FILTER_VALIDATE_EMAIL)) {
				$error = true;
				$Error[4] = "Please enter valid email address.";
			}
			
			// password validation
			if (empty($psw)){
				$error = true;
				$Error[1] = "Please enter password.";
			} else if(strlen($psw) < 6) {
				$error = true;
				$Error[1] = "Password must have atleast 6 characters.";
			}
			
			if (empty($repsw)){
				$error = true;
				$Error[5] = "Please re-enter password.";
			} else if(strlen($repsw) < 6 || $repsw!=$psw) {
				$error = true;
				$Error[5] = "Re-enter correct Password";
			}
			
			if($error==false){
				$password=hash('sha256', $psw);
				if($error==false){
					$flag=0;
					do{
						$sid=generate_sessionid();
						$query="SELECT sessionid FROM trainer WHERE sessionid='$sid'";
						$res=mysqli_query($conn,$query);
						if(mysqli_num_rows($res)==0){
							$flag=1;
						}
					}while($flag==0);
					
					$flag=0;
					do{
						$tid=generate_tid();
						$query="SELECT tid FROM trainer WHERE tid='$tid'";
						$res=mysqli_query($conn,$query);
						if(mysqli_num_rows($res)==0){
							$flag=1;
						}
					}while($flag==0);
					
					$query="INSERT INTO trainer(tid, tname, temail, password, sessionid) VALUES ('$tid', '$name', '$email', '$password', '$sid')";
					$res=mysqli_query($conn, $query);
					if($res){
						$_SESSION['sessionid']=$sid;
						$_SESSION['tid']=$tid;
						header("Location: dashboard.php");
					}else{
						$Error[2] ="Something went Wrong";	
					}
				}
			}
		}
	}
?>
<!doctype html>
<html>
<head>
	<title>Trainer</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<link rel="stylesheet" href="../css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.html">CODEZAP</a>
		</div>
	</nav>
	<div class="row">
		<div class="col-lg-6 col-md-8 col-sm-8 offset-lg-3 offset-md-2 offset-sm-2 my-5">
			<nav>
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="login-tab" data-toggle="tab" href="#tab-login" role="tab" aria-controls="tab-login" aria-selected="true">Login</a>
				<a class="nav-item nav-link" id="logup-tab" data-toggle="tab" href="#tab-logup" role="tab" aria-controls="tab-logup" aria-selected="false">Sign Up</a>
			  </div>
			</nav>
			<div class="tab-content border border-top-0" id="nav-tabContent">
			  <div class="tab-pane fade show active" id="tab-login" role="tabpanel" aria-labelledby="login-tab">
				<div class="row my-auto">
					<div class="col-lg-6 col-md-8 col-sm-8 offset-lg-1 offset-md-1 offset-sm-1 my-3">
						<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<div class="form-group">
								<label for="trainer_id">Trainer Username</label>
								<input type="email" class="form-control" id="trainer_id" name="trainer_id" placeholder="Enter username">
							</div>
							<div class="form-group">
								<label for="trainer_password">Password</label>
								<input type="password" class="form-control" id="trainer_password" name="trainer_password" placeholder="Enter Password">
							</div>
						  <button type="submit" name="btn-login" class="btn btn-primary">Login</button>
						</form>
					</div>
				</div>
			</div>
			  <div class="tab-pane fade" id="tab-logup" role="tabpanel" aria-labelledby="logup-tab">
				<div class="row">
					<div class="col-lg-6 col-md-8 col-sm-8 offset-lg-1 offset-md-1 offset-sm-1 my-3">
						<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<div class="form-group">
								<label for="trainer_name">Trainer Name</label>
								<input type="text" class="form-control" id="trainer_name" name="trainer_name" placeholder="Enter Name">
							</div>
							<div class="form-group">
								<label for="trainer_email">Trainer Email</label>
								<input type="email" class="form-control" id="trainer_email" name="trainer_email" placeholder="Enter Email">
							</div>
							<div class="form-group">
								<label for="trainer_psw">Password</label>
								<input type="password" class="form-control" id="trainer_psw" name="trainer_psw" placeholder="Enter Password">
							</div>
							<div class="form-group">
								<label for="trainer_repsw">Password</label>
								<input type="password" class="form-control" id="trainer_repsw" name="trainer_repsw" placeholder="Enter Password">
							</div>
						  <button type="submit" name="btn-logup" class="btn btn-primary">Sign Up</button>
						</form>
					</div>
				</div>
			  </div>
			</div>
		</div>
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
						if($error==true){
							echo '<ul class="list-unstyled">';
							for($i=0; $i<7; $i++){
								if(!empty($Error[$i])){
									echo '<li>'.$Error[$i].'</li>';
								}
							}
							echo '</ul>';
						}
					?>
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
	<?php 
			if($error==true){ 
			echo "<script>$('#errors').modal('show');</script>";
		}
	?>
</body>
</html>