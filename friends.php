<?php
include 'includes/session.php';
include 'includes/dbconf.php';

$c = DB::getConn();

function redirect($path)
{
	echo "<script language = \"JavaScript\"> 
					window.location.href = ".$path."
			   </script>";
}

if (isset($_POST['email']))
{
	$frMail = trim($_POST['email']);
	$friend_id = $c->query("SELECT `id` FROM `enote`.`users` WHERE `email` = '$frMail' OR `login` = '$frMail'");
	while($frRes = $friend_id->fetch(PDO::FETCH_ASSOC))
	{
		$_POST['friendID'] = $frRes['id'];
	}
	$user_id = $c->query("SELECT `id` FROM `enote`.`users` WHERE `login` = '$userName'");
	while($usRes = $user_id->fetch(PDO::FETCH_ASSOC))
	{
		$_POST['userID'] = $usRes['id'];
	}
}

function friend_request_add()
{
	$outUsID = $_POST['userID'];
	$outFrID = $_POST['friendID'];
	$db = new DB;
	$c = $db->getConn();
	if ($outUsID != '' && $outFrID != '')
	{
		$reqAdd = $c->query("INSERT INTO `enote`.`friends` (`req_from`, `req_to`) VALUES ('$outUsID', '$outFrID') "); //WHERE (`req_from` AND `req_to`) <> (`req_to` AND `req_from`)
		if($reqAdd == true)
		{
			print "Ваша заявка в друзья отправлена";
			print "<script language = \"JavaScript\"> 
					window.location.href = \"user.php\"
				   </script>";
		}
		else
		{
			print "Вы уже добавили этого пользователя в друзья";
		}
	}
}
friend_request_add();

function friend_request_confirm()
{
	$db = new DB;
	$c = $db->getConn();
	$insUsID = $_POST['userID'];
	$insFrID = $_POST['friendID'];
	$confirm = $_POST['confirm'];
	if (isset($confirm))
	{
		$reqConf = $c->query("UPDATE `enote`.`friends` SET `req_stat` = '$confirm' WHERE `req_to` = '$insUsID' and `req_stat` = '0'");
		if ($reqConf == true)
		{
			print "Заявка принята";
			redirect($path = 'user.php');
		}
	}
}
friend_request_confirm();

function friend_request_cancel()
{
	$db = new DB;
	$c = $db->getConn();
	$us_id1 = $_POST['userID'];
	$cancel = $_POST['cancel'];
	if (isset($cancel))
	{
		$cancelFriend = $c->query("DELETE FROM `enote`.`friends` WHERE `req_to` = '$us_id1' AND `req_stat` = '0'");
		if ($cancelFriend == true)
		{
			print "Заявка отклонена";
			redirect($path = 'user.php');
		}
		else {print "fail";}
	}
}
friend_request_cancel();
?>