<?php 

	/*
	 * Project: UCSBGeoTrackerGPS
	 * Author: Grant McKenzie
	 * Date: October 2011
	 * Client: GeoTrans Lab @ UCSB
	 * Description: Store GPS Fix in database. 
	 */
	 
	date_default_timezone_set('America/Vancouver');
	error_reporting(E_ALL | E_STRICT);

	$devid = $_POST['devid'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$ts = $_POST['t'];
	/* $devid = $_GET['devid'];
	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	$ts = $_GET['t']; */

	mysql_connect("localhost", "ucsbgeotracker", "ucsbgeotracker123") or die(ErrorLog(mysql_error()));
	mysql_select_db("ucsbgeotrackergps") or die(ErrorLog(mysql_error()));

	if ($devid != "" && $lat != "") {
		$query = "SELECT id FROM users WHERE deviceid = '".$devid."'";
		$result = mysql_query($query) or die(ErrorLog(mysql_error()));	
		$num_rows = mysql_num_rows($result);
		if ($num_rows != NULL) {
			while($row = mysql_fetch_array($result)){
				$parcip = $row['id'];
			}
			$query2 = "INSERT INTO fixes VALUES ('',".$parcip.",".$lat.",".$lng.",'".$ts."')";
			// echo $query2;
			$result2 = mysql_query($query2) or die(ErrorLog(mysql_error()));
			echo 1;
			mysql_free_result($result2);
		}
		mysql_free_result($result);
	}
	
	mysql_close();
	
	function ErrorLog($error) {
		$myFile = "AndroidErrors.log";
		$fh = fopen($myFile, 'a') or die("can't open file");
		$currentDate = date('Y-m-d H:i:s');
		$msg = "> ".$currentDate."  -  ".$error."\n";
		fwrite($fh, $msg);
		fclose($fh);
	}
?>