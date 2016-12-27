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
		if (isset($_POST['delete'])) {
			unset($_POST['delete']);

			// Hubungkan dengan database
			sql_connect('yaumi_web');

			// tambahkan escape characters pada query
			$id = $_POST['id'];
			$title = $_POST['title'];
			
			// definisikan query
			$query = "DELETE FROM yaumi_web_blog WHERE id={$id} LIMIT 1";

			// eksekusi query
			$result = $con->query($query);

			// Message Posting SUCCESS or FAIL
			if ($result) {
				echo "<br/>\"$title\" has been succesfully deleted!";
				echo "<br/>Silahkan kembali ke halaman <a href=\"admin.php\">Admin</a>";
			} else {
				echo "$title failed to DELETE";
				echo "<br/>Silahkan kembali ke halaman <a href=\"admin.php\">Admin</a>";
			};

			// KILL Connection
			$con = null;
			$result = null;

		} else {
			echo "<br/>Tidak ada data yang bisa di proses";
			echo "<br/>Silahkan kembali ke halaman <a href=\"admin.php\">Admin</a>";
		};
	} else {
		echo "Silahkan login terlebih dahulu";
		echo "<br /><a href=\"login.php\">Login</a>";
		echo "<br /><a href=\"index.php\">Home</a>";
		die();
	}
?>
	</div>
	</div>
</body>
</html>