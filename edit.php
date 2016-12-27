<?php
	require('blog_connect.php');
	include('cek_logged.inc');
?> 

<html>
<head>
	<style>
	</style>
	<link type="text/css" rel="stylesheet" href="main.css">
</head>
<body>
	
	<div id="nav">
		<div id="navbar">
			<div id="navopt">
				<a href ="index.php" class="nav">Home</a>
				<a href ="admin.php" class="nav">Admin</a>
				<a href ="login.php" class="nav">Login</a>
				<a href ="logout.php" class="nav">Logout</a>
				<a href ="register.php" class="nav">Register</a>
			</div>
			<div id="navuser">
				Welcome, <a class="navuser">Royyan</a>
			</div>	
		</div>
	</div>

	<div id="main">
	
	<!-- <a href ="index.php">Home</a>
	<a href ="admin.php">Admin</a>
	<a href ="logout.php">Logout</a> -->
	<!-- tampilkan article artikel -->

	<?php
		if (!isset($_POST['edit'])) {
			// jika tombol edit TIDAK ditekan
			echo "<br/>ERROR : Gak bisa ujug2 masuk sini broh, harus lewat admin > edit";
			echo "<br/>Go Back";
		} else {
			// Benar edit ditekan
			unset($_POST['edit']);

			// ambil data
			sql_connect("yaumi_web");

			$id = $_POST['id'];

			$query = "SELECT title, user, article FROM yaumi_web_blog WHERE id='$id'";
			$result = $con->query($query);

			if ($row = $result->fetch(PDO::FETCH_NUM)) {
				$title = $row[0];
				$user = $row[1];
				$article = $row[2];
	 ?>
	
	<div id="edit">
	<form action="edit_save.php" method="post" >
		<h4>Edit Post</h4>
		Title <input type="text" name="title" size="40" maxsize="100" value="<?php echo $title; ?>" />
		| Writer : <b><?php echo $user; ?></b>
		<br/><br/><textarea name="article" cols="100" rows="25" ><?php echo $article; ?></textarea>
		<input type="hidden" value="<?php echo $id; ?>" name="id" />
		<br/><input type="submit" value="submit" name="submit" />
	</form>

	<form action="admin.php" >
		<input value="cancel" type="submit" />
	</form>
	
	</div>

	 <?php
			} else {
				echo "Tidak ada artikel untuk ditampilkan - Artkel tidak ditemukan";
			};
		
		$result = null;
		$con = null;
	};
	?>

	</div>

</body>
</html>