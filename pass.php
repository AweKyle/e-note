<?php
$email = $_POST['email'];
include 'includes/dbconf.php';

$c = DB::getConn();
$emailquery = $c->query("SELECT `email` FROM `enote`.`users` WHERE `email` = '$email'");
if ($emailquery)
	{
	$symvols = array("0","1","2","3","4","5","6","7","8","9",
					 "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
                     "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	for ($key = 0; $key < 7; $key++)
		{
		shuffle($symvols);
		$newpass = $newpass.$symvols[1];
		}
	$mdpass = md5($newpass);
	
	$inspass = $c->query("UPDATE `enote`.`users` SET `pass`='$mdpass' WHERE `email`='$email'");
	if ($inspass)
	print "Пароль был изменен и отправлен вам на почту.<br />\n";
	else die('ERROR');
	
	$row = $emailquery->fetch(PDO::FETCH_ASSOC);
	$getmail = $row['email'];
		
	$login = $c->query("SELECT `login` FROM `enote`.`users` WHERE `email`='$email'");
	
			$getrow = $login->fetch(PDO::FETCH_ASSOC);
			$getlogin = $getrow['login'];
	//*
	print "Ваш email:" . $getmail . "<br>Ваш логин:" . $getlogin . "<br>Ваш новый пароль:" . $newpass;
	print '<br><a style="text-decoration:none" href="http://localhost/e-note.p/notes.php"><<назад</a>';
	/*/
	$from = 'kyle.voronin@gmail.com';
	$title = "Запрос на восстановление пароля";
	$message = "Здравствуйте $getlogin . Ваш новый пароль: $newpass .";
	mail($getmail,$title, $message, $from );
	// */
	}

?>