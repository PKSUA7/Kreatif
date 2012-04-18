<?php
include("controller/MainInclude.php");
if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin())
	{
	header("location:index.php");
	exit();
	}
include("view/AuctionView.php");
$auctions = auction::getAllAuctions();
echoStart("Kreatif - Auktionsoversigt");
echoAuctionTable($auctions);
echoEnd();

?>

<a href="index.php">back to index</a><br />
