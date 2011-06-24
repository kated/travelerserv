<?php 

	/* =================================================================================
	Author: Grant McKenzie (grantmckenzie.com)
	Client: GeoTrans Lab UCSB
	Date: April 2011
	Project: travelerserv
	Description: Stores android activities.
	==================================================================================== */
	require('android_functions.php');
	date_default_timezone_set('America/Vancouver');
	error_reporting(E_ALL | E_STRICT);

	$devid = $_POST['uid'];
	$alat = $_POST['lat'];
	$alon = $_POST['lon'];
	$times = $_POST['t'];
	
	// DBAddFix($aEnduro, 'Android');		// send it to the database
	// spitItOut($aEnduro);	// dump to terminal window

	$myFile = "Android_test_activities.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, "Fix: ".$alat .", ". $alon .", ". $devid .", ".$times."\n");
	fclose($fh);	

?>