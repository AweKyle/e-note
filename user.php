<?php
error_reporting(E_ALL);
include 'includes/session.php';
include 'includes/dbconf.php';

function clear()
{
	$c = DB::getConn();
	$allDell = $_POST['fullDell'];
	$delID = $_POST['userID'];
	$allNoteDelete = $c->query("DELETE FROM `enote`.`$allDell` WHERE `user_id` = '$delID'");
}

$c = DB::getConn();

$user_id = $c->query("SELECT `id` FROM `enote`.`users` WHERE `login` = '$userName'");
while($res = $user_id->fetch(PDO::FETCH_ASSOC))
{
	$_POST['userID'] = $res['id'];
}
	
$ID = $_POST['userID'];


$countNote = $c->query("SELECT * FROM `enote`.`notes` WHERE `user_id` = '$ID'");
$printNum = $countNote->rowCount();
print "<form method = \"POST\" action = \"\">";
	print "<br />Всего заметок: " . $printNum . "<input type = \"hidden\" name = \"fullDell\" value = \"notes\" />
											<input type = \"submit\" value = \"удалить все\" />";
print "</form>";
if (isset($_POST['fullDell']))
{
	clear();
}

/*print " <form method = \"POST\" action = \"notes.php\">
		<input type = \"hidden\" name = \"fullDell\" value = \"notes\" />
		<input type = \"submit\" value = \"удалить все\" />
		</form>";*/

$countPNote = $c->query("SELECT * FROM `enote`.`notes` WHERE `user_id` = '$ID' AND `type` = '1'");
$printPNum = $countPNote->rowCount();
print "Публичных заметок: " . $printPNum . "<br />";

$checking = $c->query("SELECT * FROM `enote`.`friends` WHERE `req_to` = '$ID' AND `req_stat` = '0'");
if ($checking->rowCount() > 0)
{
print "Вас хотят добавить в друзья";
include 'friendconf.html';
}

$friendNum = $c->query("SELECT * FROM `enote`.`friends` WHERE `req_to` = '$ID' OR `req_from` = '$ID'");
$printFNum = $friendNum->rowCount();
print "У вас : " . $printFNum . " друзей. <a href = \"friendlist.php\">Посмотреть всех</a><br />";

$outputss = $c->query("SELECT `login`, `email`, `name`, `surname`, `age` FROM `enote`.`users` WHERE `login` = '$userName'");
while ($row = $outputss->fetch(PDO::FETCH_ASSOC)) 
	{
	print "Ваши данные:<a href = 'update.html'>(редактировать)</a><br>";
	print "Логин: " . $row["login"];
	print "<br> Электронная почта: " . $row["email"];
	if ($row['name'] == "")
		{
		$row['name'] = 'не указано';
		}
	if ($row['surname'] == "")
		{	
		$row['surname'] = 'не указано';
		}
	if ($row['age'] == ""||$row['age'] == "0")
		{
		$row['age'] = 'не указано';
		}
	print "<br> Имя: " . $row["name"];
	print "<br> Фамилия: " . $row["surname"];
	print "<br> Возраст: " . $row["age"];
	}
print "<br />Здесь вы так же можете <a href = 'np.html'>ИЗМЕНИТЬ</a> или <a href = 'rempass.html'>ВОССТАНОВИТЬ</a> пароль.";
print "<br />Введите email или логин пользователя, которого хотите добавить в друзья: <br/>";
include 'friendadd.html';
print '<br /><a style="text-decoration:none" href="http://localhost/e-note.p/notes.php"><<назад</a>';

?>