<?php
	include('cek_logged.inc');
?>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="main.css">
	<style>
		* {
			padding:0;
			margin:0;
		}
		#login_box {
			margin:50px auto;
			padding:50px;
			border:0px solid black;
			-webkit-box-shadow:0 10px 5px rgba(0,0,0,.05);
			border-radius:20px 0;
			max-width: 200px;
			background:rgba(18, 151, 147, .5);	
		}
	</style>
</head>
<body>
	
	<!-- <div id="main"> -->
		<div id="login_box">
			<center><h2>LOGIN</h2></center><br/>
			<?php 
			if(!isset($_SESSION['logged'])){
				// Jika belum Login
			?>

			<form action="login_cek.php" method="post">
				Username : <br/><input name="username" type="text" /><br/>
				Password : <br/><input name="password" type="password" /><br/><br/>
				<input name="submit" type="submit" value="Login" />
			</form>
			<form action="register.php">
				<input type="submit" value="Register" />
			</form>
			<form action="index.php">
				<input type="submit" value="Home" />
			</form>

			<?php
			} else { // Jika sedang logged in
			?>
			Silahkan logout terlebih dahulu
			<form action="logout.php">
				<input type="submit" value="logout" />
			</form>
			<form action="index.php">
				<input type="submit" value="Home" />
			</form>
			<?php
			};
			?>
		</div>
	<!-- </div> -->

</body>
</html>