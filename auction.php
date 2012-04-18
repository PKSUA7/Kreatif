<?php
include("controller/MainInclude.php");
include("view/AuctionView.php");
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
$includes .= "<link rel='stylesheet' href='js/lightbox/css/lightbox.css' type='text/css' media='screen' />";
$includes .= "<script type='text/javascript' src='js/lightbox/js/prototype.js'></script>";
$includes .= "<script type='text/javascript' src='js/lightbox/js/scriptaculous.js?load=effects,builder'></script>";
$includes .= "<script type='text/javascript' src='js/lightbox/js/lightbox.js'></script>";
echoStart("Kreatif - ".$auction->getName(), $includes);

echoAuctionPage($auction);

echoEnd();
?>