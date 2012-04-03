<?php
if (isset($_FILES['pic']))
	{
	include("model/SimpleImage.php");
	$dir = "images/upload/$auctionID/";
	mkdir($dir);
	for ($i=0;$i<count($_FILES["pic"]["name"]);$i++)
		{
		if (!$_FILES["pic"]["error"][$i])
			{
			$imageurl=$dir.$_FILES["pic"]["name"][$i];
			$thumburl=$dir."thumb".$_FILES["pic"]["name"][$i];
			move_uploaded_file($_FILES["pic"]["tmp_name"][$i],
				$imageurl);
				
			$thumb = new SimpleImage();
			$thumb->load($imageurl);
			$thumb->resize(64,64);
			$thumb->save($thumburl);
			
			mysql_query("INSERT INTO ".
						"gallery(auction_id,picture_url,thumb_url,is_front) ".
						"VALUES ('$auctionID','$imageurl','$thumburl',".
						(1-min($i,1)).
						")");
			}
		}
	}
?>