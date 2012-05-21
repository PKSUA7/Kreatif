<?php
include("controller/MainInclude.php");
if (isset($_GET['paymentid']) && isset($_SESSION['user']))
	{
	$payment = payment::getPayment($_GET['paymentid']);
	if ($payment &&
		 $_SESSION['user']->getMail()==$payment->getMail())
		{
		$auction = $payment->getAuction();
		
		if (!isset($_POST['submit']))
			{
			echoStart("Kreatif - Betaling");
			echo "<form method='POST'>";
			echo "Fulde navn: <input type='text' name='realName' value='".$payment->getRealName()."'/><br/>";
			echo "Adresse: <input type='text' name='address' value='".$payment->getAddress()."'/><br/>";
			echo "Postnummer: <input type='text' name='zip' value='".$payment->getZip()."'/><br/>";
			echo "By: <input type='text' name='city' value='".$payment->getCity()."'/><br/>";
			echo "<input type='submit' value='fortsæt' name='submit'/>";
			echo "</form>";
			echoEnd();
			exit();
			}
		else
			{
			$payment->setAddres($_POST['realName'], $_POST['address'],
								$_POST['zip'], $_POST['city']);
			}
		}
	}

header("location:index.php");
?>