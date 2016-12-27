<?php
	include('cek_logged.inc');
?>
<html>
<head>
	<title>Register</title>
	<link type="text/css" rel="stylesheet" href="main.css">
	<style>
		* {
			padding:0;
			margin:0;
		}
		/*#main {
			margin:0 auto;
			max-width:900px;
			padding:20px;
		}*/
		#register_box {
			margin:50px auto;
			padding:50px;
			border:0px solid black;
			-webkit-box-shadow:0 10px 5px rgba(0,0,0,.05);
			border-radius:20px 0;
			max-width: 400px;
			background:rgba(18, 151, 147, .5);
			
		}
	</style>
</head>
<body>
	
	<!-- <div id="main"> -->
		<div id="register_box">
			<center><h2>REGISTER</h2></center><br/>
			<?php 
			if(!isset($_SESSION['logged'])){
				// Jika belum Login
			?>

			<form action="register_cek.php" method="post">
				Username 
				<br/><input name="username_reg" type="text" /><br/>
				Password 
				<br/><input name="password_reg" type="password" /><br/>
				Name 
				<br/><input name="name_reg" type="text" /><br/>
				Short Description
				<br/><textarea name="description_reg" cols="50" rows="10"></textarea><br/>

				<br/><input name="submit" type="submit" value="Register" />

			</form>
			<form action="index.php">
				<br/><input type="submit" value="Home" />
			</form>

			<?php
			} else { 
			// Jika sedang logged in
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