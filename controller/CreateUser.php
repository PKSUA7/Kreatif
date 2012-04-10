<?php
if (isset($_POST['submit']))
	{
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['pass']);
	$mail = mysql_real_escape_string($_POST['mail']);
	if ($mail!=$_POST['mailtwo']) {return;}
	if ($password!=$_POST['passtwo']) {return;}
	if (strlen($password)<8) {return;}
	if (!preg_match("/^\w+@(\w+.)+\w+/", $mail)) {return;}
	if (!preg_match("/^([A-Za-z]| )+/",$username)) {return;}
	if (!preg_match("/^([A-Za-z0-9\!\-\_\,\.\*\?])+/",$password)) {return;}
	$res = mysql_query("SELECT mail FROM user WHERE mail='$mail'");
	if (!$res||mysql_num_rows($res)>0) {return;}
	mysql_query("INSERT INTO user(mail, user_name, password) ".
				"VALUES ('$mail','$username','".hash('sha256', $password)."')");
	$_SESSION['user'] = user::getUser($mail, $password);
	header("location:index.php");
	exit();
	}
?>