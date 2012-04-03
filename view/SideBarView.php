<div class="sidebar">
	<a href="index.php">Start</a><br />
	<?php 
	if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin())
		{?>
		<a href="newauction.php">Opret auktion</a><br />
		<?php
		}?>
</div>