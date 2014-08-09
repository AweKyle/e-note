<?php
require_once 'includes/session.php';
include 'includes/dbconf.php';

$c = DB::getConn();

$id = $_POST['id'];
$newVal = $_POST['newVal'];

$upd = $c->exec("UPDATE `enote`.`notes` SET `note` = '$newVal' WHERE `note_id` = '$id'");
if($upd)
{
	print "<script language = \"JavaScript\"> 
				window.location.href = \"notes.php\"
		   </script>";
}
?>