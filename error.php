<?php
include("controller/MainInclude.php");
echoStart("Kreatif - fejl");
echo "<p class='error'>";
if (!isset($_GET['error']))
	{
	echo "Der opstod en ukendt fejl.";
	}
else
	{
	switch ($_GET['error'])
		{
		case 0:
			echo "Brugeren findes ikke eller adgangskoden er forkert.";
			break;
		case 1:
			echo "Auktionen findes ikke eller er udløbet.";
			break;	
		case 2:
			echo "Dit bud var for lavt.<br />";
			echo "En anden har måske budt lige inden dig.<br />";
			echo "<a href='auction.php?auctionid=".$_GET['auctionid']."'>Klik her for at vende tilbage til auktionen.</a>";
			break;
		case 3:
			echo "Kunstneren blev ikke fundet.";
			break;	
		case 4:
			echo "Du skal være logget ind for at byde.";
			break;
		}
	}
echo "</p>";
echoEnd();
?>