<?php
include("controller/MainInclude.php");
if (isset($_GET['paymentid']) && isset($_SESSION['user']))
	{
	include("view/PaymentView.php");
	$includes = "<link rel='stylesheet' type='text/css' href='css/payment.css' />";
	$payment = payment::getPayment($_GET['paymentid']);
	if ($payment &&
		 $_SESSION['user']->getMail()==$payment->getMail())
		{
		$auction = $payment->getAuction();
		
		if (isset($_POST['step1']))
			{
			if (!$payment->setAddres($_POST['realName'], $_POST['address'],
								$_POST['zip'], $_POST['city']))
								{
								header("location:payment.php?paymentid=$_GET[paymentid]");
								exit();
								}
			echoStart("Kreatif - Betaling",$includes);
			echoPaymentSteps(1);
			echo "<br/><br/>";
			echoPaymentInfo($payment);
			echo "<br/><br/><br/><br/><br/><br/><br/><br/>";
			echo "<form method='POST'>";
			echo "<center><input type='submit' value='Godkend' name='step2'/></center>";
			echo "</form>";
			echoEnd();
			exit();
			}
		else if (isset($_POST['step2']))
			{
			echoStart("Kreatif - Betaling",$includes);
			echoPaymentSteps(2);
			echo "<br/><br/>";
			echo "<form method='POST'>";
			echo "<center><input type='submit' value='BETAL' name='step3'/></center>";
			echo "</form>";
			echoEnd();
			exit();
			}
		else if (isset($_POST['step3']))
			{
			$payment->setStatus("Betalt");
			echoStart("Kreatif - Betaling udført");
			echo "Kreatif er blevet gjort opmærksom på din betaling.<br/>".
				"Du vil modtage en mail så snart betalingen er godkendt.<br/>".
				"Klik <a href='index.php'>her</a> for at gå tilbage til forsiden.";
			echoEnd();
			exit();
			}
		else
			{
			echoStart("Kreatif - Betaling",$includes);
			echoPaymentSteps(0);
			echo "<h3>Modtager adresse:</h3><br/>";
			echo "<form method='POST'>";
			echo "Fulde navn: <input type='text' name='realName' value='".$payment->getRealName()."'/><br/>";
			echo "Adresse: <input type='text' name='address' value='".$payment->getAddress()."'/><br/>";
			echo "Postnummer: <input type='text' name='zip' value='".$payment->getZip()."'/><br/>";
			echo "By: <input type='text' name='city' value='".$payment->getCity()."'/><br/>";
			echo "<center><input type='submit' value='Fortsæt' name='step1'/></center>";
			echo "</form>";
			echoEnd();
			exit();
			}
		}
	}

header("location:index.php");
?>