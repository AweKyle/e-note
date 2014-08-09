<?php
require 'includes/dbconf.php';
class PrivateMessage
{
	private $sender;
	private $addressee;
	private $title;
	private $message;

	public function __construct($sender, $addressee, $title, $message)
	{
		$this->sender = $sender;
		$this->addressee = $addressee;
		$this->title = $title;
		$this->message = $message;
	}

	public function sendMessage($sender, $addressee, $title, $message, $status = 0)
	{
		$send = ("INSERT INTO `enote`.`messages` (`sender_id`, `addressee_id`, `title`, `message`, `mess_status`) 
				  VALUES ('$this->sender', '$this->addressee', '$this->title', '$this->message', '$this->status')");
		return $send;
	}
}

class Addressee
{
	private $addressee;

	public function getAddrId()
	{
		$this->addressee = $_POST['addressee'];
		
	}
}

$c = DB::getConn();

$titl = $_POST['title'];
$mess = $_POST['message'];
$sen = $_POST['sender'];
$addr = $_POST['addressee'];

$privMess = new PrivateMessage($sen, $addr, $titl, $mess);

$send = $privMess->sendMessage($sen, $addr, $titl, $mess);
$lol = $c->exec($send);
if ($lol)
{
	print "!!!";
}
else
{
	print "???";
}
?>