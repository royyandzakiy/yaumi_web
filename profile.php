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

	<div id="profile_main">
		<div id="profile_data">
		<?php
			$profile_nama = $_POST['name'];
			echo $profile_nama;

			// ambil data dhuha, jamaah, tahajjud, tilawah, shadaqah
			// KET: 
			//   row = MAX(amalan) orang terkait
			//   row2 = MAX(amalan) SEMUA
			sql_connect('yaumi_web');

			$query = "SELECT MAX(dhuha) FROM yaumi_data WHERE nama = '$profile_nama'";
			$result = $con->query($query);

			$row = $result->fetch(PDO::FETCH_NUM);

			$query = "SELECT MAX(dhuha) FROM yaumi_data";
			$result = $con->query($query);

			$row2 = $result->fetch(PDO::FETCH_NUM);

			echo "</br>Dhuha Tersering: ";
			if ($row[0] == null) echo "-";
			else echo $row[0];

			echo"/";
			if ($row2[0] == null) echo "-";
			else echo $row2[0];

			$query = "SELECT MAX(jamaah) FROM yaumi_data WHERE nama = '$profile_nama'";
			$result = $con->query($query);

			$row = $result->fetch(PDO::FETCH_NUM);

			$query = "SELECT MAX(jamaah) FROM yaumi_data";
			$result = $con->query($query);

			$row2 = $result->fetch(PDO::FETCH_NUM);

			echo "</br>Jamaah Terbanyak: ";
			if ($row[0] == null) echo "-";
			else echo $row[0];

			echo"/";
			if ($row2[0] == null) echo "-";
			else echo $row2[0];

			$query = "SELECT MAX(tahajjud) FROM yaumi_data WHERE nama = '$profile_nama'";
			$result = $con->query($query);

			$row = $result->fetch(PDO::FETCH_NUM);

			$query = "SELECT MAX(tahajjud) FROM yaumi_data";
			$result = $con->query($query);

			$row2 = $result->fetch(PDO::FETCH_NUM);

			echo "</br>Tahajjud Tersering: ";
			if ($row[0] == null) echo "-";
			else echo $row[0]; 

			echo"/";
			if ($row2[0] == null) echo "-";
			else echo $row2[0];

			$query = "SELECT MAX(tilawah) FROM yaumi_data WHERE nama = '$profile_nama'";
			$result = $con->query($query);

			$row = $result->fetch(PDO::FETCH_NUM);

			$query = "SELECT MAX(tilawah) FROM yaumi_data";
			$result = $con->query($query);

			$row2 = $result->fetch(PDO::FETCH_NUM);

			echo "</br>Tilawah Terbanyak: ";
			if ($row[0] == null) echo "-";
			else echo $row[0]; 

			echo"/";
			if ($row2[0] == null) echo "-";
			else echo $row2[0];

			$query = "SELECT MAX(shadaqah) FROM yaumi_data WHERE nama = '$profile_nama'";
			$result = $con->query($query);

			$row = $result->fetch(PDO::FETCH_NUM);

			$query = "SELECT MAX(tilawah) FROM yaumi_data";
			$result = $con->query($query);

			$row2 = $result->fetch(PDO::FETCH_NUM);

			echo "</br>Shadaqah Tersering: ";
			if ($row[0] == null) echo "-";
			else echo $row[0]; 

			echo"/";
			if ($row2[0] == null) echo "-";
			else echo $row2[0];

			$result = null;
			$con = null;
		?>
		</div>

		<div id="profile_pick">

		<?php
			$mm = substr($_POST['month'], 5, 2);
			$yyyy = substr($_POST['month'], 0, 4);

			switch ($mm) {
				case "01" : $MM = "Jan"; break;
				case "02" : $MM = "Feb"; break;
				case "03" : $MM = "Mar"; break;
				case "04" : $MM = "Apr"; break;
				case "05" : $MM = "Mei"; break;
				case "06" : $MM = "Jun"; break;
				case "07" : $MM = "Jul"; break;
				case "08" : $MM = "Aug"; break;
				case "09" : $MM = "Sep"; break;
				case "10" : $MM = "Okt"; break;
				case "11" : $MM = "Nov"; break;
				case "12" : $MM = "Dec"; break;
			};
		
			echo $MM . "/" . $yyyy;
		?>

		<form action="profile.php" method="post">
				<input list="names" name="name" value="<?php echo $profile_nama ?>" hidden>

			    <h3>Pilih
			    <input type="month" name="month" min="2016-12" max="<?php echo substr($today, 0, 7) ?>" value="<?php echo $yyyy . "-" . $mm ?>" />
			    </h3>
			<br/><input type="submit" value="submit" name="submit" />
		</form>
		</div>

		<div id="profile_yaumiah">
			<table style="width:70%">
			  <tr>
			    <th>Tgl</th> 
			    <th>Dhuha</th>
			    <th>Tilawah</th>
			    <th>Jamaah</th>
			    <th>Tahajjud</th>
			    <th>Shadaqah</th>
			  </tr>
			  <?php
			  $today = date('Y-m-d');
			  $last_date = date("Y-m-t", strtotime($today));

			  $mm = substr($today,5,2);
			  $last_date_dd = substr($last_date,8,2);

			  sql_connect('yaumi_web');
			  $query = "SELECT tanggal, dhuha, tilawah, jamaah, tahajjud, shadaqah FROM yaumi_data WHERE DATE_FORMAT(tanggal,'%Y-%m') = '" . substr($today, 0, 7) . "' AND (nama = '$profile_nama') ORDER BY tanggal ASC";
			  $result = $con->query($query);

			  $data_max = 0;

			if ($row = $result->fetch(PDO::FETCH_NUM)) {
				do {

					$data_max = $data_max + 1;

					$data_terisi[$data_max] = $row;
					// echo var_dump($data_terisi[$data_max]) . "</br>"; // DEBUG

				} while ($row = $result->fetch(PDO::FETCH_NUM));
			}

			echo "<br/>Terisi: $data_max / $last_date_dd";

			for ($tanggal = 1, $i = 1; $tanggal <= $last_date_dd; $tanggal++) {
				if ($i <= $data_max && $tanggal == substr($data_terisi[$i][0], 8, 2)) {
					// print data
					echo "<tr>";
					echo ("<td>" . substr($data_terisi[$i][0], 8, 2) . "</td>");
					echo ("<td>" . $data_terisi[$i][1] . "</td>");
					echo ("<td>" . $data_terisi[$i][2] . "</td>");
					echo ("<td>" . $data_terisi[$i][3] . "</td>");
					echo ("<td>" . $data_terisi[$i][4] . "</td>");
					echo ("<td>" . $data_terisi[$i][4] . "</td>");
					echo "</tr>";

					$i = $i + 1;
				} else {
					// print data kosong

					echo "<tr>";
					echo ("<td>" . $tanggal . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo ("<td>" . "-" . "</td>");
					echo "</tr>";
				}
			}

			$query = null;
			$result = null;
			$con = null;

		    echo "<tr>";

		    echo "</tr>";

			?>
		</div>

	</div>
	</div>

</body>
</html>