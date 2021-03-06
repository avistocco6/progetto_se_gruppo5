<!DOCTYPE HTML>
<html>
<head>
	<title> Home Page </title>
	<meta charset="utf-8"/>
	<meta name="author" content="Team 5"/>
	<meta name="description" content="Web application for maintenance activies."/>
	<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
	<link rel="stylesheet" type="text/css" href="login.css"/>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="header">
		</div> 
		<div class="header">
			<h1> Home Page </h1>
		</div> 
		<div class="header">
		</div> 
	</div>    
	<div class="column" style="text-align: center;">
		<img onclick="document.getElementById('id01').style.display='block'" style="width:auto; margin-top:80px;" src="icon1.png" width="150" height="150">
		<h1>Click on the icon to login as a System Administrator or as a Planner.</h1>
	</div>	
	<div id="id01" class="modal">
		
		<form class="modal-content animate" method="post">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
			<div class="container">
				<p>
					<label for="role" style="text-align: center;"><b>Role: </b></label>
					<select onchange="showbutton()" name="role" id="role">
						<option value="-" selected="selected">-</option>
						<option value="systemadmin">System Admnistrator</option>
						<option value="planner">Planner</option>
					</select>
				</p>
				<br>
				<label for="username"><b>Username</b></label>
				<input type="username" placeholder="Enter Username" name="username" >

				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" >
				
				<button type="submit">Login</button>
				
			</form>
			<button id="sysadmin" style="display: none;"><a href="addsystemadmin.php">New System Administrator</a></button>
		</div>
	</div>
	<?php
	include_once '..\PgConnection.php';
	session_start();
	if(!empty($_POST)){
		$connector = new PgConnection();
		$conn = $connector->connect();

		if($conn == null) {
			return false;
		}
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT pass, clientrole FROM Client WHERE username = $1;";
			$prep = pg_prepare($conn, 'loginuser', $sql);
			$ret = pg_execute($conn, "loginuser", array($username));
			if (!$ret) {
				echo "Errore query";
			}
			else{
				$row = pg_fetch_array($ret);
				$pass = $row["pass"];
				$role = $row["clientrole"];
				if ($pass==$password) {
					if ($role=='planner') {
						$_SESSION['username'] = $username;
						$message="welcome planner $username";
						echo "<script>alert('$message');
						window.location.replace('plannerview.php');
						</script";
					}
					else{
						$_SESSION['username'] = $username;
						$message="welcome sysadmin $username";
						echo "<script>alert('$message');
						window.location.replace('managedb.php');
						</script";
					}
				}
			}
		}
	}
	?>
	<div class="footer" style="position: absolute;">
		<h2>Team 5</h2>
	</div>
</body>
<script>
	function showbutton(){

		var x = document.getElementById("role").selectedIndex;
		var y = document.getElementsByTagName("option")[x].value;
		if(y=='systemadmin'){
			document.getElementById('sysadmin').style.display="block";
		}
		else{
			document.getElementById('sysadmin').style.display="none";
		}
	}

</script>

</html>    