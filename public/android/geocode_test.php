<?php
    ini_set('display_errors','On');
	include("android_functions.php");
	
	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	
	echo geoCode3($lat, $lng);
	
?>