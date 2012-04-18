<?php
include("controller/MainInclude.php");
include("controller/CreateArtist.php");
if (!$_SESSION['user']->isAdmin())
	{
	header("location:index.php");
	exit();
	}
echoStart("Kreatif - Ny kunstner");?>
<form method="post" enctype="multipart/form-data">
Kunstner navn: <input type="text" name="name"/><br />
<label style="vertical-align:top">Beskrivelse:</label>
<textarea name="description" rows="16" cols="64">Beskrivelse her</textarea><br />
Billede: <input type="file" name="pic"/><br />
<input type="submit" name="submit" value="Opret" />
</form>
<?php 
echoEnd();
?>