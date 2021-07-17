<?php
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	session_destroy();

	RedirectTo('index.php');

?>