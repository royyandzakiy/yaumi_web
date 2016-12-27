<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		// echo "<h3>LOGGED IN<h3>";
		// echo var_dump($_SESSION['logged']);
		echo "Selamat datang Admin";
	} else {
		// echo "<h3>NOT LOGGED IN<h3>";
	}
?>