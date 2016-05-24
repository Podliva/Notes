<?php
	$mysqli = false;
	function connectDB () {
		global $mysqli;
		$mysqli = new mysqli("localhost", "root", "", "mybase");
		$mysqli->query("SET NAMES 'utf8'");
	}
	
	function closeDB () {
		global $mysqli;
		$mysqli->close ();
	}
?>