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

			// definarticlekan variable yg akan dikirim ke DB
			$title = $_POST['title'];
			$article = $_POST['article'];

			// bersihkan teks dengan trim()
			trim($title);
			trim($article);

			// tambahkan escape characters pada query
			$id = $_POST['id'];
			$title = addslashes($title);
			$article = addslashes($article);
			
			// definarticlekan query
			$query = "UPDATE yaumi_web_blog SET title='$title', article='$article' WHERE id={$id}";

			// eksekusi query
			$result = $con->query($query);

			// Message Posting SUCCESS or FAIL
			if ($result) {
				echo "\"<b>$title</b>\" has been succesfully edited!";
				echo "<br/>Silahkan kembali ke halaman <a href=\"admin.php\">Admin</a>";
			} else {
				echo "NEW POST failed to INSERT";
				echo "<br/>Silahkan kembali ke halaman <a href=\"admin.php\">Admin</a>";
			};

			// KILL Connection
			$con = null;
			$result = null;

		} else {
			echo "Tidak ada data yang bisa di proses";
			echo "<br/>Silahkan kembali ke halaman <a href=\"admin.php\">Admin</a>";
		};
	} else {
		echo "Silahkan login terlebih dahulu";
		echo "<br /><a href=\"login.php\">Login</a>";
		echo "<br /><a href=\"index.php\">Back</a>";
		die();
	}
?>
	</div>
	</div>
</body>
</html>