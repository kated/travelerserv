<?php 

	/* =================================================================================
	Author: Grant McKenzie (grantmckenzie.com)
	Basic concept taken from Drew Dara-Abrams' Ruby code
	Client: GeoTrans Lab UCSB
	Date: April 2011
	Project: travelerserv
	Description: This script accepts all incoming UDP packets from the Enduro Device
	==================================================================================== */
	require('android_functions.php');
	date_default_timezone_set('America/Vancouver');
	error_reporting(E_ALL | E_STRICT);

	$devid = $_POST['uid'];
	$alat = $_POST['lat'];
	$alon = $_POST['lon'];
	$times = $_POST['t'];
	$newtrip = $_POST['new'];
	$fixprovider = $_POST['provider'];
	$aEnduro = array("",$devid,"","","","",-9,"",-9,1,floatval($alon),floatval($alat),$times); 
	
	// ErrorLog($devid . "|" . $lat);
	
	if ($aEnduro[10] != 0 and $aEnduro[11] != 0) {	// and it has a valid lat/lon
		DBAddFix($aEnduro, $fixprovider, $newtrip);		// send it to the database
		// ErrorLog($times." - ".$newtrip."\n");
	}
	
?>