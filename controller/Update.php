<?php
//Find auktioner der er afsluttede, har bud og ikke er tilknyttet en betaling
include("MainInclude.php");
$res = mysql_query("SELECT auction_id, product_name ".
					"FROM auction ".
					"WHERE end_date<now() ".
					"AND auction_id IN (SELECT auction_id FROM bid) ".
					"AND auction_id NOT IN (SELECT auction_id FROM payment)");

//Opret betaling p� fundne auktioner og tildel h�jst bydende

while ($row = mysql_fetch_row($res))
	{
	$res2 = mysql_query("SELECT mail, amount ".
						"FROM bid ".
						"WHERE auction_id='$row[0]' ".
						"ORDER BY amount DESC ".
						"LIMIT 1");
	$row2 = mysql_fetch_array($res2);
	mysql_query("INSERT INTO payment(mail, auction_id, amount, status) ".
				"VALUES ('$row2[mail]','$row[0]','$row2[amount]','Venter')");
	
	sendMail($row2['mail'], "Tillykke! Du har vundet en auktion for $row[1]. ".
							"Varen skal betales senest om 3 dage.","Vundet auktion");
	}	
//Find udl�bede betalinger
$res = mysql_query("SELECT auction_id ".
					"FROM payment ".
					"WHERE status='Venter' ".
					"AND date+INTERVAL 3 DAY<now()");

//Opret nye betalinger til auktioner, hvor bydende ikke har betalt
while ($row = mysql_fetch_row($res))
	{
	$subQuery = "SELECT mail FROM payment WHERE auction_id=$row[0]";
	$res2 = mysql_query("SELECT mail, amount ".
						"FROM bid ".
						"WHERE auction_id='$row[0]' ".
						"AND mail NOT IN ($subQuery) ".
						"ORDER BY amount DESC ".
						"LIMIT 1");
	if ($res2 && mysql_num_rows($res2)>0)
		{
		$bid = mysql_fetch_array($res2);
		mysql_query("INSERT INTO payment(mail, auction_id, amount, status) ".
				"VALUES ('$bid[mail]','$row[0]','$bid[amount]','Venter')");
		}
	}

//Afvis ikke udf�rte betalinger
mysql_query("UPDATE payment ".
					"SET status='Afvist' ".
					"WHERE status='Venter' ".
					"AND date+INTERVAL 3 DAY<now()");
if (isset($_GET['redirect']))
	{
	header("location:../index.php");
	}
?>