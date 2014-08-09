<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user']))
{
	die("error!!!");
}
include 'includes/dbconf.php';

$c = DB::getConn();
$name = $_SESSION['user'];
$m = $_POST['mail'];
$n = $_POST['name'];
$s = $_POST['surname'];
$ag = $_POST['age'];


if ($m <> "") 
	{
	$nm = $c->query("UPDATE `enote`.`users` SET `email`='$m' WHERE `login`='$name'");
	}
if ($n <> "")
	{
	$nn = $c->query("UPDATE `enote`.`users` SET `name`='$n' WHERE `login`='$name'");
	}
if ($s <> "")
	{
	$ns = $c->query("UPDATE `enote`.`users` SET `surname`='$s' WHERE `login`='$name'");
	}
if ($ag <> "")
	{
	$nag = $c->query("UPDATE `enote`.`users` SET `age`='$ag' WHERE `login`='$name'");
	}
	
print "Ваши данные успешно изменены. Нажмите <a href='user.php'>(Назад)</a>, чтобы вернуться<br />\n";
?>