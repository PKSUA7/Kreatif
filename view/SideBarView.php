<div class="sidebar">
	<a href="index.php">Start</a><br />
	<?php 
	if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin())
		{?>
		<a href="auctionoverview.php">Auktionsoversigt</a><br />
		<a href="newauction.php">Opret auktion</a><br />
		<a href="newartist.php">Opret kunster profil</a><br />
		<?php
		}?>
</div>