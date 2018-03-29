<?php 
//	ob_start();
	session_start();
	include_once('dbconnect.php');
	
	function generate_sessionid(){
		return sprintf('%04x%04x%04x%04x',mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff));
	}
	function generate_userid(){
		return rand(1000,9999);
	}
	
	if(isset($_SESSION['sessionid'])&& isset($_SESSION['regid'])){
		$sid=$_SESSION['sessionid'];
		$regid=$_SESSION['regid'];
		$query="SELECT regid FROM userdb WHERE sessionid='$sid'";
		$res=mysqli_query($conn, $query);
		$count=mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		if($count==1 && $row['regid']==$regid){
			header("Location:dashboard.php");
		}else{
			$sid="";
			$regid="";
			$error=true;
			$Error[6]='Multiple Login Attempts.';
		}
	}else{
		$error=false;
		if(isset($_POST['btn-login'])){
		
			$uname=trim(strtoupper($_POST['inuname']));
			$uname=strip_tags($uname);
			$uname=htmlspecialchars($uname);
			
			$psw=trim($_POST['inpsw']);
			$psw=strip_tags($psw);
			$psw=htmlspecialchars($psw);
			
			// username validation
			if (empty($uname)) {
				$error = true;
				$Error[0] = "Please enter your Username.";
			} else if (strlen($uname) != 9) {
				$error = true;
				$Error[0] = "Invalid Username";
			}else{
				$query = "SELECT regid FROM userdb WHERE regid='$uname'";
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
				$query = "SELECT regid, password FROM userdb WHERE regid='$uname'";
				$res = mysqli_query($conn, $query);
				$row=mysqli_fetch_array($res);
				$count = mysqli_num_rows($res);
				
				// if uname/pass correct it returns must be 1 row
				if( $count == 1 && strcmp($row['password'],$password)==0) {
					do{
						$sid=generate_sessionid();
						$query="SELECT sessionid FROM userdb WHERE sessionid='$sid'";
						$res=mysqli_query($conn,$query);
						if(mysqli_num_rows($res)==0){
							$flag=1;
						}
					}while($flag==0);
					$query="UPDATE userdb SET sessionid='$sid' WHERE regid='$uname'";
					$res=mysqli_query($conn, $query);
					
					$_SESSION['sessionid']=$sid;
					$_SESSION['regid']=$uname;					
					header("Location:dashboard.php");
				} else {
					$error=true;
					$Error[2] ="Invalid Credentials";
				}
			}
		}
		if(isset($_POST['btn-signup'])){
			
			$name=trim($_POST['suname']);
			$name=strip_tags($name);
			$name=htmlspecialchars($name);
			
			$uname=trim(strtoupper($_POST['srno']));
			$uname=strip_tags($uname);
			$uname=htmlspecialchars($uname);
			
			$email=trim(strtolower($_POST['semail']));
			$email=strip_tags($email);
			$email=htmlspecialchars($email);
			
			$psw=trim($_POST['spsw']);
			$psw=strip_tags($psw);
			$psw=htmlspecialchars($psw);
			
			$repsw=trim($_POST['srepsw']);
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
						
			// username validation
			if (empty($uname)) {
				$error = true;
				$Error[0] = "Please enter your Registeration ID.";
			}else if (strlen($uname) != 10) {
				$error = true;
				$Error[0] = "Invalid Registration ID";
			}else{
				$query = "SELECT status FROM registered WHERE regid='$uname'";
				$result = mysqli_query($conn,$query);
				$count = mysqli_num_rows($result);
				$stat = mysqli_fetch_array($result);
				if($count == 1 && $stat['status']==1){
					$error = true;
					$Error[0] = "Registration ID is already registered.";
				}else if($count == 0){
					$error = true;
					$Error[0] = "You are not registered";
				}
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
				
				$query="SELECT * FROM registered WHERE regid='$uname' AND emailid='$email' AND status=0";
				$result=mysqli_query($conn, $query);
				$count=mysqli_num_rows($result);
				if($count!=1){
					$error=true;
					$Error[6]="Registration ID and Email ID does not match.";
				}
				
				if($error==false){
					$query="UPDATE registered SET status=1 WHERE regid='$uname' AND emailid='$email'";
					$res=mysqli_query($conn,$query);
					
					$flag=0;
					do{
						$sid=generate_sessionid();
						$query="SELECT sessionid FROM userdb WHERE sessionid='$sid'";
						$res=mysqli_query($conn,$query);
						if(mysqli_num_rows($res)==0){
							$flag=1;
						}
					}while($flag==0);
					$flag=0;
					do{
						$regid=generate_userid();
						$regid="18HOR".$regid;
						$query="SELECT regid FROM userdb WHERE regid='$regid'";
						$res=mysqli_query($conn,$query);
						if(mysqli_num_rows($res)==0){
							$flag=1;
						}
					}while($flag==0);
					$query="INSERT INTO userdb(regid, name, emailid, password, sessionid) VALUES ('$regid', '$name', '$email', '$password', '$sid')";
					$res=mysqli_query($conn, $query);
					if($res){
						$_SESSION['sessionid']=$sid;
						$_SESSION['regid']=$regid;
						$message="Greetings from TEAM ISTE, thanks for Joining CODEZAP this HORIZON'18.
						Your Username is $regid";
						mail($email,"HORIZON CODEZAP",$message);
						header("Location: dashboard.php");
					}else{
						$Error[2] ="Something went Wrong";	
					}
				}
			}
		}
		if(isset($_POST['btn-forget'])){
			$email=$_POST['femail'];
			$query="SELECT * FROM userdb WHERE emailid='$email'";
			$res=mysqli_query($conn, $query);
			$count=mysqli_num_rows($res);
			if($count==1){
				$psw= sprintf('%04x%04x',mt_rand(0,0xffff),mt_rand(0,0xffff));
				$password=hash('sha256', $psw);
				$message="Your New Password is ".$psw;
				mail($email,"HORIZON CODEZAP",$message);
				$Error[7]="Please check your email id for new password";
				$query="UPDATE userdb SET password='$password' WHERE emailid='$email'";
				$res=mysqli_query($conn,$query);
			}else{
				$Error[7]="This Email is not registered with us";
			}
		}
	}
	date_default_timezone_set("Asia/Kolkata");
	$starttime=mktime(22, 00, 00, 3, 19, 2018);
	$list=time();
	$enable_btn=false;
	if($list>$starttime){
		$enable_btn=true;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<title>CODEZAP</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<link rel="stylesheet" href="css/bootstrap.css">
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

<body> <!--style="background-color:#343a40"-->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="index.html">CODEZAP</a>
			<button class="btn btn-success ml-auto" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" <?php if($enable_btn==false) echo "disabled"; ?>>Login</button>
		</nav>
		<div class="collapse" id="navbarToggleExternalContent">
			<div class="bg-dark p-4 text-white">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<div class="form-row justify-content-center">
						<div class="col-sm-3 col-md-3 col-lg-2">
							<input type="text" class="form-control" placeholder="Username" name="inuname">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<input type="password" class="form-control" placeholder="Password" name="inpsw">
						</div>
						<div class="col-sm-2 col-md-2 col-lg-1">
							<button type="submit" class="btn btn-success btn-block" name="btn-login">Login</button>
						</div>
					</div>
					<div class="form-row justify-content-center my-1">
						<div class="col-sm-3 col-md-3 col-lg-2 offset-sm-1 offset-md-1 offset-lg-1">
							<a class="text-muted" href="#forgetpsw" data-toggle="modal">Forgot Password</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="jumbotron  jumbotron-fluid" style="background:url('img/H1.jpg');">
			<div class="container">
				<div class="row">
					<div class="col-sm-1 col-md-1 col-lg-1 offset-md-4 offset-sm-4 offset-lg-0">
						<img src="img/hlogow.png" style="height:35vh; margin-bottom:5vh"/>
					</div>
					<div class="col-sm-9 col-md-6 col-lg-4 offset-sm-2 offset-md-3 	offset-lg-7">
						<form class="needs-validation" novalidate style="margin-top:2vh;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-6 col-lg-12 offset-sm-0 offset-md-3 offset-lg-0">
									<input type="text" class="form-control" id="suname" placeholder="Name" name="suname" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-6 col-lg-12">
									<input type="text" class="form-control" placeholder="Registration Number" name="srno" required>
								</div>
								<div class="form-group col-sm-12 col-md-6 col-lg-12">
									<input type="email" class="form-control" placeholder="Registered Email" name="semail" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-6 col-lg-12">
									<input type="password" class="form-control" placeholder="Password" name="spsw" required>
								</div>
								<div class="form-group col-sm-12 col-md-6 col-lg-12">
									<input type="password" class="form-control" placeholder="Re-Enter Password" name="srepsw" required>
								</div>
							</div>
							<div class="form-row">
								<button type="submit" class="btn btn-success btn-block col-sm-12 col-md-6 col-lg-6 offset-sm-0 offset-md-3 offset-lg-3" name="btn-signup">Sign Up</button>
							</div>
						</form>
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
								for($i=0; $i<8; $i++){
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
		<div class="modal fade" id="forgetpsw" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Forget Password</h5>
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="col-sm-10 col-md-10 col-lg-10 offset-sm-1 offset-md-1 offset-lg-1">
							<form class="needs-validation" novalidate style="margin-top:2vh;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<div class="form-row">
									<div class="form-group col-sm-12 col-md-6 col-lg-12 offset-sm-0 offset-md-3 offset-lg-0">
										<input type="text" class="form-control" id="femail" placeholder="Email ID" name="femail" required>
									</div>
								</div>
								<div class="form-row">
									<button type="submit" class="btn btn-success btn-block col-sm-12 col-md-6 col-lg-6 offset-sm-0 offset-md-3 offset-lg-3" name="btn-forget">Submit</button>
								</div>
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
				<li><a class="text-muted" href="https://www.linkedin.com/in/rjrakshit/"><u>Developer</u></a></li>
			</ul>
		</div>
		<?php 
			if($error==true){ 
			echo "<script>$('#errors').modal('show');</script>";
		}
		?>
</body>
</html>