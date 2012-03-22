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
		}
	}
echo "</p>";
echoEnd();
?>