<?php session_start (); 
$title = "Обратная связь";?>
<!DOCTYPE html>
<html>
<head>
	<?php
		require_once "blocks/head.php" 
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script>
		$(document).ready (function () {
			$("#done").click (function () {
				$('#messageShow').hide ();
				var name = $("#name").val ();
				var email = $("#email").val ();
				var subject = $("#subject").val ();
				var message = $("#message").val ();
				var fail = "";
				if (name.length < 3) fail = "Имя не меньше 3 символов";
				else if (email.split ('@').length - 1 ==0 || email.split ('.').length - 1 ==0)
					fail = "Некоректный email";
				else if (subject.length < 5)
					fail = "Тема сообщения не меньше 3 символов";
				else if (message.length < 20)
					fail = "Сообщение не меньше 20 символов";
				if (fail != "") {
					$('#messageShow').html (fail + "<div class='clear'><br></div>");
					$('#messageShow').show ();
					return false;
				}
				$.ajax ({
					url: '/ajax/feedback.php',
					type: 'POST',
					data: {'name': name, 'email': email, 'subject': subject, 'message': message},
					dataType: 'html',
					success: function (data) {
						$('#messageShow').html (data + "<div class='clear'><br></div>");
						$('#messageShow').show ();
					}
				});
			});
		});
	</script>
</head>
<body>
	
	<?php require_once "blocks/header.php" ?>
	
	<div id="wrapper">
		<div id="leftCol">
			<input type="text" placeholder="Имя" id="name" name="name"/><br />
			<input type="text" placeholder="Email" id="email" name="email"/><br />
			<input type="text" placeholder="Тема сообщения" id="subject" name="subject"/><br />
			<textarea name="message" id="message" placeholder="Сообщение"></textarea><br />
			<div id="messageShow"></div>
			<input type="button" name="done" id="done" value="Отправить"/>
		</div>
		
		<?php require_once "blocks/rightCol.php" ?>
		
	</div>
	
	<?php require_once "blocks/footer.php" ?>
	
</body>
</html>