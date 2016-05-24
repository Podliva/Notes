<?php
		$title = "Личный кабинет";
		session_start ();
		$_SESSION["password1"] = "";
		$_SESSION["password2"] = "";
	
	require_once "functions/connect.php";
	if(isset($_POST["reg"])){
		$password1 = htmlspecialchars ($_POST["password1"]);
		$password2 = htmlspecialchars ($_POST["password2"]);
		$_SESSION["password1"] = $password1;
		$_SESSION["password2"] = $password2;
		$error_password = "";
		$error = false;
		if(strlen($password1) < 5){
			$error_password = "Пароль минимум 5 символов";
			$error = true;
		}
		else if(strlen($password2) == 0){
			$error_password = "Повторите пароль";
			$error = true;
		}
		else if($password2 != $password1){
			$error_password = "Неверный пароль";
			$error = true;
		}
		else{
			connectDB ();
			$user = $_SESSION["user"];
			$mysqli->query ("UPDATE  `mybase`.`users` SET  `password` =  '$password1' WHERE  `users`.`login` = '$user';");
			$success = "Готово!";
			closeDB ();
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
		<form name="registration" action="" method="post"/>
			<div>
			<span style="font-size: 2em;
							float: left;
							color: black;
							width: 100%;
							text-align: center;">Изменить пароль:</span><br /><br />
			<input type="password" placeholder="Введите новый пароль" id="password1" name="password1" value="<?=$_SESSION["password1"]?>"/><br />
			<input type="password" placeholder="Повторите пароль" id="password2" name="password2" value="<?=$_SESSION["password2"]?>"/><br />
			<input type="submit" name="reg" id="reg" value="Изменить"/><br />
			<?php echo '<span style="font-size: 1em; float: left ;color: red; width: 100%; text-align: center;" >'.$error_password.'</span>'; ?>
			<?php echo '<span style="font-size: 1em; float: left ;color: green; width: 100%; text-align: center;" >'.$success.'</span>'; ?>
			</div>
			</form>
		</div>
		
		<?php require_once "blocks/rightCol.php" ?>
		
	</div>
	
	<?php require_once "blocks/footer.php" ?>
	
</body>
</html>