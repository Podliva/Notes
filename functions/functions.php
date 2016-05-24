<?php
	require_once "connect.php";
	
	function getNews ($id, $login) {
		global $mysqli;
		connectDB();
		$where = "WHERE `intro_text` = "."'".$login."'";
		if ($id) {
			$where = "WHERE `id` = ".$id;
		}
		$result = $mysqli->query("SELECT * FROM `news` $where ORDER BY `id` DESC ");
		closeDB();
		if (!$id) 
			return resultToArray ($result);
		else
			return $result->fetch_assoc();
	}
	
	function resultToArray ($result) {
		$array = array ();
		while(($row = $result->fetch_assoc()) != false) 
			$array[] = $row;
		return $array;
	}
?>