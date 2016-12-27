<html>
<head>
	<link type="text/css" rel="stylesheet" href="main.css">
	<style>
	</style>
</head>
<body>
	
	<div id="head">
		<div id="header">
			<h1 class="header">Amalan Yaumi</h1>
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
	include('cek_logged.inc');			

	if (isset($_SESSION['logged'])) {
		if (isset($_POST['submit'])) {
			// Hubungkan dengan database
			sql_connect("yaumi_web");

			// define variable yg akan dikirim ke DB
			$nama = $_POST['name'];
			$tanggal = $_POST['tanggal'];
			if (isset($_POST['dhuha'])) $tilawah = $_POST['tilawah'];
			else $tilawah = 0;
			if (isset($_POST['dhuha'])) $jamaah = $_POST['jamaah'];
			else $jamaah = 0;
			if (isset($_POST['dhuha'])) $dhuha = $_POST['dhuha'];
			else $dhuha = 0;
			if (isset($_POST['tahajjud'])) $tahajjud = $_POST['tahajjud'];
			else $tahajjud = 0;
			if (isset($_POST['shadaqah'])) $shadaqah = $_POST['shadaqah'];
			else $shadaqah = 0;

			// FORMAT TANGGAL: Y-m-d

			// periksa apakah data sudah ada WHERE tanggal=$tanggal
			$query = "SELECT COUNT(*) FROM yaumi_data WHERE (tanggal = '$tanggal') AND (nama = '$nama')";
			$result = $con->query($query);
			if ($result->fetchColumn() == 0) {
			// INSERT: data belum ada
				$query = "INSERT INTO yaumi_data (tanggal, nama, dhuha, tilawah, jamaah, tahajjud, shadaqah) VALUES ('$tanggal', '$nama', '$dhuha', '$tilawah', '$jamaah', '$tahajjud', '$shadaqah')";
				$result = $con->query($query);

				if ($result) {
					echo "AMALAN YAUMI ". $nama ." has been succesfully posted!";
					echo "<br/>Silahkan kembali ke halaman <a href=\"index.php\">Home</a>";
					echo "<br/><br/><br/>WARNING! JANGAN REFRESH PAGE INI! <br/>nanti postnya ke INSERT lagi!";
				} else {
					echo "AMALAN YAUMI failed to INSERT";
					echo "<br/>Silahkan kembali ke halaman <a href=\"index.php\">Home</a>";
				};

			} else {
			// UPDATE: data sudah pernah ada
				$query = "UPDATE yaumi_data SET dhuha=$dhuha, tilawah=$tilawah, jamaah=$jamaah, tahajjud=$tahajjud, shadaqah=$shadaqah WHERE (tanggal = '$tanggal') AND (nama = '$nama')";
				$result = $con->query($query);

				if ($result) {
					echo "AMALAN YAUMI ". $nama ." has been succesfully udated!";
					echo "<br/>Silahkan kembali ke halaman <a href=\"index.php\">Home</a>";
					echo "<br/><br/><br/>WARNING! JANGAN REFRESH PAGE INI! <br/>nanti postnya ke INSERT lagi!";
				} else {
					echo "AMALAN YAUMI failed to INSERT";
					echo "<br/>Silahkan kembali ke halaman <a href=\"index.php\">Home</a>";
				};

			}

			// KILL Connection
			$con = null;
			$result = null;

		} else {
			echo "Tidak ada data yang bisa di proses";
			echo "<br/>Silahkan kembali ke halaman <a href=\"index.php\">Home</a>";
		};
	} else {
		echo "Silahkan login terlebih dahulu";
		echo "<br /><a href=\"login.php\">Login</a>";
		echo "<br /><a href=\"index.php\">Home</a>";
		die();
	}

	header("Location:index.php");
?>
	</div>
	</div>
</body>
</html>