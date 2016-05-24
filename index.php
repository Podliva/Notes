<?php
		session_start ();
		require_once "functions/functions.php";
		$title = "Новости";
		require_once "blocks/head.php";
		$news = getNews (0,$_SESSION["user"]);
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<?php require_once "blocks/header.php" ?>	
	<div id="wrapper">
		<div id="leftCol">
		
		<?php
			for ($i = 0; $i < count($news); $i++){
				if ($i == 0)
					echo "<div id=\"bigArticle\">";
				else
					echo "<div class=\"article\">";
				echo '<img src="/img/articles/1.jpg" alt="Статья 1" title="Статья 1"/>
				<h2>'.$news[$i]["title"].'</h2>
				<p>'.$news[$i]["full_text"].'</p>';
				if($_SESSION["user"] != 1){echo '<a href="/article.php?id='.$news[$i]["id"].'">
					<div class="more">Изменить</div>
				</a>';}
				echo '</div>';
				if ($i == 0) {
					echo "<div class=\"clear\"><br></div>";
				}
			}
		?>
		
		</div>
		
		<?php require_once "blocks/rightCol.php" ?>
		
	</div>
	
	<?php require_once "blocks/footer.php" ?>
	
</body>
</html>
