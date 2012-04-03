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
	private $noBids;
	
	public static function getAuction($ID)
		{
		$ID = mysql_real_escape_string($ID);
		$res = mysql_query("SELECT * ".
							"FROM auction ".
							"WHERE auction_id=$ID");
		if (!$res || mysql_num_rows($res)==0) {return false;}
		$auction = mysql_fetch_array($res);
		$price = $auction['start_price'];
		$noBids=true;
		$res = mysql_query("SELECT MAX(amount) AS price ".
							"FROM bid ".
							"WHERE auction_id=$ID");
		if ($res && mysql_num_rows($res)>0)
			{
			$newPrice = mysql_fetch_array($res);
			if ($newPrice['price']!=null)
				{
				$price = $newPrice['price'];
				$noBids=false;
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
		$result = null;
		$res = mysql_query("SELECT thumb_url FROM gallery WHERE auction_id='".
							$this->ID."' AND is_front='1'");
		if (mysql_num_rows($res)>0)
			{
			$result=mysql_fetch_array($res);
			$result = $result['thumb_url'];
			}
		return $result;
		}
	
	public function getImages()
		{
		$result = array();
		$res = mysql_query("SELECT picture_url, thumb_url ".
						"FROM gallery ".
						"WHERE auction_id='".$this->ID."'");
		while ($row=mysql_fetch_array($res))
			{
			$image = array('picture'=>$row['picture_url'],'thumb'=>$row['thumb_url']);
			$result[] = $image;
			}
		return $result;
		}
		
	public function getPossibleBids()
		{
		$bid = $this->price*$this->bidPercent;
		$result = array();
		for ($i=($noBids=true?0:1);$i<=10;$i++)
			{
			$result[] = round($this->price+$bid*$i);
			}
		return $result;
		}
	}
?>