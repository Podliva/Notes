<?php
	session_start ();
	if(isset($_POST["send"])){
		$from = htmlspecialchars ($_POST["from"]);
		$to = htmlspecialchars ($_POST["to"]);
		$subject = htmlspecialchars ($_POST["subject"]);
		$message = htmlspecialchars ($_POST["message"]);
		$_SESSION["from"] = $from;
		$_SESSION["to"] = $to;
		$_SESSION["subject"] = $subject;
		$_SESSION["message"] = $message;
		$error_from = "";
		$error_to = "";
		$error_subject = "";
		$error_message = "";
		$error = false;
		if($from == "" || !preg_match("/@/", $from)){
			$error_from = "Wrong e-mail";
			$error = true;
		}
		if($to == "" || !preg_match("/@/", $to)){
			$error_to = "Wrong e-mail";
			$error = true;
		}
		if(strlen($subject) == 0){
			$error_subject = "Wrong subject";
			$error = true;
		}
		if(strlen($message) == 0){
			$error_message = "Wrong message";
			$error = true;
		}
		if(!$error){
			$subject = "=?utf-8??B?".base64_encode($subject)."?=";
			$headers = "From: $from\r\nReply-to: $from\r\nContent-type:text/plain; charset=utf-8\r\n";
			mail ($to, $subject, $message, $headers);
			header ("Location: success.php?send=1");
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Feedback</title>
</head>
<body>
	<h2>Feedback</h2>
	<form name="feedback" action="" method="post"
		<label>From: </label><br />
		<input type="text" name="from" value="<?php echo $_SESSION["from"]?>" />
		<span style="color:red"><?=$error_from?></span>
		<br />
		<label>To: </label><br />
		<input type="text" name="to" value="<?php echo $_SESSION["to"]?>" />
		<span style="color:red"><?=$error_to?></span>
		<br />
		<label>Subject: </label><br />
		<input type="text" name="subject" value="<?php echo $_SESSION["subject"]?>" />
		<span style="color:red"><?=$error_subject?></span>
		<br /><br />
		<textarea name="message" cols="30" rows="10"><?php echo $_SESSION["message"]?></textarea>
		<span style="color:red"><?=$error_message?></span>
		<br />
		<input type="submit" name="send" value="Send" />
	</form>
</body>
</html>




if($mysqli->query("SELECT * FROM `users` WHERE `login` = $login ORDER BY `id` DESC ")){
				$error = true;
				echo "fick!";
			}

