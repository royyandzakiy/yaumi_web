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

	<?php
		$today_t = date("Y-m-d");

		// Perbaiki tampilan date
		$yyyy = substr($today_t, 0, 4);
		$mm = substr($today_t, 5, 2);
		$dd = substr($today_t, 8, 2);

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

		echo ("<h1>" . $dd . "/" . $mm . "</h1>");
		echo("<h3>" . $yyyy . "</h3>")

	?>

	<div id="tambah">
	<form action="new.php" method="post" id="setor">
		<h4 class="tambah">Setor Amalan</h4>
		<table style="width:200px;text-align:left;">
		  <tr>
		  	<th>Nama</th>
			<th>
	  			<select name="name" form="setor">

		    <?php
		    /* LENGKAPI OPTION VALUE dengan NAMA*/

		    sql_connect('yaumi_web');

				// BUAT LIST SEMUA NAMA PESERTA RK 2
				$query_user = 'SELECT name, id FROM yaumi_web_users WHERE id <= 34 ORDER BY name ASC';
				$result_user = $con->query($query_user);

				if ($row_user = $result_user->fetch(PDO::FETCH_NUM)) {
					do {

						echo "<option value=\"" . $row_user[0] . "\">" . $row_user[0] . "</option>";

					} while ($row_user = $result_user->fetch(PDO::FETCH_NUM));
				}

				$query_user = null;
				$result_user = null;
				$con = null;
		    ?>
		    
		    </select>
		    <!-- </datalist> --></th></tr>
		    <tr><th>Tanggal</th><th><input type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>"></th></tr>
			<tr><th>Tilawah</th><th><input type="number" name="tilawah" min="0"></th></tr>
			<tr><th>Jamaah</th><th><input type="number" name="jamaah" min="0"></th></tr>
			<tr><th>Dhuha</th><th><input type="checkbox" name="dhuha" value="1"></th></tr>
			<tr><th>Shadaqah</th><th><input type="checkbox" name="shadaqah" value="1"></th></tr>
			<tr><th>Tahajjud</th><th><input type="checkbox" name="tahajjud" value="1"></th></tr>
		</table>
		<br/><input type="submit" value="submit" name="submit" />
	</form>

	<?php

		/* COUNTER yang sudah mengisi */

	    sql_connect('yaumi_web');


		$query = "SELECT COUNT(*) FROM yaumi_data WHERE (tanggal='$today_t')";
		$result = $con->query($query);

		$count = $result->fetchColumn();

		echo "</br>Yang sudah mengisi: " . $count;

		$query = "SELECT MAX(tilawah) FROM yaumi_data";
		$result = $con->query($query);

		$row = $result->fetch(PDO::FETCH_NUM);

		echo "</br>Tilawah Terbanyak: ";
		if ($row[0] == null) echo 0;
		else echo $row[0];

		$query = null;
		$result = null;
		$con = null;

	?>

	</div>

	<div id="yaumi_table">
		<table style="width:70%">
		  <tr>
		  	<th></th>
		    <th>Nama</th> 
		    <th>Dhuha</th>
		    <th>Tilawah</th>
		    <th>Jamaah</th>
		    <th>Tahajjud</th>
		    <th>Shadaqah</th>
		  </tr>	

		<?php
		/* ISI TABEL */
			sql_connect('yaumi_web');

			// BUAT LIST SEMUA NAMA PESERTA RK 2
			$query_user = 'SELECT name, id FROM yaumi_web_users WHERE id <= 34 ORDER BY name ASC';
			$result_user = $con->query($query_user);

			$name_max = 0;

			if ($row_user = $result_user->fetch(PDO::FETCH_NUM)) {
				do {

					$name_max = $name_max + 1;

					$name_list[$name_max] = $row_user[0];
					// echo $name_list[$name_max] . "</br>"; // DEBUG

				} while ($row_user = $result_user->fetch(PDO::FETCH_NUM));
			}

			// PRINT DATA YAUMI SESUAI LIST NAMA
			$query_data = "SELECT tanggal, nama, dhuha, tilawah, jamaah, tahajjud, shadaqah FROM yaumi_data WHERE tanggal = '$today_t' ORDER BY nama ASC";
			$result_data = $con->query($query_data);

			$name_i = 1;

			if (($row_data = $result_data->fetch(PDO::FETCH_NUM)) && ($name_i <= $name_max)) {
				do {
					while ($name_list[$name_i] != $row_data[1]) {

						echo "<tr>";
						echo ("<td>" . "<button class=\"data_empty\">&#9744</button>" . "</td>");
						echo ("<td>" . $name_list[$name_i] . "</td>");
						echo ("<td>" . "-" . "</td>");
						echo ("<td>" . "-" . "</td>");
						echo ("<td>" . "-" . "</td>");
						echo ("<td>" . "-" . "</td>");
						echo ("<td>" . "-" . "</td>");
						echo "</tr>";

						$name_i++;
					}

					if ($name_list[$name_i] == $row_data[1]) {

						echo "<tr>";
						echo ("<td>" . "<button class=\"data_nonempty\" style=\"\">&#10004</button>" . "</td>");
						echo ("<td>" . $name_list[$name_i] . "</td>");
						echo ("<td>" . $row_data[2] . "</td>");
						echo ("<td>" . $row_data[3] . "</td>");
						echo ("<td>" . $row_data[4] . "</td>");
						echo ("<td>" . $row_data[5] . "</td>");
						echo ("<td>" . $row_data[6] . "</td>");
						echo "</tr>";

					} else {echo ($name_i . " ERROR TIDAK DITEMUKAN!");}

					$name_i++;

				} while (($row_data = $result_data->fetch(PDO::FETCH_NUM)) && ($name_i <= $name_max));
			} else {
				// echo ("<br>GAGAL");
			}

			if ($name_i <= $name_max) {
				do {

					echo "<tr>";
					echo ("<td>" . "<button class=\"data_empty\">&#9744</button>" . "</td>");
					echo ("<td>" . $name_list[$name_i] . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo "</tr>";

					$name_i++;

				} while ($name_i <= $name_max);
			}

			$query_data = null;
			$query_user = null;
			$result_data = null;
			$result_user = null;
			$con = null;
		?>

		</table>
	</div>

	</div>

</body>
</html>