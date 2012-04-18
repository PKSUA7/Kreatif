<?php
if (isset($_GET['artist']))
	{
	$artist = mysql_real_escape_string($_GET['artist']);
	include("controller/MainInclude.php");
	$res = mysql_query("SELECT artist_name, artist_desc,picture_url ".
					"FROM artist WHERE artist_name='$artist'");
	if (!$res || mysql_num_rows($res)==0)
		{
		header("location:error.php?error=3");
		exit();
		}
	$row = mysql_fetch_array($res);
	
	include("view/AuctionView.php");
	$auctions = auction::getArtistAuctions($row['artist_name']);
	
	$includes = "<link rel='stylesheet' type='text/css' href='css/artist.css' />";
	$includes .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/auction.css\" />";
	echoStart("Kreatif - $row[artist_name]",$includes);
	
	echo "<img src='$row[picture_url]'/>";
	echo "<h1 class='name'>$row[artist_name]</h1>";
	echo "<br />";
	echo $row['artist_desc'];
	
	echoAuctionTable($auctions);
	
	echoEnd();
	}
else
	{
	header("location:error.php?error=3");
	exit();
	}

?>