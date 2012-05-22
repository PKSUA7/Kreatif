<?php
include("controller/MainInclude.php");
include("view/PaymentView.php");
if (isset($_GET['paymentid']) && isset($_SESSION['user']))
	{
	$payment = payment::getPayment($_GET['paymentid']);
	if ($payment && ($_SESSION['user']->isAdmin() ||
		 $_SESSION['user']->getMail()==$payment->getMail()))
		{
		$auction = $payment->getAuction();
		$includes = "<link rel='stylesheet' type='text/css' href='css/payment.css' />";
		echoStart("Kreatif - Betalingsinformation",$includes);
		echo "<h2>Betalingsdetaljer:</h2>";
		echoPaymentInfo($payment);
		if ($_SESSION['user']->isAdmin())
			{
			if (isset($_POST['godkend']))
				{
				$payment->setStatus("Godkendt");
				sendMail($payment->getMail(), "Kreatif har godkendt din betaling, ".
											"du vil modtage en mail med track&amp;trace nummer ".
											"når varen er afsendt.", "Betaling godkendt");
				}
			if (isset($_POST['afvis']))
				{
				$payment->setStatus("Afvist");
				sendMail($payment->getMail(), "Kreatif har afvist din betaling.<br/> ".
											"Din betaling er højst sandsynligt ikke gået igennem.",
											"Betaling afvist");
				}
			if (isset($_POST['afsend']))
				{
				$payment->setStatus("Afsendt");
				sendMail($payment->getMail(), "Kreatif har netop afsendt din ordre.<br/> ".
											"Track%amp;trace nummeret er $_POST[track].",
											"Varen er afsendt");
				}
			echo "<br/><br/><br/><br/><br/><br/><br/>";
			echo "<h3>Mulige handlinger:</h3></br>";
			switch ($payment->getStatus())
				{
				case "Betalt":
					?>
					<form method="post">
					<input type="submit" value="Godkend" name="godkend"/>
					</form>
					<form method="post">
					<input type="submit" value="Afvis" name="afvis"/>
					</form>
					<?php 
					break;
				case "Godkendt":
					?>
					<form method="post">
					Track&amp;Trace: <input type="text" name="track"/>
					<input type="submit" value="Afsend" name = "afsend"/>
					</form>
					<?php
					break;
				default:
					echo "Ingen handlinger tilgængelige.";
				}
			}
		echoEnd();
		exit();
		}
	}

header("location:index.php");
?>