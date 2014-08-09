<?php
require_once 'includes/session.php';
require_once 'includes/dbconf.php';

function viewNote()
{
	$c = DB::getConn();
	$idNote = $_POST['viewID'];
	$outputNote = $c->query("SELECT `note_id`, `date`, `time`, `note`, `insDateAndTime` FROM `enote`.`notes` WHERE `note_id` = '$idNote'");
	print "<p align = \"center\"><textarea cols = \"90\" rows = \"20\" class = \"data\" DISABLED>";
	while($resOutput = $outputNote->fetch(PDO::FETCH_ASSOC))
	{
		$dateInput = "			 ~~~ Добавлено: " . $resOutput['insDateAndTime'] . " ~~~\r" . "\n";
		$resNote = $resOutput['date'] . " " . $resOutput['time'] . " " . $resOutput['note'] . "\r" . "\n";
		$qq = $resOutput['note_id'];
		print $dateInput;
		print $resNote;
	}
	print "</textarea></p>";

}	

function edtNote()
{
	$c = DB::getConn();
	$idNote = $_POST['idd'];
	$outputNote = $c->query("SELECT `note` FROM `enote`.`notes` WHERE `note_id` = '$idNote'");
	print "<form method = \"POST\" action = \"upd.php\"><p align = \"center\"><textarea name = \"newVal\" cols = \"90\" rows = \"20\">";
	while($resOutput = $outputNote->fetch(PDO::FETCH_ASSOC))
	{
		$resNote = $resOutput['note'] . "\r" . "\n";
		print $resNote;
	}
	print "</textarea></p>
			<input type = \"hidden\" name = \"id\" value = ".$idNote." />
			<input type = \"submit\" name = \"ok\" value = \"ok\" /></form>";

}	

if (!isset($_POST['idd']))
{
	viewNote();
}
else
{
	edtNote();
}
?>
