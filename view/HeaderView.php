<div class="header">
<h1 class="maintitle">Kreatif</h1>
<?php 
if (!isset($_SESSION['user']))
	{
?>

	<form class="loginbar" action="controller/login.php" method="post">
	E-Mail: <input type="text" name="email" />
	Adgangskode: <input type="password" name="pass" />
	<input type="submit" value="Log ind"  name="submit"/>
	<a href="newuser.php">Opret bruger</a>
	</form>
	
<?php }
else 
	{
	?>
	<p class="loginbar">Velkommen <?php echo $_SESSION['user']->getName();?>.
	<a href="controller/login.php?logout=1">Log ud?</a></p>	
	<?php 	
	}?>
</div>