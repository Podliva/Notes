<?php
		session_start ();
		require_once "functions/functions.php";
		$news = getNews ($_GET["id"],$_SESSION["user"]);
		if($_SESSION["user"] != $news["intro_text"]){
			header("Location: http://mysite/index.php");
			exit;
		}
		$_SESSION["tit"] = $news["title"];
		$_SESSION["tex"] = $news["full_text"];
		$title = $news["title"];
		$ident = $news["id"];
		
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
			connectDB ();
			
			$mysqli->query("UPDATE  `mybase`.`news` SET  `title` =  '$tit | $d',`full_text` =  '$tex' WHERE  `news`.`id` =$ident;");
			$success = "Готово!";
			closeDB ();
			header("Location: http://mysite/index.php");
			exit;
		}
	}
	
	if(isset($_POST["del"])){
		connectDB ();
		
		$mysqli->query("DELETE FROM `mybase`.`news` WHERE `news`.`id` = $ident;");
		$success = "Готово!";
		closeDB ();
		header("Location: http://mysite/index.php");
			exit;
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
		
		<?php 
			
				echo '<div id=\"bigArticle\">
				<img src="/img/articles/1.jpg" alt="Статья'.$news["id"].'" title="Статья'.$news["title"].'"/>
				<h2>'.$news["title"].'</h2>
				<p>'.$news["full_text"].'</p>
				</div>';
				
		?>
	<form name="change" action="" method="post"/>
		<span style="font-size: 1em; float: left ;color: red; width: 100%; text-align: center;" ><?=$error_1 ?></span>
		<span style="font-size: 1em; float: left ;color: green; width: 100%; text-align: center;" ><?=$success ?></span>
		<input type="text" placeholder="Заголовок" id="tit" name="tit" value="<?=$_SESSION["tit"]?>" /><br />
		<textarea name="tex" id="tex" placeholder="Текст" ><?=$_SESSION["tex"]?></textarea><br />
		<input type="submit" name="exe" id="exe" value="Изменить"/>
		<input type="submit" name="del" id="del" value="Удалить"/>
		
	</form>
		</div>
		
		<?php require_once "blocks/rightCol.php" ?>
		
	</div>
	
	<?php require_once "blocks/footer.php" ?>
	
</body>
</html>
