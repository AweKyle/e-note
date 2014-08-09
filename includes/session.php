<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting('E_ALL, ~E_NOTICE');
?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//RU" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
	<title></title>
</head>
<body>

</body>
</html>
<?php
if (!isset($_SESSION['user']))
{
	print "<a href = \"index.php\">Авторизуйтесь!!!</a>";
	exit(0);
}
else
{
	$userName = $_SESSION['user'];
	print "<table align = 'center' width = '100%'>";
	print "<th align = 'left'><a href = \"notes.php\">Мои заметки</a></th>";
	print "<th align = 'left'><a href = \"userslist.php\">Пользователи</a></th>";
	print "<th align = 'left'><a href = \"friendlist.php\">Друзья</a></th>";
	print "<th align = 'left'><a href = \"freindnews.php\">Заметки друзей</a></th>";
	print "<th align = 'right'>Привет <a href = \"user.php\">" . $userName . "</a>. Спасибо, что зашли! <a href = \"logout.php\">Выход</a></th>";
	print "</table>";
}
?>