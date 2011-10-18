<?php
	/*
	 * Project: UCSBGeoTrackerGPS
	 * Author: Grant McKenzie
	 * Date: October 2011
	 * Client: GeoTrans Lab @ UCSB
	 * Description: Login script.  Returns 1 if user/password match.  Also updates device ID.
	 */
	
	// ini_set('display_errors','On');

	/* $devid = $_GET['devid'];
	$user = $_GET['u'];
	$pass = $_GET['p']; */
	$devid = $_POST['devid'];
	$user = $_POST['u'];
	$pass = $_POST['p'];
	$match = 0;
	$parcip = "";
	
	mysql_connect("localhost", "ucsbgeotracker", "ucsbgeotracker123") or die(ErrorLog(mysql_error()));
	mysql_select_db("ucsbgeotrackergps") or die(ErrorLog(mysql_error()));


	$query1 = "SELECT id, deviceid FROM users WHERE username ='".$user."' and password = '".$pass."'";
	$result = mysql_query($query1) or die(mysql_error());
	
	$num_rows = mysql_num_rows($result);
	if ($num_rows != NULL) {
		while($row = mysql_fetch_array($result)){
			$parcip = $row['id'];
			if ($row['deviceid'] == $devid) {
				$match = 1;
			} else {
				$match = 2;	
			}
		}
	}
	if ($match == 1) {
		echo 1;	
	} else if ($match == 2) {
		$query2 = "UPDATE users SET deviceid = '".$devid."' WHERE id = ".$parcip;
		mysql_query($query2) or die(mysql_error());
		echo 1;
	} else {
		echo 0;	
	}
	mysql_free_result($result);
	mysql_close();

	function ErrorLog($error) {
		$myFile = "EnduroErrors.log";
		$fh = fopen($myFile, 'a') or die("can't open file");
		$currentDate = date('Y-m-d H:i:s');
		$msg = "> ".$currentDate."  -  ".$error."\n";
		fwrite($fh, $msg);
		fclose($fh);
	}
?>