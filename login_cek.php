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
	require('blog_connect.php');
	sql_connect("yaumi_web");

	// sudo untuk MASUK PAKSA
	$sudo_username = "admin";
	$sudo_password = "pass";

	// ambil data yg dikirim dari login.php
	$username_cek = $_POST['username'];
	$password_cek = $_POST['password'];

	// cek jika yang diisi kosong
	if (($username_cek == "") || ($password_cek == "")) {
		echo "<br/>Username atau Password kosong, ulangi login";
		echo "<br/><a href=\"login.php\">Login</a>";
		echo "<br/><a href=\"index.php\">Home</a>";
		exit();
	};

	$query = "SELECT username, password, name FROM yaumi_web_users where username='$username_cek'";

	$result = $con->query($query);


	if ( ($sudo_username == $username_cek) && ($sudo_password == $password_cek) ) {
		// MASUK PAKSA dengan $sudo_username (debuggin purposes only)
		// Bisa dipakai jika koneksi ke DB bermasalah

		session_start();

		$_SESSION['logged'] = true;
		echo "Login berhasil <br/>";
		echo "<a href=\"index.php\">Home</a>";

	} else {
		// CARA NORMAL

		$row = $result->fetch(PDO::FETCH_NUM);

		if (!empty($row)) {
			// username yang dicari is FOUND

			if ($row[1] == $password_cek) {
				// password benar, logged in!
				session_start();
				$online_name = $row[2];

				// session stuff to be passed across pages
				$_SESSION['logged'] = true;
				$_SESSION['online_name'] = $online_name;
				$_SESSION['online_user'] = $username_cek;

				echo "Login berhasil!";
				echo "<br/><a href=\"index.php\">Home</a>";
			} else {
				// password salah
				echo "<br/>Password salah, silahkan coba lagi";
				echo "<br/><a href=\"login.php\">Login</a>";
				echo "<br/><a href=\"index.php\">Home</a>";
			};
		} else {
			// username NOT FOUND in DB
			echo "<br/>Username belum terdaftar, silahkan coba lagi";
			echo "<br/><a href=\"login.php\">Login</a>";
			echo "<br/><a href=\"index.php\">Home</a>";
		};
	};
?>
	</div>
	</div>
</body>
</html>