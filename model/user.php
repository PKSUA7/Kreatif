<?php
class user
	{
	private $isAdmin = false;
	private $name;
	private $email;
	private $address;
	private $zip;
	
	public static function getUser($email,$password)
		{
		$email = mysql_real_escape_string($email);
		$password = hash('sha256', $password);
		$res = mysql_query("SELECT * FROM user WHERE mail='$email'");
		if (!$res || mysql_num_rows($res)==0) {return false;}
		$user = mysql_fetch_array($res);
		if ($user['password']!=$password) {return false;}
		return new user($user['mail'],$user['user_name'],$user['address'],$user['zip_code'],$user['is_admin']);
		}
	
	public function __construct($email, $user_name,$address,$zip,$isAdmin)
		{
        $this->email = $email;
		$this->name = $user_name;
		$this->address = $address;
		$this->zip = $zip;
		$this->isAdmin = $isAdmin;
		}
	
	public function isAdmin()
		{
		return $this->isAdmin;
		}
	
	public function getName()
		{
		return $this->name;
		}
		
	public function getMail()
		{
		return $this->email;
		}
		
	public function getAddress()
		{
		return $this->address;
		}
		
	public function getZip()
		{
		return $this->zip;
		}
		
	public function setAddress($address, $zip)
		{
		$address = mysql_real_escape_string($address);
		$zip = mysql_real_escape_string($zip);
		mysql_query("UPDATE user SET VALUES zip_code='$zip', address='$address' WHERE mail='".$this->getMail()."'");
		$this->address = $address;
		$this->zip = $zip;
		}
	}

?>