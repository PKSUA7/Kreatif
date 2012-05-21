<?php
include("controller/MainInclude.php");
if (isset($_GET['mail']))
	{
	if (isset($_GET['auth']))
		{
		$code = mysql_real_escape_string($_GET['auth']);
		$mail = mysql_real_escape_string($_GET['mail']);
		$res = mysql_query("SELECT code FROM authentication WHERE mail='$mail' AND code='$code'");
		if (!$res || mysql_num_rows($res)==0)
			{
			echoStart("Kreatif - Fejl");
			echo "Aktiverings koden var indtastet forkert, prøv venligst igen.<br/>";
			?>
			<form method="GET">
			<input type="hidden" name="mail" value="<?php echo $_GET['mail']?>"/>
			Kode: <input type="text" name="auth"/><br/>
			<input type="submit" value="Aktiver"/>
			</form>
			<?php 
			echoEnd();
			exit();
			}
		else
			{
			mysql_query("DELETE FROM authentication WHERE mail='$mail' AND code='$code'");
			echoStart("Kreatif - Success");
			echo "Din bruger er nu registreret og du kan logge ind med det samme!";
			echoEnd();
			exit();
			}
		}
	else
		{
		echoStart("Kreatif - Bruger aktivering");
		?>
		Du har nu modtaget en mail med information om hvordan du aktiverer din nye bruger konto.<br/>
		Hvis du ikke har modtaget nogen mail, tjek venligst din spam mappe.<br/>
		Hvis linket i mailen ikke virker, kopier da koden angivet i mailen og sæt den ind i feltet nedenfor.<br/>
		<form method="GET">
		<input type="hidden" name="mail" value="<?php echo $_GET['mail']?>"/>
		Kode: <input type="text" name="auth"/><br/>
		<input type="submit" value="Aktiver"/>
		</form>
		<?php 
		echoEnd();
		exit();
		}
	}

header("location:index.php");
?>