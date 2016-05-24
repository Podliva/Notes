<?php
		session_start ();
		$title = "Новая заметка";
		$_SESSION["tit"] = "";
		$_SESSION["tex"] = "";
	
	require_once "functions/connect.php";
	if(isset($_POST["exe"])){
		$_SESSION["tit"] = htmlspecialchars ($_POST["tit"]);
		$_SESSION["tex"] = htmlspecialchars ($_POST["tex"]);
		$error_1 = "";
		$error = false;
		if(strlen($_SESSION["tit"]) < 3){
			$error_1 = "Заголовок не меньше 3 символов";
			$error = true;
		}
		else if(strlen($_SESSION["tex"]) < 10){
			$error_1 = "Текст минимум 10 символов";
			$error = true;
		}
		else if(!$error){
			$d = date ("Y-m-d H:i:s");
			$tit = $_SESSION["tit"];
			$tex = $_SESSION["tex"];
			$user = $_SESSION["user"];
			connectDB ();
			
			$mysqli->query("INSERT INTO  `mybase`.`news` (
`id` ,
`title` ,
`intro_text` ,
`full_text`
)
VALUES (
NULL ,  '$tit | $d',  '$user',  '$tex'
);");
$success = "Готово!";			
			closeDB ();
			header("Location: http://mysite/index.php");
			exit;
		}
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "blocks/head.php"; ?>
	
</head>
<body>
	<?php require_once "blocks/header.php" ?>
	
	<div id="wrapper">
		<div id="leftCol">
		
	<form name="change" action="" method="post"/>
		
		<input type="text" placeholder="Заголовок" id="tit" name="tit"  value="<?=$_SESSION["tit"]?>"/><br />
		<textarea name="tex" id="tex" placeholder="Текст"><?=$_SESSION["tex"]?></textarea><br />
		<input type="submit" name="exe" id="exe" value="Добавить"/>
		<?php echo '<span style="font-size: 1em; float: left ;color: red; width: 100%; text-align: center;" >'.$error_1.'</span>'; ?>
		<?php echo '<span style="font-size: 1em; float: left ;color: green; width: 100%; text-align: center;" >'.$success.'</span>'; ?>
	</form>
		</div>
		
		<?php require_once "blocks/rightCol.php" ?>
		
	</div>
	
	<?php require_once "blocks/footer.php" ?>
	
</body>
</html>