<?php
require_once "functions/connect.php";
connectDB ();

$login = "login0";
$result = $mysqli->query("SELECT * FROM  `users`  WHERE `login` = '$login' ");
$row = $result->fetch_assoc();
echo count($row);
		
closeDB ();
?>