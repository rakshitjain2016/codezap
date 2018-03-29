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
	
	$qid=$_GET['question_id'];
	date_default_timezone_set("Asia/Kolkata");
	$starttime=mktime(22, 00, 00, 3, 19, 2018);
	$endtime=mktime(8, 00, 00, 3, 20, 2018);
	$list=time();
	$enable_btn=false;
	if($list>$starttime && $list<$endtime){
		$enable_btn=true;
	}
?>
<!doctype html>
<html>
<head>
	<title>View Challenge</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<link rel="stylesheet" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.1/ace.js" type="text/javascript" charset="utf-8"></script>	

<style type="text/css" media="screen">
#editor { 
        position: relative;
        height: 450px;
    }
</style>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.html">CODEZAP</a>
			<a href="dashboard.php" class="ml-auto"><button class="btn btn-success ml-auto" type="button">My Dashboard</button></a>
			<a href="logout.php" class="ml-2"><button class="btn btn-success ml-auto" type="button">Logout</button></a>
		</div>
	</nav>
	<div class="container my-4">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<?php q_view($qid,"challenges/");?>
			</div>
			<div class="col-lg-3 offset-lg-1 col-md-3 offset-md-1 text-right d-none d-md-block">
				<h5>Your Current Status</h5>
				<h6 id="score">Score: <?php echo $points; ?></h6>
				<h6>Number of Problems Solved: <?php echo $success; ?></h6>
				<div class="progress my-3">
					<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $successpercentage ?>%" aria-valuemin="0" aria-valuemax="100"><?php echo (round($successpercentage)."%"); ?></div>
				</div>
			</div>
		</div>
		<div class="card my-5">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 my-auto">
						<h5>Code Editor</h5>
					</div>
					<div class="col-lg-4 my-auto">
						<form>
							<div class="form-group">
							<select class="form-control" id="lang_select" onClick="mode_lang_select()">
							  <option>C</option>
							  <option>C++</option>
							  <option>C++14</option>
							  <option>Clojure</option>
							  <option>C#</option>
							  <option>Java</option>
							  <option>JavaScript</option>
							  <option>Haskell</option>
							  <option>Perl</option>
							  <option>PHP</option>
							  <option>Python</option>
							  <option>Ruby</option>
							</select>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card-body px-0 py-0">
				<div id="editor">//Write Your Code Here</div>
			</div>
			<div class="card-footer">
				<form method="" action="">
 					<div class="form-row">
						<div class="col-auto">
							   <input type="text" class="form-control" id="putbet" name="putbet" placeholder="BET ">
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 ml-auto">
							<a class="btn btn-success btn-block text-light" role="button" onClick="fileSave()" <?php if($enable_btn==false) echo "disabled"; ?>>Save</a>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 ml-2">
							<a class="btn btn-success btn-block text-light" role="button" onClick="run()" <?php if($enable_btn==false) echo "disabled"; ?>>Run</a>
						</div>
					</div>
				</form>			
			</div>
		</div>
		<div id="ERROR" class="alert alert-danger" role="alert" style="visibility:hidden"></div>
	</div>
	<div class="bg-dark p-4 text-white">
		<ul class="text-muted text-center list-unstyled" style="margin-bottom:0px">
			<li>Copyright RJ Technologies</li>
			<li>This product is solely made by RJ Technologies and is customised according to the needs of Team Horizon</li>
			<li><a class="text-muted" href="https://www.linkedin.com/in/rjrakshit/"><u>Developers</u></a></li>
		</ul>
	</div>
</body>
<script>
	/*$(window).blur(function(){
		window.location.href="logout.php";		
	});*/
	$(document).ready(function () {
		//Disable cut copy paste
		$('body').bind('cut copy paste', function (e) {
			e.preventDefault();
		});
	   
		//Disable mouse right click
		$("body").on("contextmenu",function(e){
			return false;
			});
		/*$.ajax({
			type:"GET",
			url:"chrome-extension://nkgllhigpcljnhoakjkgaieabnkmgdkb/manifest.json",
			data: {},
			success: function(response){
				console.log(response);
			}
		});*/
	});
