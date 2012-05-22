<?php

class payment
	{
	private $ID;
	private $mail;
	private $auctionID;
	private $date;
	private $status;
	private $amount;
	private $realName;
	private $zip;
	private $address;
	private $city;
	
	public static function getPayment($reference)
		{
		$reference = mysql_real_escape_string($reference);
		$res = mysql_query("SELECT * ".
							"FROM payment ".
							"WHERE reference='$reference'");
		if ($res && mysql_num_rows($res)>0)
			{
			$payment = mysql_fetch_array($res);
			return new payment($payment['reference'],$payment['mail'],
								$payment['auction_id'],$payment['status'],
								$payment['amount'],$payment['date'],$payment['real_name'],
								$payment['zip_code'], $payment['address'], $payment['city']);
			}
		else
			{
			return false;
			}
		}
	
	public static function getUserPayments($active=true)
		{
		$activeadd = $active?" AND status!='Afvist' AND status!='Afsendt' ":"";
		$res = mysql_query("SELECT reference ".
							"FROM payment ".
							"NATURAL JOIN statusenum ".
							"WHERE mail='".$_SESSION['user']->getMail()."' ".$activeadd.
							"ORDER BY ordering ASC, date DESC");
		if ($res && mysql_num_rows($res)>0)
			{
			$result = array();
			while ($row = mysql_fetch_row($res))
				{
				$result[] = payment::getPayment($row[0]);
				}
			return $result;
			}
		return false;
		}
		
	public static function getAllPayments($active=true)
		{
		$activeadd = $active?" WHERE status!='Afvist' AND status!='Afsendt' ":" ";
		$res = mysql_query("SELECT reference ".
							"FROM payment ".
							"NATURAL JOIN statusenum ".$activeadd.
							"ORDER BY ordering ASC, date DESC");
		if ($res && mysql_num_rows($res)>0)
			{
			$result = array();
			while ($row = mysql_fetch_row($res))
				{
				$result[] = payment::getPayment($row[0]);
				}
			return $result;
			}
		return false;
		}
		
	public function __construct($ID, $mail, $auctionID, $status, $amount,
									$date, $realName, $zip, $address, $city)
		{
		$this->ID = $ID;
        $this->mail = $mail;
		$this->auctionID = $auctionID;
		$this->date = $date;
		$this->status = $status;
		$this->amount = $amount;
		$this->realName = $realName;
		$this->zip = $zip;
		$this->address = $address;
		$this->city = $city;
		}
	
	public function getID()
		{
		return $this->ID;
		}
	
	public function getMail()
		{
		return $this->mail;
		}
	
	public function getAuction()
		{
		return auction::getAuction($this->auctionID);
		}
	
	public function getDate()
		{
		return $this->date;
		}
		
	public function getStatus()
		{
		return $this->status;
		}
		
	public function getFullAddress()
		{
		if ($this->zip==null)
			{
			return "Ingen modtager information";
			}
		else
			{
			return $this->realName."<br/>".
					$this->address."<br/>".
				  	$this->zip." ".$this->city."<br/>".
				  	"Danmark";
				   
			}
		}
	
	public function getZip()
		{
		return $this->zip==null?"":$this->zip;
		}	
	
	public function getAddress()
		{
		return $this->address;
		}
		
	public function getRealName()
		{
		return $this->realName;
		}
		
	public function getCity()
		{
		return $this->city;
		}	
	
	public function setAddres($realName,$address,$zip,$city)
		{
		if (!$zip) {return false;}
		$this->realName = mysql_real_escape_string($realName);
		$this->address = mysql_real_escape_string($address);
		$this->zip = mysql_real_escape_string($zip);
		$this->city = mysql_real_escape_string($city);
		mysql_query("UPDATE payment ".
					"SET real_name='$this->realName', ".
					"address='$this->address', ".
					"zip_code='$this->zip', ".
					"city='$this->city' ".
					"WHERE reference='".$this->getID()."'");
		return true;
		}
	
	public function getVerboseStatus()
		{
		switch ($this->status)
			{
			case "Afsendt":
				return "Varen er afsendt";
			case "Afvist":
				return "Betalingen blev afvist";
			case "Betalt":
				return "Varen er betalt";
			case "Godkendt":
				return "Betalingen er gennemført";
			case "Venter":
				return "Afventer betaling";
			default:
				return "Ukendt";
			}
		}
		
	public function getAmount()
		{
		return $this->amount;
		}
	
	public function setStatus($newStatus)
		{
		$newStatus = mysql_real_escape_string($newStatus);
		$res = mysql_query("UPDATE payment ".
						"SET status='$newStatus' ".
						"WHERE reference='".$this->getID()."'");
		if ($res)
			{
			$this->status = $newStatus;
			return true;
			}
		return false;
		}
	}
?>