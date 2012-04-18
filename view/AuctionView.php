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
	echo $diff->d." dage, ".timeToString($diff->h, $diff->i, $diff->s);
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
	echoArtist($auction);
	echoGallery($auction);
	
	echoAuctionTime($auction);
	
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

function echoArtist($auction)
	{
	echo "<h6 class='artist'>Skabt af: ";
	echo "<a href='artist.php?artist=".$auction->getArtistName()."'>";
	echo $auction->getArtistName();
	echo "</a></h6>";
	}
	
function echoAuctionTime($auction)
	{
	$end = new DateTime($auction->getEndDate());
	$diff = $end->diff(new DateTime());
	echo "<div class='maintimebox'>";
	echo "Udløber: <br />";
	echo $diff->d." dage, ".timeToString($diff->h, $diff->i, $diff->s);
	echo "</div>";
	}
	
function echoGallery($auction)
	{
	$images =  $auction->getImages();
	
	foreach ($images as $image)
		{
		echo "<a href='$image[picture]' rel='lightbox[gallery]'>".
			"<img src='$image[thumb]'/>".
			"</a>";
		}
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
	
function timeToString($h,$i,$s)
	{
	$time = "";
	if ($h<9) {$time.="0";}
	$time.=$h.":";
	if ($i<9) {$time.="0";}
	$time.=$i.":";
	if ($s<9) {$time.="0";}
	$time.=$s;
	return $time;
	}

// Peter, bare lige så du ved det er mig der har gjort noget godt/skidt herfra ;)
function echoAuctionRow($auction)
{
echo 	"<tr>";
echo		"<td>" . $auction->getName() . "</td>";
echo		"<td>" . $auction->getStartDate() . "</td>";
echo		"<td>" . $auction->getEndDate() . "</td>";
echo		"<td>" . $auction->getPrice() . "</td>";
echo		"<td>" . $auction->getArtistName() . "</td>";
echo	"</tr>";	
}

function echoAuctionTable($auctions){
	
	echo '<center><table border=1>
						<tr><th>autionName</th>
						<th>Start Date</th>
						<th>End date</th>
						<th>Start Price</th>
						<th>Artist</th>
		</center>';
	array_map("echoAuctionRow", $auctions);
	echo "</table>";	
}
?>