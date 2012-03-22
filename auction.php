<?php
include("controller/MainInclude.php");
if (!isset($_GET['auctionid']))
	{
	header("location:index.php");
	exit();
	}
$auction = auction::getAuction($_GET['auctionid']);
if (!$auction)
	{
	header("location:Error.php?error=1");
	exit();
	}
$includes = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/auction.css\" />";
echoStart("Kreatif - Index", $includes);
include("view/AuctionView.php");
echoAuctionPage($auction);
echoEnd();
?>