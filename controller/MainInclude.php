<?php
include("ConnectDB.php");

include(dirname(__DIR__)."/model/user.php");
include(dirname(__DIR__)."/model/auction.php");
include(dirname(__DIR__)."/model/payment.php");
session_start();
/*$curUser = null;
if (isset($_SESSION['user']))
	{
	$curUser = $_SESSION['user'];
	}*/

include(dirname(__DIR__)."/view/MainView.php");
?>