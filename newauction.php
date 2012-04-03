<?php
include("controller/MainInclude.php");
if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin())
	{
	header("location:index.php");
	exit();
	}
include("controller/CreateAuction.php");

function makeNumberDropDown($name,$max)
	{
	echo "<select name='$name'>";
	for ($i=0;$i<=$max;$i++)
		{
		echo "<option value='$i'>$i</option>";
		}
	echo "</select>";
	}
	
function makeUploadField($num)
	{
	echo "Front billede: <input name='pic[]' type='file'><br />";
	for ($i=1;$i<$num;$i++)
		{
		echo "Billede: <input name='pic[]' type='file'><br />";
		}
	
	}

function makeArtistDropDown()
	{
	$res = mysql_query("SELECT artist_name FROM artist");
	echo "<select name='artistName'>";
	while ($row = mysql_fetch_array($res))
		{
		echo "<option value='$row[artist_name]'>$row[artist_name]</option>";
		}
	echo "</select>";
	}
	
echoStart("Kreatif - Ny auktion");

if ($fail)
	{
	echo "Der opstod en fejl ved oprettelse, undersøg venligst om felterne er udfyldt korrekt.<br />";
	echo mysql_error()."<br />";
	}
	
if (isset($_GET['pics']))
	{
?>

<form method="post" enctype="multipart/form-data">
Produktnavn: <input type="text" value="Ny auktion" name="productName"/><br />
<label style="vertical-align:top">Produktbeskrivelse:</label>
<textarea name="productDesc" rows="16" cols="64">Beskrivelse her</textarea><br />
Start pris: <input type="text" value="50" name="startPrice"/> kr.-<br />
Procent per bud: <input type="text" value="10" name="bidPercent"/>%<br />
Buyout: <input type="text" name="buyout"/>(Efterlad feltet tomt hvis buyout ikke skal være muligt)<br />
Starter om <?php makeNumberDropDown('startDay', 30)?> dage, 
klokken <?php makeNumberDropDown('startTime', 23)?>.<br />
Slutter <?php makeNumberDropDown('endDay', 30)?> dage efter startdato, 
klokken <?php makeNumberDropDown('endTime', 23)?>.<br />
Kunstner: <?php makeArtistDropDown()?><br />
Billeder: <br />
<?php makeUploadField($_GET['pics']);?>
<input type="submit" name="submit" value="Start auktion"/>
</form>

<?php
	}
else
	{
	?>
	<form method="get">
	Antal billeder tilknyttet auktionen: <?php makeNumberDropDown("pics", 10)?><br />
	<input type="submit" value="Fortsæt"/>
	</form>
	<?php
	}
echoEnd();
?>