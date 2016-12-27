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
	$username_reg = $_POST['username_reg'];
	$password_reg = $_POST['password_reg'];
	$name_reg = $_POST['name_reg'];

	// cek jika USERNAME / PASS kosong
	if (($username_reg == "") || ($password_reg == "")) {
		echo "<br/>Username atau Password kosong, silahkan ulangi Registrasi";
		echo "<br/><a href=\"register.php\">Register</a>";
		echo "<br/><a href=\"index.php\">Home</a>";
		exit();
	};

	// cek jika nama kosong
	if ($name_reg == "") {
		echo "<br/>Nama tidak boleh kosong kosong, silahkan ulangi Registrasi";
		echo "<br/><a href=\"register.php\">Register</a>";
		echo "<br/><a href=\"index.php\">Home</a>";
		exit();
	};

	// cek apakah USERNAME sudah ada atau belum
	$query = "SELECT username FROM yaumi_web_users WHERE username='$username_reg'";

	$result = $con->query($query);
	
	if (!empty($row = $result->fetch(PDO::FETCH_NUM))) {
		// username sudah ada
		echo "<br/>Username telah digunakan, silahkan pilih username lain";
		echo "<br/><a href=\"login.php\">Login</a>";
		echo "<br/><a href=\"Register.php\">Register</a>";
		echo "<br/><a href=\"index.php\">Home</a>";
	} else {
		// username belum ada
		$description_reg = $_POST['description_reg'];

		// daftarkan USER
		$query = "INSERT INTO yaumi_web_users (username, password, name, description) VALUES ('$username_reg', '$password_reg', '$name_reg', '$description_reg')";

		$result = $con->query($query);

		if ($result) {
			// berhasil REGISTER
			echo "<br/>Selamat datang, <b>$name_reg</b>, anda berhasil terdaftar dengan username <b>$username_reg</b>";

			echo "<br/>silahkan lakukan Login atau kembali ke Home";
			echo "<br/><a href=\"login.php\">Login</a>";
			echo "<br/><a href=\"index.php\">Home</a>";

		} else {
			// gagal REGISTER
			echo "<br/>Maaf, terjadi kesalahan";
			echo "<br/>Registrasi gagal";
			echo "<br/><a href=\"Register.php\">Register</a>";
			echo "<br/><a href=\"index.php\">Home</a>";
		};

		$con = null;
		$result = null;
	};
?>
	</div>
	</div>
</body>
</html>