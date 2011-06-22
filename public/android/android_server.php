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
	$aEnduro = array("",$devid,"","","","",-9,"",-9,1,floatval($alon),floatval($alat),$times); 
	
	// var_dump($aEnduro);
	
	$_MINDISTANCE = 150;	// in meters
	$_MINTIMEBETWEENACT = 300; // in seconds
	$_MINDISTBETWEENACT = 200; // in meters
	
	$from = '';
	$port = 0;
	$previous5fixes = array();	// for duplicate entries
	$previousActTime = 300;
	$previousActLat = 0;
	$previousActLon = 0;
	
	if ($aEnduro[10] != 0 and $aEnduro[11] != 0) {	// and it has a valid lat/lon
	
		if (count($previous5fixes) == 0) {
			$previousdate = 0;
		} else {
			$prevElement = end($previous5fixes);
			$previousdate = $prevElement[12];
		}
		
		if ($previousdate != $aEnduro[12]) {	// catch duplicate time stamps
			if (count($previous5fixes) >= 8) {
				//get distance between current fix and previous 5
				$totDist = 0;
				$lat = 0;
				$lon = 0;
				foreach($previous5fixes as $fix) {
					$totDist += CalculateDist($fix[11],$aEnduro[11],$fix[10],$aEnduro[10]);
					$lat += $fix[11];
					$lon += $fix[10];
				}
				$timeDiff = strtotime($aEnduro[12]) - $previousActTime;
				$distDiff = CalculateDist($previousActLat,$aEnduro[11],$previousActLon,$aEnduro[10]);
				
				if ($totDist/count($previous5fixes) <= $_MINDISTANCE and $timeDiff >= $_MINTIMEBETWEENACT and $distDiff >= $_MINDISTBETWEENACT) {
					// Add Activity	
					$avLat = $lat/count($previous5fixes);
					$avLon = $lon/count($previous5fixes);
					$actTime = $aEnduro[12];
					$previousActTime = strtotime($actTime);
					$previousActLat = $avLat;
					$previousActLon = $avLon;
					
					$myFile = "Activities_test2.txt";
					$fh = fopen($myFile, 'a') or die("can't open file");
					fwrite($fh, "### Activity YES ## ".$avLat .", ". $avLon .", ". $actTime .", ".$totDist/count($previous5fixes).", ".$timeDiff.", ".$distDiff."\n");
					fclose($fh);
					
					DBAddActivity($avLon, $avLat, formatDate($actTime), $aEnduro[1]);
				} else {
					$avLat = $lat/count($previous5fixes);
					$avLon = $lon/count($previous5fixes);
					$actTime = $aEnduro[12];
					
					$myFile = "Activities_test2.txt";
					$fh = fopen($myFile, 'a') or die("can't open file");
					fwrite($fh, "### Activity NO ## ".$avLat .", ". $avLon .", ". $actTime .", ".$totDist/count($previous5fixes).", ".$timeDiff.", ".$timeDiff."\n");
					fclose($fh);
				}
				array_shift($previous5fixes);
			}
			$previous5fixes[] = $aEnduro;	// add newest fix
			DBAddFix($aEnduro, 'Android');		// send it to the database
			// spitItOut($aEnduro);	// dump to terminal window
			// writeToFile($aEnduro);
		}
	}
	
?>