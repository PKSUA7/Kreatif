<?php
function echoStart($title,$includes="")
	{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php
		echo "<title>$title</title>";
		echo $includes;
		?>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
	</head>
	<body>
	<?php
	include("HeaderView.php");
	include("SideBarView.php");
	?>
	<div class="maincontent">
	<?php
	}
	
function echoEnd()
	{
	?>
	</div>
	<?php
	include("FooterView.php");
	?>
	</body>
	</html>
	<?php
	}
?>