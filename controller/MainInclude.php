<?php
include("/ConnectDB.php");
include("/../model/user.php");
include("/../model/auction.php");
session_start();
/*$curUser = null;
if (isset($_SESSION['user']))
	{
	$curUser = $_SESSION['user'];
	}*/
include("/../view/MainView.php");
?>