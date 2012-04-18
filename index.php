<?php
//test4
//test3
//test2
//test
include("controller/MainInclude.php");
$includes = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/auction.css\" />";
echoStart("Kreatif - Index", $includes);
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
?>