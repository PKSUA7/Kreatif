<?php
include("controller/MainInclude.php");
if (isset($_GET['auth']) && isset($_GET['mail']))
	{
	$code = mysql_real_escape_string($_GET['auth']);
	$mail = mysql_real_escape_string($_GET['mail']);
	$res = mysql_query("SELECT code FROM authentication WHERE mail='$mail' AND code='$code'");
	if (!$res || mysql_num_rows($res)==0)
		{
		header("location:index.php");
		exit();
		}
	else
		{
		mysql_query("DELETE FROM authentication WHERE mail='$mail' AND code='$code'");
		echoStart("Kreatif - Success");
		echo "Din bruger er nu registreret og du kan logge ind med det samme!";
		echoEnd();
		exit();
		}
	}
if (isset($_GET['code']))
	{
	echoStart("Kreatif - Din kode");
	echo $_GET['code'];
	echoEnd();
	exit();
	}

header("location:index.php");
?>