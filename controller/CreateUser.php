<?php
function randomString($len)
	{
    $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0123456789";
    $validCharNumber = strlen($validCharacters);
	$randomString="";
	
    for ($i = 0; $i<$len;$i++)
	    {
	    $randomString .= $validCharacters[mt_rand(0, $validCharNumber-1)];
	    }
    return $randomString;
	}

if (isset($_POST['submit']))
	{
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['pass']);
	$mail = mysql_real_escape_string($_POST['mail']);
	if (strlen($username)<5) {return;}
	if ($mail!=$_POST['mailtwo']) {return;}
	if ($password!=$_POST['passtwo']) {return;}
	if (strlen($password)<8) {return;}
	if (!preg_match("/^\w+@(\w+.)+\w+/", $mail)) {return;}
	if (!preg_match("/^([A-Za-z]| )+$/",$username)) {return;}
	if (!preg_match("/^([A-Za-z0-9\!\-\_\,\.\?])+/",$password)) {return;}
	if (!preg_match("/([A-Z])+/",$password)) {return;}
	if (!preg_match("/([a-z])+/",$password)) {return;}
	if (!preg_match("/([0-9])+/",$password)) {return;}
	$res = mysql_query("SELECT mail FROM user WHERE mail='$mail'");
	if (!$res||mysql_num_rows($res)>0) {$mailfail=true;return;}
	mysql_query("INSERT INTO user(mail, user_name, password) ".
				"VALUES ('$mail','$username','".hash('sha256', $password)."')");
	$string = randomString(64);
	mysql_query("INSERT INTO authentication(mail, code) VALUES ('$mail','$string')");
	//Send registrerings link til bruger og henvis til side omkring successfuld oprettelse
	header("location:authenticate.php?code=$string");
	exit();
	}
?>