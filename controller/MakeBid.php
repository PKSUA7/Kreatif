<?php
include("MainInclude.php");
if (!isset($_GET['auctionid']))
	{
	header("location:../index.php");
	exit();
	}
$auction = mysql_real_escape_string($_GET['auctionid']);
if (isset($_SESSION['user']))
	{
	$bid = mysql_real_escape_string($_POST['bidchoice']);
	$res = mysql_query("SELECT amount FROM bid WHERE amount>='$bid'");
	if (mysql_num_rows($res)>0)
		{
		header("location:../Error.php?error=2&auctionid=$auction");
		exit();
		}
	$res = mysql_query("INSERT INTO bid(mail, amount, auction_id)".
				" VALUES ('".$_SESSION['user']->getMail()."','$bid','$auction')");
	if (!$res)
		{
		exit(mysql_error());
		}
	}

header("location:../auction.php?auctionid=$auction");
?>