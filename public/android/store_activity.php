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

	mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
	mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));
	
	// Get device id, participant id and their most recent trip id
	$query1 = "SELECT devices.id, devices.participant_id, max(trips.id) as tripid FROM devices, trips WHERE devices.identification = '".$devid."'  AND devices.participant_id = trips.participant_id";
	$result = mysql_query($query1) or die(ErrorLog(mysql_error()));  // ideally this would be a stored proc
	$row = mysql_fetch_array( $result );
	
	$device_id = $row['id'];
	$participant_id = $row['participant_id'];
	$recenttrip = $row['tripid'];
	
	// If No ID, then it is a new activity
	if ($id == "") {
		
		// Insert a new activity into the activities table.
		$query = "INSERT into activities (participant_id, latitude, longitude, start) VALUES ";
		$query .= "(".$participant_id.",".$alat.",".$alon.",'".$times."')";
		mysql_query($query) or die(ErrorLog(mysql_error()));
		$actID = mysql_insert_id();
		// return the new activity id
		echo $actID . "\n";
	
		// return the geocoded results
		echo foursquare($alat, $alon);
		echo googleMaps($alat, $alon);
		echo geoNames($alat, $alon);
		
		// Insert the activity into the travel_fixes table.
		$aEnduro = array("",$devid,"","","","",-9,"",-9,1,floatval($alon),floatval($alat),$times); 
		$query3 = "INSERT into travel_fixes (participant_id, latitude, longitude, altitude, speed, accuracy, device_id, positioning_method, created_at, updated_at, parent_id, parent_type) VALUES ";
		$query3 .= "(".$participant_id.",".$aEnduro[11].",".$aEnduro[10].",".$aEnduro[8].",".$aEnduro[6].",".$aEnduro[9].",".$device_id.",'Android','".formatDate($aEnduro[12])."','".formatDate($aEnduro[12])."',".$actID.",'activity')";
		mysql_query($query3) or die(ErrorLog(mysql_error()));
		
		// Update the end time of the most recent trip
		$query4 = "UPDATE trips SET end = '".formatDate($aEnduro[12])."' WHERE id = ".$recenttrip;
		mysql_query($query4) or die(ErrorLog(mysql_error()));
		
	// If there is an ID, then update that activity with the end time.
	} else {
		$query = "UPDATE activities SET end = '".$times."' WHERE id = ".$id;
		mysql_query($query) or die(ErrorLog(mysql_error()));
	}
	
	mysql_free_result($result);
	mysql_close();	// clean up your damn mess



	function geoNames($latitude, $longitude) {
	   $geocodeURL = "http://api.geonames.org/findNearby?lat=".$latitude."&lng=".$longitude."&radius=0.5&username=grantdmckenzie&maxRows=10";
	   $ch = curl_init($geocodeURL);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   $result = curl_exec($ch);
	   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   curl_close($ch);
	   $line = "=== GEONAMES ===\n ---" . date('l jS \of F Y h:i:s A') . "---\n";
	   
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
	function foursquare($latitude, $longitude) {
	   $geocodeURL = "https://api.foursquare.com/v2/venues/search?ll=".$latitude.",".$longitude."&oauth_token=5ZKJSP5O1T01HO0EMVYYX52245QZIGTZELIQRVNYCGYOOR21&v=20110803";
	   $ch = curl_init($geocodeURL);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   $result = curl_exec($ch);
	   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   curl_close($ch);
	   $line = "=== FOURSQUARE ===\n ---" . date('l jS \of F Y h:i:s A') . "---\n";
	   
	   if ($httpCode == 200) {
	   		$obj = json_decode($result);
	   		for($i=0;$i<count($obj->response->venues);$i++) {
	   			$line .= $obj->response->venues[$i]->name . " ";
	   			for($j=0;$j<count($obj->response->venues[$i]->categories);$j++) {
	   				$line .= "(" . $obj->response->venues[$i]->categories[$j]->name . ")";
	   			}
	   			$line .= "\n";
	   		}
	   } else {
	     $line = "HTTP_FAIL_$httpCode";
	   }
	   return $line;
	}
	function googleMaps($latitude, $longitude) {
	   $geocodeURL = "https://maps.googleapis.com/maps/api/place/search/xml?location=".$latitude.",".$longitude."&radius=500&sensor=false&key=AIzaSyAdstnf_J0wjHZAJZLTItVrO7qQDzgHAYI";
	   $ch = curl_init($geocodeURL);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   $result = curl_exec($ch);
	   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   curl_close($ch);
	   $line = "=== GOOGLE ===\n ---" . date('l jS \of F Y h:i:s A') . "---\n";

	   if ($httpCode == 200) {
	   	  $doc = new SimpleXmlElement($result, LIBXML_NOCDATA);
	   	  $cnt = count($doc->result);
	   	  if ($cnt >= 10) 
	   	  	$cnt = 10;
	   	  for ($i=0;$i<$cnt;$i++) {
	   	  		$viscount = $i+1;
	   	  		$line .= $viscount . ". " . $doc->result[$i]->name . " (";
	   	  		$typecnt = count($doc->result[$i]->type);
	   	  		for ($j=0;$j<$typecnt;$j++) {
	   	  			$line .= $doc->result[$i]->type[$j] . " ";
	   	  		}
	   	  		$line .= ")\n";
	   	  }
	   } else {
	     $line = "HTTP_FAIL_$httpCode";
	   }
	   return $line;
	}
?>