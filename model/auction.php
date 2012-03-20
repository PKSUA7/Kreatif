<?php
class auction
	{
	private $ID;
	private $startDate;
	private $endDate;
	private $name;
	private $description;
	private $price;
	
	public static function getAuction($ID)
		{
		$ID = mysql_real_escape_string($ID);
		$res = mysql_query("SELECT * ".
							"FROM auction ".
							"WHERE auction_id=$ID");
		if (!$res) {return false;}
		$auction = mysql_fetch_array($res);
		$price = $auction['start_price'];
		$res = mysql_query("SELECT MAX(amount) AS price ".
							"FROM bid ".
							"WHERE auction_id=$ID");
		if ($res && mysql_num_rows($res)>0)
			{
			$newPrice = mysql_fetch_array($res);
			$price = $newPrice['price'];
			}
		return new auction($ID,$auction['name'],$auction['start_date'],
					$auction['end_date'],$price,$auction['product_desc']);
		}
		
	public static function getAuctions()
		{
		$res = mysql_query("SELECT auction_id AS id ".
							"FROM auction ".
							"WHERE end_date<now() and start_date>now()");
		$result = array();
		while ($row = mysql_fetch_array($res))
			{
			$result[] = getAuction($row['id']);
			}
		return $result;
		}
	
	public function __construct($ID, $name, $startDate, $endDate,
									$price, $description)
		{
        $this->ID = $ID;
		$this->name = $name;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->price = $price;
		$this->description = $description;
		}
	
	public function getID()
		{
		return $this->ID;
		}
	
	public function getDescription()
		{
		return $this->description;
		}
	
	public function getStartDate()
		{
		return $this->startDate;
		}
	
	public function getEndDate()
		{
		return $this->endDate;
		}
	
	public function getName()
		{
		return $this->name;
		}
	
	public function getPrice()
		{
		return $this->price;
		}
	
	public function getBids($max=5)
		{
		$res = mysql_query("SELECT amount, name ".
							"FROM bid ".
							"NATURAL JOIN user ".
							"WHERE auction_id='".$this->getID()."'".
							" ORDER BY amount DESC".($max>0?" LIMIT $max":""));
		$result = array();
		if (!$res) {return $result;}
		while ($row=mysql_fetch_array($res))
			{
			$result[] = $row;
			}
		return $result;
		}
	}
?>