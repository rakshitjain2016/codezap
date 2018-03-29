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
			<a href="logout.php" class="ml-auto"><button class="btn btn-success ml-auto" type="button">Logout</button></a>
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
				<h3>Scoreboard</h3>
				<hr>
			</div>
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
		</div>
	</div>
	<div class="bg-dark p-4 text-white fixed-bottom">
		<ul class="text-muted text-center list-unstyled" style="margin-bottom:0px">
			<li>Copyright RJ Technologies</li>
			<li>This product is solely made by RJ Technologies and is customised according to the needs of Team Horizon</li>
			<li><a class="text-muted" href="https://www.linkedin.com/in/rjrakshit/"><u>Developers</u></a></li>
		</ul>
	</div>

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
</body>
</html>