<?php
$fail=false;
if (isset($_POST['submit']))
	{
	$startTime = "$_POST[startDay] $_POST[startTime]";
	$endTime = "$_POST[endDay] $_POST[endTime]";
	$name = mysql_real_escape_string($_POST['productName']);
	$desc = mysql_real_escape_string($_POST['productDesc']);
	$artist = mysql_real_escape_string($_POST['artistName']);
	$percent = mysql_real_escape_string($_POST['bidPercent']);
	$percent /= 100;
	$startPrice = mysql_real_escape_string($_POST['startPrice']);
	$buyout = mysql_real_escape_string($_POST['buyout']);
	$res = mysql_query("INSERT INTO auction(start_date, end_date, start_price, ".
				"bid_percent, buy_out_price, product_name, product_desc, artist_name) ".
				"VALUES ".
				"('$startTime','$endTime','$startPrice','$percent',".
				(empty($buyout)?"NULL":"'$buyout'").
				",'$name','$desc','$artist')");
	if (!$res)
		{
		$fail=true;
		}
	else
		{
		$auctionID=mysql_insert_id();
		include("ImageUpload.php");
		header("location:auction.php?auctionid=".$auctionID);
		exit();
		}
	}
?>