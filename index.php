<?php
session_start();
header('Content-Type: text/html; charset=utf8');
if (isset($_SESSION['user'])) 
{
	//header("Refresh: 3; url=notes.php");
	print "<p align =\"center\">";
    print "Привет, " . $_SESSION['user'] . ", спасибо что зашли. 
    Нажмите <a href='notes.php'>(Перейти)</a></p>";
}
else 
{
    $auth = <<< AUTH
    <form method = "POST" action = "auth.php">
    <table>
        <tr>
            <td>Логин</td>
            <td><input type = "text" name = "login"></td>
            <td>Пароль</td>
            <td><input type = "password" name = "password"></td>
        </tr>
        <tr>
            <td colspan = "2"><input type = "submit" value = "Войти"></td>
		    <td colspan = "2"><input type = "button" value = "Регистрация" onclick = "location.href='reg.html'" /></td>
		<tr>
		    <td colspan = "2"><input type = "button" value = "Забыли пароль?" onclick = "location.href='rempass.html'" /></td>
        </tr>
	</table>
    </form>
AUTH;
    print $auth;
}
?>