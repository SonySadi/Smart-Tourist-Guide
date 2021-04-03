<?php
session_start();
include('./../connection.php');

$id = $_SESSION['id'];
$likes = $_SESSION['ulike']; // user links about the plan 
$city = $_SESSION['ucity'];
$str = "";
$_SESSION['ival'] = 1;
$lat_long = "";


for ($i = 1; $i < $_SESSION['index']; $i++) {
	if ($i == $_SESSION['index'] - 1) {
		$lat_long .= $_SESSION['lat'][$_SESSION['ival']] . ',' . $_SESSION['lng'][$_SESSION['ival']];
	} else {
		$lat_long .= $_SESSION['lat'][$_SESSION['ival']] . ',' . $_SESSION['lng'][$_SESSION['ival']] . ',';
	}
	$_SESSION['ival'] = $_SESSION['ival'] + 1;
}

$str = "";
$venues = ",";
for ($i = 0; $i < strlen($likes) - 1; $i++) {
	if ($likes[$i] == ",") {
		$venues .= $_SESSION[$str] . ",";
		$str = "";
	} else {
		$str .= $likes[$i];
	}
}

$venues .= $_SESSION[$str];
$str = "";

$_SESSION['ival'] = 1;
