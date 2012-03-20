<?php
$conn = mysql_connect("localhost","root","");
if (!$conn)
	{
	exit("Kunne ikke tilg&aring; databasen!");
	}
$dbSelect = mysql_select_db("Kreatif");
if (!$dbSelect)
	{
	exit("Kunne ikke tilg&aring; databasen!");
	}
?>