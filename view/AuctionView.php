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
	echo "Udl�ber: <br />";
	echo "<div class='timebox'>";
	echo getTimeLeft($auction);
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
	
	$isActive = echoAuctionTime($auction);
	
	echo "<div class='description'>".$auction->getDescription()."</div>";
	
	echoBids($auction);
	echo "<br />";
	
	echo "<form action='controller/MakeBid.php?auctionid=".$auction->getID()."' method='post'>";
	if ($isActive)
		{
		echo "<h3>Dit bud:</h3>";
		echo "I alt <select name='bidchoice'>";
		array_map("echoOptions",$auction->getPossibleBids());
		echo "</select> kr.";
		echo "<br /><input type='submit' name='submit' value='byd'/>";
		echo "</form>";
		}
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
	echo "Udl�ber: <br />";
	$timeLeft=getTimeLeft($auction);
	echo $timeLeft;
	echo "</div>";
	return $timeLeft!="Udl�bet";
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
	
function echoBid($bid, $style)
	{
	echo "<tr class='$style'>";
	echo "<td>".$bid['user_name']."</td>";
	echo "<td>".$bid['amount']." kr.</td>";
	echo "</tr>";
	}
	
function echoBids($auction)
	{
	$bids = $auction->getBids();
	echo "<h3>Tidligere bud:</h3>";
	if (count($bids)==0)
		{
		echo "Ingen bud endnu.<br />";
		}
	else
		{
		echo "<table BORDER=1 CELLPADDING=3 CELLSPACING=1 
    			RULES=COLS FRAME=BOX>";
		echo "<tr><th>Bruger</th><th>Bud</th></tr>";
		$i=0;
		foreach($bids as $bid)
			{
			echoBid($bid,$i==0?"one":"two");
			$i=($i+1) % 2;
			}
		echo "</table>";
		}
	}
	
function getTimeLeft($auction)
	{
	$end = new DateTime($auction->getEndDate());
	$now = new DateTime();
	if ($end<$now)
		{
		return "Udl�bet";
		}
	$diff = $end->diff($now);
	return $diff->d." dage, ".timeToString($diff->h, $diff->i, $diff->s);
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

// Peter, bare lige s� du ved det er mig der har gjort noget godt/skidt herfra ;)
function echoAuctionRow($auction, $style)
	{
	echo "<tr class='$style'>";
		echo "<td>";
		echo "<a href='auction.php?auctionid=".$auction->getID()."'>";
		echo $auction->getName();
		echo "</a></td>";
		echo "<td>" . date_format(new DateTime($auction->getStartDate()),"d-m-Y H:i:s") . "</td>";
		echo "<td>" . getTimeLeft($auction) . "</td>";
		echo "<td>" . $auction->getPrice() . "</td>";
		echo "<td>";
		echo "<a href='artist.php?artist=".$auction->getArtistName()."'>";
		echo $auction->getArtistName();
		echo "</a></td>";
	echo "</tr>";	
	}

function echoAuctionTable($auctions)
	{
	echo "<h3>Auktioner:</h3>";
	echo "<table BORDER=1 CELLPADDING=3 CELLSPACING=1 
    			RULES=COLS FRAME=BOX>
						<tr>
							<th>Produkt</th>
							<th>Start</th>
							<th>Slut</th>
							<th>Nuv�rende pris</th>
							<th>Kunstner</th>
						</tr>";
	$i=0;
	foreach ($auctions as $auction)
		{
		echoAuctionRow($auction,$i==0?"one":"two");
		$i=($i+1) % 2;
		}
	echo "</table>";	
	}
?>