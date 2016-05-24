<header>
	<div id="logo">
		<a href="index.php" title="Перейти на главную">
			<span>Н</span>овости
		</a>
	</div>
	<div id="menuHead">
		<a href="/about.php">
			<div style="margin-right: 5%;">О нас</div>
			</a>
			<a href="/feedback.php">
				<div>Обратная связь</div>
			</a>
			<?php if($_SESSION["user"] != 1){ echo '<a href="/create.php">';} ?>
			<?php if($_SESSION["user"] != 1){ echo '<div style="margin-left: 5%;">Добавить новость</div></a>';} ?>
			
			<?php if($_SESSION["user"] != 1){ echo '<a title="Личный кабинет" href="/room.php">'; } ?>
				<?php if($_SESSION["user"] != 1){ echo '<div style="margin-left: 5%; background-color: green;hover {background-color: #e7e7e7;}">'.$_SESSION["user"].'</div></a>';} ?>
			
	</div>
	<div id="regAuth">
		<?php if($_SESSION["user"] == 1){ echo '<a href="/registration.php">Регистрация</a> | <a href="/login.php">Авторизация</a>';}
				else {echo '<a href="/login.php">Выйти</a>';} ?>
	</div>
</header>