<?php
include("controller/MainInclude.php");
if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin())
	{
	header("location:index.php");
	exit();
	}
include("view/AuctionView.php");
$auctions = auction::getAllAuctions();
$includes = "<link rel='stylesheet' type='text/css' href='css/auction.css' />";
$includes .= "<link rel='stylesheet' type='text/css' href='css/tables.css' />";
echoStart("Kreatif - Auktionsoversigt",$includes);
echoAuctionTable($auctions);
echoEnd();

?>
