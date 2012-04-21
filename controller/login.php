<?php
include("MainInclude.php");
if (!isset($_GET['logout']))
	{
	if (isset($_POST['submit']))
		{
		$newuser = user::getUser($_POST['email'], $_POST['pass']);
		if ($newuser)
			{
			$_SESSION['user'] = $newuser;
			}
		else
			{
			header("location:../error.php?error=0");
			exit();
			}
		}
	}
else
	{
	if (isset($_SESSION['user'])) {unset($_SESSION['user']);}
	}
header("location:../");
exit();
?>