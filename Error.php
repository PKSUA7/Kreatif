<?php
include("controller/MainInclude.php");
$fejl[0] = "Brugeren findes ikke eller adgangskoden er forkert.";
echoStart("Kreatif - login");
$fejl = isset($fejl[($_GET['error'])])?$fejl[($_GET['error'])]:"Der opstod en ukendt fejl.";
echo "<p class='error'>".$fejl."</p>";
echoEnd();
?>