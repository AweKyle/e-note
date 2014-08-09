<?php
include 'includes/session.php';
include 'includes/dbconf.php';

$c = DB::getConn();

function getId()
{
	$c = DB::getConn();
	$login = $_SESSION['user'];
	$getId = $c->query("SELECT `id` FROM `enote`.`users` WHERE `login` = '$login'");
	$id = $getId->fetch(PDO::FETCH_ASSOC);
	$_POST['id'] = $id['id'];
}
getId();

$us_id = $_POST['id'];
$getNews = $c->query("SELECT `users`.`id`, `users`.`login`, `friends`.`req_from`,`friends`.`req_to`, 
						`notes`.`user_id`, `notes`.`note`, `notes`.`date`, `notes`.`time`, `notes`.`insDateAndTime` 
						FROM `enote`.`users`, `enote`.`friends`, `enote`.`notes` 
						WHERE `users`.`id` = `notes`.`user_id` 
						AND `notes`.`user_id` = `friends`.`req_from` 
						AND `users`.`id` = `friends`.`req_from` 
						AND `friends`.`req_to` = '$us_id'");
print("<table border=3 align = 'center' rules = 'rows' cols = '2' WIDTH = '60%'>\n");
while($resNews = $getNews->fetch(PDO::FETCH_ASSOC))
{
	$printUs = $resNews['login'];
	$printDate = $resNews['date'] . " " . $resNews['time'];
	$printInsDateAndTime = $resNews['insDateAndTime'];
	$printNote = $resNews['note'];
	echo "<tr align = 'center'>";
	echo "<td align = 'center'>";
	print "<H4>" . $printUs  . ":</H4>";
	print "Добавлено: " . $printInsDateAndTime . "<br />";
	print "на: " . $printDate . "<br />";
	echo "</td>";
	echo "<td align = 'left'>";
	print "<textarea cols = \"90\" rows = \"6\" class = \"data\" DISABLED>" . $printNote . "</textarea><br />";
	echo "</td>";
	echo "</tr>";
}
$getNews1 = $c->query("SELECT `users`.`id`, `users`.`login`, `friends`.`req_from`,`friends`.`req_to`, 
						`notes`.`user_id`, `notes`.`note`, `notes`.`date`, `notes`.`time`, `notes`.`insDateAndTime`  
						FROM `enote`.`users`, `enote`.`friends`, `enote`.`notes` 
						WHERE `users`.`id` = `notes`.`user_id` 
						AND `notes`.`user_id` = `friends`.`req_to` 
						AND `users`.`id` = `friends`.`req_to` 
						AND `friends`.`req_from` = '$us_id'");
while($resNews1 = $getNews1->fetch(PDO::FETCH_ASSOC))
{
	$printUs1 = $resNews1['login'];
	$printNote1 = $resNews1['note'];
	$printDate1 = $resNews1['date'] . " " . $resNews1['time'];
	$printInsDateAndTime1 = $resNews1['insDateAndTime'];
	echo "<tr align = 'center'>";
	echo "<td align = 'center'>";
	print "<H4>" . $printUs1 . ":</H4>";
	print "Добавлено: " . $printInsDateAndTime1 . "<br />";
	print "на: " . $printDate1 . "<br />";
	echo "</td>";
	echo "<td align = 'left'>";
	print "<textarea cols = \"90\" rows = \"6\" class = \"data\" DISABLED>" . $printNote1 . "</textarea><br /><hr>";
	echo "</td>";
	echo "</tr>";
}
print "</table>";
if ($getNews->rowCount() == 0 && $getNews1->rowCount() == 0)
{
	print "У ваших друзей пока нет заметок";
}
?>
<html>

<head>
<link rel="stylesheet" href="style.css" type = "text/css" />
</head>
</html>