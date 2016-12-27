<?php 
	require('blog_connect.php'); 
	include('cek_logged.inc');
	// require('debug_isLogged.inc');
?>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="main.css">
	<style>
		#tambah {
			border: 0px;
			border-top: 1px solid rgba(0,0,0,.3);
			border-bottom: 1px solid rgba(0,0,0,.3);
			margin:30px 0px;
			padding:10px 30px;
		}
		h4.tambah {
			margin: 20px;
		}

		div.yaumi_table {
			background-color: white;
			width: 100px;
			height: 100px;
		}
		button.data_empty, button.data_nonempty {
			padding:0 5px;
			margin:2px;
			font-size:1.2em;
			border:none;
			box-shadow: 0px 2px 1px rgba(0,0,0,.2);
			border-radius: 5px;
		}
		button.data_empty:hover, button.data_nonempty:hover {
			cursor: pointer;
			margin-top: 4px;
			margin-bottom: 0px;
			box-shadow: 0px 0px 1px rgba(0,0,0,.2);
		}
		button.data_empty:hover {
			background-color: rgba(0,0,0,1);
		}
		button.data_nonempty:hover{
			background-color: rgba(255,255,255,.6);	
		}
		button.data_empty {
			background-color: rgba(0,0,0,1);
		}
		button.data_nonempty {
			background-color: rgba(255,255,255,1);
		}
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
	<!-- tampilkan data yaumi -->

	<div id="profile_pick">
	<form action="profile.php" method="post" id="pick">
			<h3>Pick
	  		<select name="name" form="pick">

		    <?php
		    /* LENGKAPI OPTION VALUE dengan NAMA*/

		    sql_connect('yaumi_web');

				// BUAT LIST SEMUA NAMA PESERTA RK 2
				$query_user = 'SELECT name, id FROM yaumi_web_users WHERE id <= 34 ORDER BY name ASC';
				$result_user = $con->query($query_user);

				if ($row_user = $result_user->fetch(PDO::FETCH_NUM)) {
					do {

						echo "<option value='" . $row_user[0] . "'>" . $row_user[0] . "</option>";

					} while ($row_user = $result_user->fetch(PDO::FETCH_NUM));
				}

				$query_user = null;
				$result_user = null;
				$con = null;
			?>

			<?php
			// ambil tanggal hari ini
			$today = date('Y-m-d');
			$mm = substr($today, 5, 2);
			$yyyy = substr($today, 0, 4);
		    ?>
		    
		    </select>
		    <!-- </datalist> -->
		    </h3>

		    <h3>Bulan
		    <input type="month" name="month" min="2016-12" max="<?php echo substr($today, 0, 7) ?>" value="<?php echo $yyyy . "-" . "$mm" ?>" />
		    </h3>
		<br/><input type="submit" value="submit" name="submit" />
	</form>

	</div>
	</div>

</body>
</html>