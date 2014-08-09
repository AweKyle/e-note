<?php
session_start();
header("Content-Type:text/html; Charset = utf-8");
if (!isset($_SESSION['user']))
{
	die("error!!!");
}
include 'includes/dbconf.php';

$name = $_SESSION['user'];
print "<br>".$name."<br>";
$passHash = md5($_POST['pass']);
$newpassHash = md5($_POST['newpass']);
$newpassHash2 = md5($_POST['newpass2']);

$c = DB::getConn();

$result = $c->query("SELECT * FROM `enote`.`users` WHERE `login`= '$name' AND `pass` = '$passHash'");
if ($result)
	{
	if ($newpassHash == $newpassHash2 && ($newpassHash <> "" || $newpassHash <> ""))
		{
		$newpas = $c->query("UPDATE `enote`.`users` SET `pass` = '$newpassHash' WHERE `login` = '$name'");		
		print "yeah<br>";
		print $passHash;
		print "<br>";
		print $newpassHash;
		}
	else
		{
		die("Новый пароль введен не верно");
		}
	}
else
	{
	die("старый пароль введен не верно!<a href = 'np.html'> ЕЩЕ РАЗ</a>");
	}
print '<br><a style="text-decoration:none" href="http://localhost/e-note.p/user.php"><<назад</a>';
?>
