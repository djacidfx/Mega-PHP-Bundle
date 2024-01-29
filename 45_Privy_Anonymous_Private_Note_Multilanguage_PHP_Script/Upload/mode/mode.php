<?php
switch ($_SESSION['mode']) {
case 'light':
	include_once "light_mode.php";
	break;
case 'dark':
	include_once "dark_mode.php";
	break;
default:
	$_SESSION['mode'] = DEFAULT_MODE;
	include_once DEFAULT_MODE."_mode.php";
	break;
}
?>