</script>
<script>
	var editor = ace.edit("editor");
	editor.onPaste = function() { return ""; }
	$(document).ready(function(){
		editor.setTheme("ace/theme/monokai");
		$.ajax({
			type: "POST",
			url: "challengeb.php",
			data: {
				action: "modeView",
				qid: "<?php echo $qid; ?>",
				regid: "<?php echo $regid; ?>" 
			},
			success: function(response){
				document.getElementById('lang_select').value=response;
				var mode= selectMode[response];
				editor.session.setMode("ace/mode/"+mode);
				$.ajax({
					type: "POST",
					url: "challengeb.php",
					data: {
						action: "codeView",
						qid: "<?php echo $qid; ?>",
						regid: "<?php echo $regid; ?>" 
					},
					success: function(response){
						editor.setValue(response);
					}
				});
			}
		});
		document.getElementById('editor').style.fontSize='16px';

	});
	var selectMode={
		C: "c_cpp",
		"C++14": "c_cpp",
		"C++": "c_cpp",
		Clojure: "clojure",
		"C#": "csharp",
		Java: "java",
		JavaScript: "javascript",
		Haskell: "haskel",
		Perl: "perl",
		PHP: "php",
		Python: "python",
		Ruby: "ruby"
	};
	var selectLang={
		C: 1,
		"C++14": 58,
		"C++": 2,
		Clojure: 13,
		"C#": 9,
		Java: 3,
		JavaScript: 20,
		Haskell: 12,
		Perl: 6,
		PHP: 7,
		Python: 5,
		Ruby: 8
	};
	function mode_lang_select(){
		var mode_lang=$('#lang_select :selected').text();
		var mode= selectMode[mode_lang];
		var editor = ace.edit("editor");
		editor.setTheme("ace/theme/monokai");
		editor.session.setMode("ace/mode/"+mode);
		document.getElementById('editor').style.fontSize='16px';
	}
	function fileSave(){
		var x=editor.getValue();
		var mode_lang=$('#lang_select :selected').text();
		$.ajax({
			type:"POST",
			url:"challengeb.php",
			data: {
					action: "codeSave",
					x: x,
					qid: "<?php echo $qid; ?>",
					regid: "<?php echo $regid; ?>",
					mode: mode_lang
				},
			success: function(responseData){
				}
		});
	}
	function run(){
		fileSave();
		<?php 
			$query="SELECT points FROM userdb WHERE regid='$regid'";
			$res=mysqli_query($conn, $query);
			$result=mysqli_fetch_array($res);
			$points=$result['points'];
		?>
		if(document.getElementById('putbet').value <= <?php echo $points; ?> && document.getElementById('putbet').value>0){
			$.ajax({
				type:"POST",
				url: "challengeb.php",
				data:{
					action: "codeView",
					qid: "<?php echo $qid; ?>",
					regid: "<?php echo $regid; ?>" 		
				},
				success: function(responseData){
					$.ajax({
						type:"POST",
						url:"code_run.php",
						data: {
								source: responseData,
								lang:selectLang[$('#lang_select :selected').text()],
								qid: "<?php echo $qid; ?>",
								points: "<?php echo $points; ?>",
								bet: document.getElementById('putbet').value,
								regid: "<?php echo $regid; ?>"
							},
						success: function(response){
							var results=JSON.parse(response);
							if(results.flag==0){
								document.getElementById('ERROR').style.visibility="visible";
								document.getElementById('ERROR').innerHTML='<span>'+results.msg+'</span>';
								document.getElementById('score').innerHTML=results.points;
							}else{
								window.location="dashboard.php";
							}
						}
					});
				}
			});
		}
		else{
			document.getElementById('ERROR').style.visibility="visible";
			document.getElementById('ERROR').innerHTML='<span>Invalid number of points to make this bet.</span>';
		}
	}
	/*window.addEventListener('blur', function(){
		console.log('Inactive');
		setTImeout(function(){},2000);
		window.location.href("logout.php");
	});*/
</script>
</html>