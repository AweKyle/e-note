<?php
class DB
{
	public static $conn = null;

	public static function getConn()
	{
		if (self::$conn === null)
		{
			self::$conn = new PDO('mysql:host=localhost;dbname=enote', 'root', 'root');
		}
		return self::$conn;
	}
}
try
{
	$c = DB::getConn();
	$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$c->exec("set names 'utf8'");
}
catch(PDOException $exc) 
{
    print $exc->getMessage();
}
?>