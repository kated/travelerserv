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

	/* $devid = $_GET['uid'];
	$alat = $_GET['lat'];
	$alon = $_GET['lon'];
	$times = $_GET['t'];
	$id = $_GET['id']; */	

	$devid = $_POST['uid'];
	$alat = $_POST['lat'];
	$alon = $_POST['lon'];
	$times = $_POST['t'];
	$id = $_POST['id'];		// If there is an id, then this is the end of an activity
	
	// DBAddFix($aEnduro, 'Android');		// send it to the database
	// spitItOut($aEnduro);	// dump to terminal window

	/* $myFile = "Android_test_activities.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, "Fix: ".$alat .", ". $alon .", ". $devid .", ".$times."\n");
	fclose($fh);	*/

	mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
	mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));
	$query1 = "SELECT id, participant_id FROM devices WHERE identification='".$devid."'";
	
	$result = mysql_query($query1) or die(ErrorLog(mysql_error()));  // ideally this would be a stored proc
	$row = mysql_fetch_array( $result );
	
	$device_id = $row['id'];
	$participant_id = $row['participant_id'];
	
	if ($id == "") {
		$query = "INSERT into activities (participant_id, latitude, longitude, start) VALUES ";
		$query .= "(".$participant_id.",".$alat.",".$alon.",'".$times."')";
		
		mysql_query($query) or die(ErrorLog(mysql_error()));
		echo mysql_insert_id() . "\n";
		echo geoNames($alat, $alon);
		mysql_free_result($result);
	} else {
		$query = "UPDATE activities SET end = '".$times."' WHERE id = ".$id;
		
		mysql_query($query) or die(ErrorLog(mysql_error()));
		mysql_free_result($result);	
	}
	mysql_close();	// clean up your damn mess


	function geoNames($latitude, $longitude) {
	   $geocodeURL = "http://api.geonames.org/findNearby?lat=".$latitude."&lng=".$longitude."&radius=0.5&username=grantdmckenzie&maxRows=10";
	   $ch = curl_init($geocodeURL);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   $result = curl_exec($ch);
	   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   curl_close($ch);
	   $line = "";
	   
	   if ($httpCode == 200) {
	   	  $doc = new SimpleXmlElement($result, LIBXML_NOCDATA);
	   	  $cnt = count($doc->geoname);
	   	  if ($cnt >= 10) 
	   	  	$cnt = 10;
	   	  for ($i=0;$i<$cnt;$i++) {
	   	  		$line .= $doc->geoname[$i]->name . " (";
	   	  		$line .= $doc->geoname[$i]->fcode . ")\n";
	   	  }
	   } else {
	     $line = "HTTP_FAIL_$httpCode";
	   }
	   return $line;
	}
?>