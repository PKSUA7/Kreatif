<?php
function echoPaymentRow($payment, $style)
	{
	$auction = $payment->getAuction();
	echo "<tr class='$style'>";
	if ($_SESSION['user']->isAdmin())
		{
		echo "<td>".$payment->getID()."</td>";
		echo "<td>".$payment->getMail()."</td>";
		}
		echo "<td>";
		echo "<a href='auction.php?auctionid=".$auction->getID()."'>";
		echo $auction->getName();
		echo "</a></td>";
		
		echo "<td>" . date_format(new DateTime($payment->getDate()),"d-m-Y H:i:s") . "</td>";
		
		echo "<td>" . $payment->getAmount() . " kr.</td>";
		
		echo "<td>".$payment->getVerboseStatus()."</td>";
		
	echo "</tr>";	
	}

function echoPaymentTable($payments)
	{
	echo "<h3>Betalinger:</h3>";
	echo "<table BORDER=1 CELLPADDING=3 CELLSPACING=1 
    			RULES=COLS FRAME=BOX>
						<tr>";
	if ($_SESSION['user']->isAdmin())
		{
		echo "<th>Reference nummer</th>
			 <th>Mail</th>";
		}
	echo					"<th>Produkt</th>
							<th>Dato</th>
							<th>Bel�b</th>
							<th>Status</th>
						</tr>";
	$i=0;
	foreach ($payments as $payment)
		{
		echoPaymentRow($payment,$i==0?"one":"two");
		$i=($i+1) % 2;
		}
	echo "</table><br/>";	
	}
?>