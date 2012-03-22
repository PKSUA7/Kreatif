<?php
function echoAuctionBox($auction)
	{
	echo "<a href='auction.php?auctionid=".$auction->getID()."'><div class='auctionbox'>";
	echo "<img src='";
	echo $auction->getFrontImage()?$auction->getFrontImage():"images/layout/DefaultThumb.png";
	echo "'/><br />";
	echo $auction->getName()."<br />";
	echo "Udløber: ".$auction->getEndDate();
	echo "</div></a>";
	}

function echoAuctionBoxes($auctions)
	{
	foreach($auctions as $auction)
		{
		echoAuctionBox($auction);
		}
	}

function echoAuctionPage($auction)
	{
	echo "<h1>".$auction->getName()."</h1>";
	}
?>