<?php
header('Content-Type: text/html; Charset=utf8');
if (isset($_POST['login']) && isset($_POST['password']))
{
  $passHash = md5($_POST['password']);
  $login = $_POST['login'];
}  
include 'includes/dbconf.php';
$result = $c->query("SELECT * FROM `enote`.`users` WHERE `login`= '$login' AND `pass`= '$passHash'");
if ($result->rowCount() == 1)
{
	$id = $result->fetch(PDO::FETCH_ASSOC);
	session_start();
   	$_SESSION['user'] = $login;
	header ("location: index.php");
}
else
{
	print " Введен неправильный Логин/Пароль попробуйте <a href = 'http://localhost/e-note/index.php'>еще раз</a> или <a href = 'http://localhost/e-note/reg.html'>Зарегистрируйтесь!</a> <br />\n" . mysql_error();
}
?>
