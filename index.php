<?php
include("controller/MainInclude.php");
echoStart("Kreatif - Index");
//echo "Indhold her";
$auctions = auction::getAuctions();
if (count($auctions)==0)
	{
	echo "Ingen aktive auktioner tilg&aelig;ngelige.";
	}
else
	{
	//echo auktions oversigt
	}
echoEnd();
?>