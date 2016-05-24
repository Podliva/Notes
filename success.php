<?php
	session_start ();
	if($_GET["send"] == 1){
		echo "You send message on ".$_SESSION["to"];}
?>