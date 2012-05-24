<?php
if (!isset($_GET['auctionid']))
	{
	header("location:../index.php");
	exit();
	}
include("MainInclude.php");
$auction = mysql_real_escape_string($_GET['auctionid']);
if (isset($_SESSION['user']))
	{
	mysql_query("START TRANSACTION");
	mysql_query("LOCK TABLES bid WRITE");
	$bid = mysql_real_escape_string($_POST['bidchoice']);
	$res = mysql_query("SELECT amount FROM bid WHERE amount>='$bid' AND auction_id='$auction'");
	if (mysql_num_rows($res)>0)
		{
		mysql_query("UNLOCK TABLES");
		header("location:../error.php?error=2&auctionid=$auction");
		exit();
		}
	$res = mysql_query("INSERT INTO bid(mail, amount, auction_id)".
				" VALUES ('".$_SESSION['user']->getMail()."','$bid','$auction')");
	if (!$res)
		{
		mysql_query("UNLOCK TABLES");
		exit(mysql_error());
		}
	mysql_query("COMMIT");
	mysql_query("UNLOCK TABLES");
	}
else
	{
	header("location:../error.php?error=4");
	exit();
	}
header("location:../auction.php?auctionid=$auction");
?>