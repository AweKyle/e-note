<?php
session_start();
if (isset($_SESSION['user']))
	{
	unset($_SESSION['user']);
	}
if (isset($_SERVER['HTTP_REFERER']))
	{
	//header("location: http://localhost/e-note/index.php ");
	header("location:" . $_SERVER['HTTP_REFERER']);
	}
else
	{
	header("location:" . $_SERVER['HTTP_REFERER']);
	}
?>