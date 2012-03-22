<?php
class auction
	{
	private $ID;
	private $startDate;
	private $endDate;
	private $name;
	private $description;
	private $price;
	private $bidPercent;
	private $artist;
	
	public static function getAuction($ID)
		{
		$ID = mysql_real_escape_string($ID);
		$res = mysql_query("SELECT * ".
							"FROM auction ".
							"WHERE auction_id=$ID");
		if (!$res || mysql_num_rows($res)==0) {return false;}
		$auction = mysql_fetch_array($res);
		$price = $auction['start_price'];
		$res = mysql_query("SELECT MAX(amount) AS price ".
							"FROM bid ".
							"WHERE auction_id=$ID");
		if ($res && mysql_num_rows($res)>0)
			{
			$newPrice = mysql_fetch_array($res);
			if ($newPrice['price']!=null)
				{
				$price = $newPrice['price'];
				}
			}
		return new auction($ID,$auction['product_name'],$auction['start_date'],
					$auction['end_date'],$price,$auction['product_desc'],
					$auction['bid_percent'],$auction['artist_name']);
		}
		
	public static function getAuctions()
		{
		$res = mysql_query("SELECT auction_id AS id ".
							"FROM auction ".
							"WHERE end_date>now() and start_date<now()");
		$result = array();
		while ($row = mysql_fetch_array($res))
			{
			$result[] = auction::getAuction($row['id']);
			}
		return $result;
		}
	
	public function __construct($ID, $name, $startDate, $endDate,
									$price, $description, $bidPercent,
									$artist)
		{
        $this->ID = $ID;
		$this->name = $name;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->price = $price;
		$this->description = $description;
		$this->bidPercent = $bidPercent;
		$this->artist = $artist;
		}
	
	public function getID()
		{
		return $this->ID;
		}
		
	public function getArtistName()
		{
		return $this->artist;
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
		$res = mysql_query("SELECT amount, user_name ".
							"FROM bid ".
							"NATURAL JOIN user ".
							"WHERE auction_id='".$this->ID."'".
							" ORDER BY amount DESC".($max>0?" LIMIT $max":""));
		$result = array();
		if (!$res) {return $result;}
		while ($row=mysql_fetch_array($res))
			{
			$result[] = $row;
			}
		return $result;
		}
		
	public function getFrontImage()
		{
		return null;
		}
		
	public function getPossibleBids()
		{
		$bid = $this->price*$this->bidPercent;
		$result = array();
		for ($i=1;$i<11;$i++)
			{
			$result[] = round($this->price+$bid*$i);
			}
		return $result;
		}
	}
?>