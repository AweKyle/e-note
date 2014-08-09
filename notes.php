<?php
require_once 'includes/session.php';
require_once 'includes/dbconf.php';

include 'write.php';
function getId()
{
	$c = DB::getConn();
	$login = $_SESSION['user'];
	$getId = $c->query("SELECT `id` FROM `enote`.`users` WHERE `login` = '$login'");
	$id = $getId->fetch(PDO::FETCH_ASSOC);
	return $id['id'];
}

function redirect()
{
	print "<script language = \"JavaScript\"> 
					window.location.href = \"notes.php\"
			   </script>";
}

require_once 'pagin.php';

pagination();

function noteInput()
{
	$c = DB::getConn();
	$curDate = $_POST['date'];
	if ($_POST['dm'] == '')
	{
		$dt = date('m');
	}
	else
	{
		$dt = $_POST['dm'];
	}
	$dateMonth = $curDate . "." . $dt;
	$type = $_POST['type'];
	if ($_POST['hours'] != "" && $_POST['minutes'] != "")
	{
	$curTime = $_POST['hours'] . ":" . $_POST['minutes'];
	$newNote = htmlspecialchars($_POST['note']);
	$ID = getId();
	$currentDateTime = date( 'd.m.y H:i' );
	
	if ($newNote != '')
	{
		$inputNote = $c->exec("INSERT INTO `enote`.`notes` (`user_id`, `date`, `time`, `note`, `insDateAndTime`, `type`)
								  VALUES ('$ID', '$dateMonth', '$curTime', '$newNote', '$currentDateTime', '$type')");
		if ($inputNote == false)
		{
			die('ERROR');
		}
		else
		{
			redirect();
		}
	}
	
	}
}
noteInput();

function previewNote()
{
	$c = DB::getConn();
	$ID = getId();
	$checkType = $_POST['viewType'];
	$start = $_POST['start'];
	$limit = $_POST['limit'];
	//$prewNote = mysql_query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` FROM `enote`.`notes` WHERE `user_id` = '$currID'");
	if ($_POST['dataSort'] == "date")
	{
		$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
							   FROM `enote`.`notes` 
							   WHERE `user_id` = '$ID' 
							   ORDER BY `date`, `time` 
							   LIMIT $start, $limit");
	}
	else 
	{
		$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
						   	   FROM `enote`.`notes` 
						       WHERE `user_id` = '$ID' 
						       ORDER BY `insDateAndTime` 
						       LIMIT $start, $limit");
	}
	if ($_POST['viewType'] !== '0' && $_POST['viewType'] == '1')
	{
		if ($_POST['dataSort'] == "date")
		{
			$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
								   FROM `enote`.`notes` 
								   WHERE `user_id` = '$ID' 
								   AND `type` = '1' 
								   ORDER BY `date`, `time` 
								   LIMIT $start, $limit");
		}
		else
		{
			$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
								   FROM `enote`.`notes` 
								   WHERE `user_id` = '$ID' 
								   AND `type` = '1' 
								   ORDER BY `insDateAndTime` 
								   LIMIT $start, $limit");
		}
	}
	elseif($_POST['viewType'] !== '1' && $_POST['viewType'] == '0')
	{
		if ($_POST['dataSort'] == "date")
		{
			$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
								   FROM `enote`.`notes` 
								   WHERE `user_id` = '$ID' 
								   AND `type` = '0' 
								   ORDER BY `date`, `time` 
								   LIMIT $start, $limit");
		}
		else
		{
			$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
								   FROM `enote`.`notes` 
								   WHERE `user_id` = '$ID' 
								   AND `type` = '0' 
								   ORDER BY `insDateAndTime` 
								   LIMIT $start, $limit");
		}
	}
	else
	{
		if ($_POST['dataSort'] == "date")
		{
			$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
								   FROM `enote`.`notes` 
								   WHERE `user_id` = '$ID' 
								   ORDER BY `date`, `time` 
								   LIMIT $start, $limit");
		}
		else
		{
			$prewNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` 
								   FROM `enote`.`notes` 
								   WHERE `user_id` = '$ID' 
								   ORDER BY `insDateAndTime` 
								   LIMIT $start, $limit");
		}
		//$prewNote = mysql_query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` FROM `enote`.`notes` WHERE `user_id` = '$currID'");
	}
	print "<table align = 'center' WIDTH = '100%'>";
	print "<form id = 'myform' method = 'POST' action = ''>";
	print "<th valign = 'top' align = \"left\">";
	print "<p align = \"left\"><input type = \"radio\" name = \"dell\" value = \"1\" id = \"comDel\" class = \"date_d\" onclick='this.form.submit()' />
		    <label for = \"comDel\" onMouseOver=\"this.style.color='#0000ff'\"  onMouseOut=\"this.style.color='#000'\"  >Удалить</label></p>";
	while ($resPreview = $prewNote->fetch(PDO::FETCH_ASSOC))
	{
		$outNote = $resPreview['date'] . " " . $resPreview['time'] . " " . $resPreview['note'];

		$ntID = $resPreview['note_id'];
		$counter = iconv_strlen($outNote);
		if ($counter < '80')
		{
			$result = $outNote;	
		}
		else
		{
			$result = implode(array_slice(explode('<br />',wordwrap($outNote, 80, '<br />', false)), 0, 1));
			$result = $result . "...";
		}
		//$result = implode(array_slice(explode('<br>',wordwrap($outNote,80,'<br>',false)),0,1));
		$dateInput = "Добавлено: " . $resPreview['insDateAndTime'] . "\r" . "\n";
		print "<p align = 'left'>" . $dateInput . "</p>";
		print "<p align = 'justify'><input type=\"checkbox\" name = \"dellNote[]\" value = " . $ntID . " title = \"удалить\" />
		       <input type=\"radio\" name = \"viewID\" value = " . $ntID . " id = " . $ntID . " class = \"date_d\" onclick='this.form.submit()' />
			   <label for = " . $ntID . " onMouseOver=\"this.style.color='#0000ff'\"  onMouseOut=\"this.style.color='#000'\"  >" . $result . "</label></p>";
		$getIdNt = $_POST['viewID'];
		
	}
	print $_POST['paginate'];
	print "</th>";
	print "</form>";
	print "<th valign = 'top'>";
	if (isset($getIdNt))
	{
		print "<form method = \"POST\" action = \"viewnote.php\">";
		print "<input type = \"hidden\" name = \"idd\" value = " . $getIdNt . " />";
		print "<input type = \"submit\" value = \"Редактировать\" />";
		print "</form>";
	}

	include 'viewnote.php';
	print "<br />";
	if($_POST['dellNote'] == TRUE && $_POST['dell'] == 1)
	{
		$idDelNote = $_POST['dellNote'];
		$size = sizeof($idDelNote);
		for ($i = 0; $i < $size; $i++)
		{
			$deleteNote = $c->exec("DELETE FROM `enote`.`notes` WHERE `note_id` = '$idDelNote[$i]'");
		}
		redirect();
	}

	print "</th>";
	print "</table>";
}
previewNote();

?>