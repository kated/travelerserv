<?php
	/* =================================================================================
	Author: Grant McKenzie (grantmckenzie.com)
	Client: GeoTrans Lab UCSB
	Date: April 2011
	Project: travelerserv
	Description: Functions file for the enduro_server.php script
	==================================================================================== */
	
	// Send enduro array values to the database
	function DBAddFix($aEnduro, $dev) {
		/* $myFile = "enduroTest.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		fwrite($fh, $aEnduro[1].",");
		fwrite($fh, $aEnduro[6].",");
		fwrite($fh, $aEnduro[8].",");
		fwrite($fh, $aEnduro[9].",");
		fwrite($fh, $aEnduro[10].",");
		fwrite($fh, $aEnduro[11].",");
		fwrite($fh, formatDate($aEnduro[12])."\n");
		fclose($fh); */
		/*echo $aEnduro[1] . ", ";						// imei (device id)
		echo $aEnduro[6] . ", ";						// speed
		echo $aEnduro[8] . ", ";						// altitude (m)
		echo $aEnduro[9] . ", ";						// accuracy
		echo $aEnduro[10] . ", ";						// lon
		echo $aEnduro[11] . ",";						// lat
		echo formatDate($aEnduro[12]) . "\n";			// date */
		
		mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
		mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));
		$query1 = "SELECT id, participant_id FROM devices WHERE identification='".$aEnduro[1]."'";
		
		$result = mysql_query($query1) or die(ErrorLog(mysql_error()));  // ideally this would be a stored proc
		$row = mysql_fetch_array( $result );
		
		$device_id = $row['id'];
		$participant_id = $row['participant_id'];
		
		$query = "INSERT into travel_fixes (participant_id, latitude, longitude, altitude, speed, accuracy, device_id, positioning_method, created_at, updated_at) VALUES ";
		$query .= "(".$participant_id.",".$aEnduro[11].",".$aEnduro[10].",".$aEnduro[8].",".$aEnduro[6].",".$aEnduro[9].",".$device_id.",'".$dev."','".formatDate($aEnduro[12])."','".formatDate($aEnduro[12])."')";
		
		mysql_query($query) or die(ErrorLog(mysql_error()));
		mysql_free_result($result);
		mysql_close();	// clean up your damn mess
	}
	
	function DBAddActivity($lon, $lat, $datetime, $devId) {
		mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
		mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));
		
		$result = mysql_query("SELECT participant_id FROM devices WHERE identification='".$devId."'") or die(ErrorLog(mysql_error()));  // ideally this would be a stored proc
		$row = mysql_fetch_array( $result );

		$participant_id = $row['participant_id'];
		
		$query = "INSERT into activities (participant_id, latitude, longitude, start) VALUES ";
		$query .= "(".$participant_id.",".$lat.",".$lon.",'".$datetime."')";
		// echo $query . "\n";
		mysql_query($query) or die(ErrorLog(mysql_error()));
		mysql_free_result($result);
		mysql_close();	// clean up your damn mess
		
		// send email
	    $to = "grantdmckenzie@gmail.com";
	    $subject = "GeoGremlin found you!";
		$body = "The results from your recent activity at ".$lat.", ".$lon.":\n\n";

		$body .= geoCode($lat, $lon);
		$body .= geoCode2($lat, $lon);
		if (mail($to, $subject, $body)) {
			// echo("<p>Message successfully sent!</p>");
		} else {
			ErrorLog("Message delivery failed");
		}
	}
	function geoCode($latitude, $longitude) {
	   $geocodeURL = "https://maps.googleapis.com/maps/api/place/search/xml?location=".$latitude.",".$longitude."&radius=500&sensor=false&key=AIzaSyAdstnf_J0wjHZAJZLTItVrO7qQDzgHAYI";
	   $ch = curl_init($geocodeURL);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   $result = curl_exec($ch);
	   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   curl_close($ch);
	   $line = "GOOGLE " . date('l jS \of F Y h:i:s A') . "\n-------------------\n";
	   
	   /* $myFile = "activity.log";
	   $fh = fopen($myFile, 'a') or die("can't open file");
	    fwrite($fh, "GOOGLE " . date('l jS \of F Y h:i:s A') . "\n");
	   fwrite($fh, "----------------------\n"); */
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
	   /* fwrite($fh, $line);
	   fclose($fh); */
	}
	
	function geoCode2($latitude, $longitude) {
	   $geocodeURL = "http://api.geonames.org/findNearby?lat=".$latitude."&lng=".$longitude."&radius=0.5&username=grantdmckenzie&maxRows=10";
	   $ch = curl_init($geocodeURL);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   $result = curl_exec($ch);
	   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   curl_close($ch);
	   $line = "";
	   
	   /* $myFile = "activity.log";
	   $fh = fopen($myFile, 'a') or die("can't open file");
	   fwrite($fh, "GEONAMES " . date('l jS \of F Y h:i:s A') . "\n");
	   fwrite($fh, "----------------------\n"); */
	   if ($httpCode == 200) {
	   	  $doc = new SimpleXmlElement($result, LIBXML_NOCDATA);
	   	  $cnt = count($doc->geoname);
	   	  if ($cnt >= 10) 
	   	  	$cnt = 10;
	   	  for ($i=0;$i<$cnt;$i++) {
	   	  		$viscount = $i+1;
	   	  		$line .= $viscount . ". " . $doc->geoname[$i]->name . " (";
	   	  		$line .= $doc->geoname[$i]->fcode . ")\n";
	   	  }
	   } else {
	     $line = "HTTP_FAIL_$httpCode";
	   }
	   return $line;
	   /* fwrite($fh, $line);
	   fclose($fh); */
	}
	
	function spitItOut($aEnduro) {
	
		echo $aEnduro[1] . ", ";						// imei (device id)
		echo $aEnduro[6] . ", ";						// speed
		echo $aEnduro[8] . ", ";						// altitude (m)
		echo $aEnduro[9] . ", ";						// accuracy
		echo $aEnduro[10] . ", ";						// lon
		echo $aEnduro[11] . ", ";						// lat
		echo formatDate($aEnduro[12]) . "\n";			// date
		
	}
	function writeToFile($aEnduro) {
		$myFile = "Activities_test2.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		fwrite($fh, "Fix: ".$aEnduro[11] .", ". $aEnduro[10] .", ". $aEnduro[12] .", ".$aEnduro[9]."\n");
		fclose($fh);	
	}
	
	// Takes in Enduro date and returns properly formated date
	function formatDate($idate) {
		return date('Y-m-d H:i:s', strtotime($idate));
	}
	
	// Vincenty for caculating distance between two decimal degree points.
	// returns distance in meters
	function CalculateDist($lat1,$lat2,$lon1,$lon2){ 
	    $a = 6378137;
	    $b = 6356752.314245;  
	    $f = 1/298.257223563; 
	
	    $p1_lat = $lat1/57.29577951; 
	    $p2_lat = $lat2/57.29577951; 
	    $p1_lon = $lon1/57.29577951; 
	    $p2_lon = $lon2/57.29577951; 
	
	    $L = $p2_lon - $p1_lon; 
	
	    $U1 = atan((1-$f) * tan($p1_lat)); 
	    $U2 = atan((1-$f) * tan($p2_lat)); 
	
	    $sinU1 = sin($U1); 
	    $cosU1 = cos($U1); 
	    $sinU2 = sin($U2); 
	    $cosU2 = cos($U2); 
	
	    $lambda = $L; 
	    $lambdaP = 2*M_PI; 
	    $iterLimit = 20; 
	  
	    while(abs($lambda-$lambdaP) > 1e-12 && $iterLimit>0) { 
	        $sinLambda = sin($lambda); 
	        $cosLambda = cos($lambda); 
	        $sinSigma = sqrt(($cosU2*$sinLambda) * ($cosU2*$sinLambda) + ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda) * ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda)); 
 
	        $cosSigma = $sinU1*$sinU2 + $cosU1*$cosU2*$cosLambda; 
	        $sigma = atan2($sinSigma, $cosSigma); 
	        if ($sinSigma == 0) { $sinSigma = 0.0000000000000000001; }
	        $alpha = asin($cosU1 * $cosU2 * $sinLambda / $sinSigma); 
	        $cosSqAlpha = cos($alpha) * cos($alpha); 
	        $cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha; 
	        $C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha)); 
	        $lambdaP = $lambda; 
	        $lambda = $L + (1-$C) * $f * sin($alpha) * ($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM))); 
	    } 
	
	    $uSq = $cosSqAlpha*($a*$a-$b*$b)/($b*$b); 
	    $A = 1 + $uSq/16384*(4096+$uSq*(-768+$uSq*(320-175*$uSq))); 
	    $B = $uSq/1024 * (256+$uSq*(-128+$uSq*(74-47*$uSq))); 
	  
	    $deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM))); 
	  
	    $s = $b*$A*($sigma-$deltaSigma); 
	    return $s; // return distance in meters. 
	} 
	function ErrorLog($error) {
		$myFile = "EnduroErrors.log";
		$fh = fopen($myFile, 'a') or die("can't open file");
		$currentDate = date('Y-m-d H:i:s');
		$msg = "> ".$currentDate."  -  ".$error."\n";
		fwrite($fh, $msg);
		fclose($fh);
	}

?>
