<?php
include("controller/MainInclude.php");
include("controller/CreateUser.php");
$includes = "<link rel='stylesheet' type='text/css' href='css/uservalidation.css' />";
$includes .= "<script type='text/javascript' src='js/uservalidation.js'></script>";
echoStart("Kreatif - Ny bruger", $includes);
function ifSet($value)
	{
	echo isset($_POST[$value])?$_POST[$value]:"";
	}
if (isset($mailfail))
	{
	echo "<p class='error'>Den angivede mail adresse er allerede i brug.</p>";
	}
else if (isset($_POST['submit']))
	{
	echo "<p class='error'>Der opstod en fejl ved brugeroprettelse. ".
		"Undersøg venligst om felterne er udfyldt korrekt.</p>";
	}
?>
<form method="post">
Brugernavn: <input id="username" type="text" name="username" value="<?php ifSet('username') ?>"
onkeyup="usernameListener('username','usernameDiv')" />
<div id="usernameDiv" class="error">Indtast venligst dit navn</div><br />
Email: <input id="mail" type="text" name="mail" value="<?php ifSet('mail') ?>"
onkeyup="mailListener('mail','mailDiv')" />
<div id="mailDiv" class="error">Indtast venligst din email adresse</div><br />
Gentag Email: <input id="mail2" type="text" name="mailtwo" value="<?php ifSet('mailtwo') ?>"
onkeyup="mailTwoListener('mail','mail2','mail2Div')" />
<div  id="mail2Div"  class="error">Indtast venligst din email adresse igen</div><br />
Adgangskode: <input id ="pass" type="password" name="pass" value="<?php ifSet('pass') ?>" 
onkeyup="passwordListener('pass','passDiv')" />
<div id="passDiv" class="error">Indtast venligst din adgangskode</div><br />
Gentag adgangskode: <input id="passtwo" type="password" name="passtwo"
onkeyup="passwordTwoListener('passtwo','pass','passtwoDIV')" />
<div id="passtwoDIV" class="error">Indtast venligst din adgangskode igen</div><br />
<input type="submit" name="submit" value="Opret"/>
</form>
<script type="text/javascript">checkAll();</script>
<?php
echoEnd();
?>