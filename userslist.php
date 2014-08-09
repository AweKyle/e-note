<?php
include 'includes/session.php';
include 'includes/dbconf.php';

$c = DB::getConn();

$userList = $c->query("SHOW FIELDS FROM `enote`.`users` WHERE field = 'login' OR field = 'email' OR field = 'age'");
$usList = $c->query("SELECT `login`, `email`, `age` FROM `enote`.`users`");
print "<table border = 3 align = 'center' rules = 'rows' WIDTH = '60%'><br />";
while ($row = $userList->fetch(PDO::FETCH_ASSOC))
{
	print "<th>" . $row['Field'] . "</th>";
}
while ($coll = $usList->fetch(PDO::FETCH_ASSOC))
{
	print "<tr><td>" . $coll['login'];
	print "</td><td>" . $coll['email'];
	print "</td><td>" . $coll['age'] . "</td></tr>";
}
print "</table>";
?>