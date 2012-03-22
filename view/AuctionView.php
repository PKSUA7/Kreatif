<?php
function echoAuctionBox($auction)
	{
	$end = new DateTime($auction->getEndDate());
	$diff = $end->diff(new DateTime());
	echo "<a href='auction.php?auctionid=".$auction->getID()."'><div class='auctionbox'>";
	echo "<img src='";
	echo $auction->getFrontImage()?$auction->getFrontImage():"images/layout/DefaultThumb.png";
	echo "'/><br />";
	echo $auction->getName()."<br />";
	echo $auction->getPrice()." kr.<br />";
	echo "Udløber: <br />";
	echo "<div class='timebox'>";
	echo $diff->d." dage, ".$diff->h.":".$diff->i.":".$diff->s;
	echo "</div>";
	echo "</div></a>";
	}

function echoAuctionBoxes($auctions)
	{
	array_map("echoAuctionBox",$auctions);
	}

function echoOptions($option)	
	{
	echo "<option value='".$option."'>".$option."</option>";
	}
function echoAuctionPage($auction)
	{
	echo "<div class='price'>".$auction->getPrice()." kr.</div>";
	
	echo "<h1 class='header'>".$auction->getName()."</h1>";
	echo "<h6 class='artist'>Skabt af: ".$auction->getArtistName()."</h5>";
	
	$end = new DateTime($auction->getEndDate());
	$diff = $end->diff(new DateTime());
	echo "<div class='maintimebox'>";
	echo "Udløber: <br />";
	echo $diff->d." dage, ".$diff->h.":".$diff->i.":".$diff->s;
	echo "</div>";
	
	echo "<div class='description'>".$auction->getDescription()."</div>";
	
	echoBids($auction);
	echo "<br />";
	
	echo "<form action='controller/MakeBid.php?auctionid=".$auction->getID()."' method='post'>";
	echo "Dit bud:<br />";
	echo "i alt <select name='bidchoice'>";
	array_map("echoOptions",$auction->getPossibleBids());
	echo "</select> kr.";
	echo "<br /><input type='submit' name='submit' value='byd'/>";
	echo "</form>";
	}

function echoBid($bid)
	{
	echo "<tr>";
	echo "<td>".$bid['user_name']."</td>";
	echo "<td>".$bid['amount']." kr.</td>";
	echo "</tr>";
	}
	
function echoBids($auction)
	{
	$bids = $auction->getBids();
	echo "Tidligere bud:</br>";
	if (count($bids)==0)
		{
		echo "Ingen bud endnu.<br />";
		}
	else
		{
		echo "<table border='1'>";
		echo "<tr><td>Bruger</td><td>Bud</td></tr>";
		array_map("echoBid",$bids);
		echo "</table>";
		}
	}
?>