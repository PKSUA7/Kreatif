<?php
if (isset($_POST['submit']))
	{
	$name = mysql_real_escape_string($_POST['name']);
	$desc = mysql_real_escape_string($_POST['description']);
	$imageurl="";
	if (!$_FILES["pic"]["error"][$i])
		{
		$dir = "images/upload/artist/";
		$imageurl=$dir.$_FILES["pic"]["name"];
		move_uploaded_file($_FILES["pic"]["tmp_name"],
				$imageurl);
		}
	mysql_query("INSERT INTO artist(artist_name, artist_desc, picture_url) ".
				"VALUES ('$name','$desc','$imageurl')");
	header("location:artist.php?artist=$name");
	exit();
	}
?>