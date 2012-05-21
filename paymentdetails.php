<?php
include("controller/MainInclude.php");
if (isset($_GET['paymentid']) && isset($_SESSION['user']))
	{
	$payment = payment::getPayment($_GET['paymentid']);
	if ($payment && ($_SESSION['user']->isAdmin() ||
		 $_SESSION['user']->getMail()==$payment->getMail()))
		{
		$auction = $payment->getAuction();
		echoStart("Kreatif - Betalingsinformation");
		echo $payment->getFullAddress();
		echo "<br/>";
		echo $auction->getName()." - ".$payment->getAmount()." kr.-";
		echoEnd();
		exit();
		}
	}

header("location:index.php");
?>