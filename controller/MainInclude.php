<?php
include("ConnectDB.php");

function sendMail($recipient, $content, $subject)
	{
	/*$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
	//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	
	// Mail it
	mail($recipient, $subject, $content, $headers);*/
	}

include(dirname(__DIR__)."/model/user.php");
include(dirname(__DIR__)."/model/auction.php");
include(dirname(__DIR__)."/model/payment.php");
session_start();
/*$curUser = null;
if (isset($_SESSION['user']))
	{
	$curUser = $_SESSION['user'];
	}*/

include(dirname(__DIR__)."/view/MainView.php");
?>