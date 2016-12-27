<?php
	session_start();
	if (!isset($_SESSION['logged'])) {
		
		echo '<html>
			<head>
				<link type="text/css" rel="stylesheet" href="main.css">
				<style>
				</style>
			</head>
			<body>
				
				<div id="head">
					<div id="header">
						<h1 class="header">Let\'s Blog</h1>
					</div>
				</div>
				
				<div id="nav">
					<div id="navbar">
						<div id="navopt">
							<a href ="index.php" class="nav"><span class="nav_home">&#127968;</span></a>
							<a href ="admin.php" class="nav">Admin</a>
							<a href ="login.php" class="nav">Login</a>
							<a href ="logout.php" class="nav">Logout</a>
							<a href ="register.php" class="nav">Register</a>
						</div>
						<div id="navuser">
							Welcome, <a class="navuser">';
								if (isset($_SESSION["online_name"])) {
									echo $_SESSION["online_name"];
								} else {
									echo "Guest";
								};
							echo'</a>
						</div>	
					</div>
				</div>

				<div id="main">
					<div id="message">';
		echo "Untuk mengakses halaman Admin, silahkan login terlebih dahulu";
		echo "<br /><a href=\"login.php\">Login</a>";
		echo "<br /><a href=\"index.php\">Home</a>";
		echo '</div>
			</div>
		</body>
		</html>';
		die();
	} else {
		// echo "Selamat datang ".$_SESSION['online_name'];
	};
?>