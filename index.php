<?php
//test4
//test3
//test2
//test
include("controller/MainInclude.php");
$includes = "<link rel='stylesheet' type='text/css' href='css/auction.css' />";
$includes .= "<link rel='stylesheet' type='text/css' href='css/tables.css' />";
$includes .= "<script type='text/javascript' src='js/countdown.js'></script>";
echoStart("Kreatif - Index", $includes);
if (isset($_SESSION['user']))
	{
	if ($_SESSION['user']->isAdmin())
		{
		$payments = payment::getAllPayments();
		}
	else
		{
		$payments = payment::getUserPayments();
		}
	if ($payments)
		{
		include("view/PaymentView.php");
		echoPaymentTable($payments);
		}
	}
$auctions = auction::getAuctions();
if (count($auctions)==0)
	{
	echo "Ingen aktive auktioner tilg&aelig;ngelige.";
	}
else
	{
	include("view/AuctionView.php");
	echoAuctionBoxes($auctions);
	}
echoEnd();
echo "<script type='text/javascript'>initCountdown()</script>";
?>