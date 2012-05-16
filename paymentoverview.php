<?php
include("controller/MainInclude.php");
if (!isset($_SESSION['user']))
	{
	header("location:index.php");
	exit();
	}
if ($_SESSION['user']->isAdmin())
	{
	$payments = payment::getAllPayments(false);
	}
else
	{
	$payments = payment::getUserPayments(false);
	}
include("view/PaymentView.php");
$includes = "<link rel='stylesheet' type='text/css' href='css/tables.css' />";
echoStart("Kreatif - Betalingsoversigt",$includes);
if ($payments)
	{
	echoPaymentTable($payments);
	}
else
	{
	echo "Ingen betalinger fundet.";
	}
echoEnd();

?>
