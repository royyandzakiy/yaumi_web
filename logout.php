<html>
<head>
	<link type="text/css" rel="stylesheet" href="main.css">
	<style>
	</style>
</head>
<body>
	
	<div id="head">
		<div id="header">
			<h1 class="header">Let's Blog</h1>
		</div>
	</div>
	
	<div id="nav">
		<div id="navbar">
			<div id="navopt">
				<a href ="index.php" class="nav"><span class="nav_home">&#127968;</span></a>
				<a href ="profile_pick.php" class="nav">Pick Profile</a>
				<a href ="login.php" class="nav">Login</a>
				<a href ="logout.php" class="nav">Logout</a>
				<a href ="register.php" class="nav">Register</a>
			</div>
			<div id="navuser">
				Welcome, <a class="navuser"><?php
					if (isset($_SESSION['online_name'])) {
						echo $_SESSION['online_name'];
					} else {
						echo "Guest";
					};
				?></a>
			</div>	
		</div>
	</div>

	<div id="main">
		<div id="message">
<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		echo "<br/>Logout berhasil";
		echo "<br/><a href=\"login.php\">Login</a>";
		echo "<br/><a href=\"index.php\">Home</a>";
		unset($_SESSION['logged']);
		session_destroy();
	} else {
		echo "Anda belum login";
		echo "<br/><a href=\"index.php\">Home</a>";
	};
?>
	</div>
	</div>
</body>
</html>