<?php
include("controller/MainInclude.php");
include("controller/CreateUser.php");
echoStart("Kreatif - Ny bruger");
function ifSet($value)
	{
	echo isset($_POST[$value])?$_POST[$value]:"";
	}
?>
<form method="post">
Brugernavn: <input type="text" name="username" value="<?php ifSet('username') ?>" /><br />
Email: <input type="text" name="mail" value="<?php ifSet('mail') ?>" /><br />
Gentag Email: <input type="text" name="mailtwo" value="<?php ifSet('mailtwo') ?>" /><br />
Adgangskode: <input type="password" name="pass" value="<?php ifSet('pass') ?>" /><br />
Gentag adgangskode: <input type="password" name="passtwo"/><br />
<input type="submit" name="submit" value="Opret"/>
</form>
<?php
echoEnd();
?>