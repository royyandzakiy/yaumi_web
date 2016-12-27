<?php 
	require('blog_connect.php'); 
	include('only_logged.inc');

	// require('debug_isLogged.inc');
?>
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
	<!-- tampilkan isi artikel -->

	<?php
		sql_connect("yaumi_web");

		$query = 'SELECT title, user, created, article, id FROM yaumi_web_blog ORDER BY created DESC';
		$result = $con->query($query); 

		// jangan cek $result, karena pasti ada isinya, yaitu PDO Object berupa query
		// ceklah $row, belum tentu ada isinya, klo data yg diinginkan tidak ada, maka $row = null

		if ($row = $result->fetch(PDO::FETCH_NUM)) {
			do {
				$title = $row[0];
				$user = $row[1];
				$date = (string) $row[2];
				$article = $row[3];
				$id = $row[4];

				// Perbaiki tampilan date
				$yy = substr($date, 0, 4);
				$mm = substr($date, 5, 2);
				$dd = substr($date, 8, 2);
				$hour = substr($date, 11, 2);
				$min = substr($date, 14, 2);

				// tampilkan nama BULAN
				switch ($mm) {
					case "01" : $mm = "Jan"; break;
					case "02" : $mm = "Feb"; break;
					case "03" : $mm = "Mar"; break;
					case "04" : $mm = "Apr"; break;
					case "05" : $mm = "Mei"; break;
					case "06" : $mm = "Jun"; break;
					case "07" : $mm = "Jul"; break;
					case "08" : $mm = "Aug"; break;
					case "09" : $mm = "Sep"; break;
					case "10" : $mm = "Okt"; break;
					case "11" : $mm = "Nov"; break;
					case "12" : $mm = "Dec"; break;
				};

				$created = $dd . " " . $mm . " " . $yy;

				// SELECT nama USER
				$query2 = "SELECT name FROM yaumi_web_users WHERE username='$user'";
				$result2 = $con->query($query2);

				$row2 = $result2->fetch(PDO::FETCH_NUM);
				$name = $row2[0];
	 ?>
	
	<article>
		<h1 class="article"><?php echo "// " . $title ?></h1>
		<h6 class="article">By <?php echo $name ?> | <?php echo $created ?></h6>
		<p class="article"><?php echo $article ?></p>
		
		<form action="edit.php" method="post" class="edit">
			<input value="<?php echo $id; ?>" type="hidden" name="id" />
			<input type="submit" value="Edit" name="edit" />			
		</form>

		<form action="delete.php" method="post" class="edit">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="title" value="<?php echo $title; ?>" />
			<input type="submit" value="Delete" name="delete" />
		</form>
	</article>

	 <?php
			} while ($row = $result->fetch(PDO::FETCH_NUM));
		} else {
			echo "<br/><br/>Tidak ada artikel untuk ditampilkan";
		};
	
	$result = null;
	$result2 = null;
	$con = null;
	?>

	<div id="tambah">
	<form action="new.php" method="post">
		<h4 class="tambah">New Post</h4>
		Title <input type="text" name="title" size="40" maxsize="100" />
		<!-- User : <input type="text" name="user" size="40" maxsize="100" /> -->
		<br/><br/><textarea name="article" cols="100" rows="12"> </textarea>
		<br/><input type="submit" value="submit" name="submit" />
	</form>
	</div>

	</div>

</body>
</html>