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
$allUsersFriends = $c->query("SELECT `id`, `login`, `email`, `name`, `surname`, `age` FROM `enote`.`users` WHERE `id` in 
							  ( SELECT DISTINCT `req_from` FROM `enote`.`friends` WHERE `req_from` = '$us_id' or `req_to` = '$us_id') and `id` != '$us_id'");

print("<table border=3 align = 'center' rules = 'rows' WIDTH = '60%'>\n");
while($friend = $allUsersFriends->fetch(PDO::FETCH_ASSOC))
{
	//$_POST['fr_id'] = $friend['id'];
	//$friendID = $friend['id'];
	$printResoutLogin = $friend['login'];
	$printResoutEmail = $friend['email'];
	$printResoutName = $friend['name'];
	$printResoutSurname = $friend['surname'];
	$printResoutAge = $friend['age'];
	echo "<tr align = 'center'>";
	echo "<td align = 'center'>";
	print $printResoutLogin . " ";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutEmail . "<br />";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutName . " ";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutSurname . "<br />";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutAge . "<br />";
	echo "</td>";
	echo "</tr>";	
}

//$friendID = $_POST['fr_id'];
$allUsersFriends1 = $c->query("SELECT `login`, `email`, `name`, `surname`, `age` FROM `enote`.`users` WHERE `id` in 
							   ( SELECT DISTINCT `req_to` FROM `enote`.`friends` WHERE `req_from` = '$us_id' or `req_to` = '$us_id') and `id` != '$us_id'");
while($friend1 = $allUsersFriends1->fetch(PDO::FETCH_ASSOC))
{
	$printResoutLogin1 = $friend1['login'];
	$printResoutEmail1 = $friend1['email'];
	$printResoutName1 = $friend1['name'];
	$printResoutSurname1 = $friend1['surname'];
	$printResoutAge1 = $friend1['age'];
	echo "<tr align = 'center'>";
	echo "<td align = 'center'>";
	print $printResoutLogin1 . " ";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutEmail1 . "<br />";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutName1 . " ";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutSurname1 . "<br />";
	echo "</td>";
	echo "<td align = 'center'>";
	print $printResoutAge1 . "<br />";
	echo "</td>";
	echo "</tr>";	
}
print("</table>\n");
?>