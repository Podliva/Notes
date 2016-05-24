<?php
		session_start ();
		$_SESSION["user"] = 1;
		$_SESSION["login"] = "";
		$_SESSION["password"] = "";
		$title = "Вход";
		$success = "";
	
	require_once "functions/connect.php";
	if(isset($_POST["reg"])){
		$_SESSION["user"] = htmlspecialchars ($_POST["login"]);
		$_SESSION["password"] = htmlspecialchars ($_POST["password"]);
		$_SESSION["login"] = $_SESSION["user"];
		$error_1 = "";
		$error = false;
		if($_SESSION["user"] == 1){
			$error_1 = "Неверный логин";
			$error = true;
			$_SESSION["user"] = 1;
		}
		else if(strlen($_SESSION["user"]) < 3){
			$error_1 = "Логин минимум 3 символа";
			$error = true;
			$_SESSION["user"] = 1;
		}
		else if(strlen($_SESSION["password"]) < 5){
			$error_1 = "Пароль минимум 5 символов";
			$error = true;
			$_SESSION["user"] = 1;
		}
		else if(!$error){
			connectDB ();
			$user = $_SESSION["user"];
			$result = $mysqli->query("SELECT * FROM  `users`  WHERE `login` = '$user' ");
			$row = $result->fetch_assoc();
			if(count($row) == 0){
				$error = true;
				$_SESSION["user"] = 1;
				$error_1 = "Неверный логин";
			}
			else if($row["password"] != $_SESSION["password"]){
				$error = true;
				$_SESSION["user"] = 1;
				$error_1 = "Неверный пароль";
			}
			else{
				closeDB ();
				$success = "Готово!";
				header("Location: http://mysite/index.php");
				exit;
			}
			closeDB ();
			}
			
		}
		
	
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "blocks/head.php" ?>
</head>
<body>
	
	<?php require_once "blocks/header.php" ?>
	
	<div id="wrapper">
		<div id="leftCol">
		<form name="registration" action="" method="post"/>
			<div>
			<span style="font-size: 2em;
							float: left;
							color: black;
							width: 100%;
							text-align: center;">Войдите:</span><br /><br />
			<input type="text" placeholder="Логин" id="login" name="login" value="<?=$_SESSION["login"]?>"/><br />
			<input type="password" placeholder="Пароль" id="password" name="password" value="<?=$_SESSION["password"]?>"/><br />
			<input type="submit" name="reg" id="reg" value="Войти"/>
			<?php echo '<span style="font-size: 1em; float: left ;color: red; width: 100%; text-align: center;" >'.$error_1.'</span>'; ?>
			<?php echo '<span style="font-size: 1em; float: left ;color: green; width: 100%; text-align: center;" >'.$success.'</span>'; ?>
			</div>
			</form>
		</div>
		
		<?php require_once "blocks/rightCol.php" ?>
		
	</div>
	
	<?php require_once "blocks/footer.php" ?>
	
</body>
</html>