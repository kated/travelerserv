<?php

 /* =====================================
	Author: Grant McKenzie
	Client: UCSB Geotrans Lab
	Date: November 2011
	Leadfile: daily_log.php
 =========================================*/
error_reporting(E_ALL);
ini_set('display_errors','On'); 

	session_start();
	if (!session_is_registered('username')) {
		header( "Location: index.php" );
	} else {
		
		$day = mysql_real_escape_string($_POST['day']);
		$dataset = array();
		for ($i=1;$i<=16;$i++) {
			$dataset[] = mysql_real_escape_string($_POST['issue'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['stime'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['etime'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['add'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['city'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['state'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['zip'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['place'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['mode'.$i]);
			$dataset[] = mysql_real_escape_string($_POST['act'.$i]);
		}
	
		require 'db.php';
		
		if (count($dataset) > 0) {
			for ($i=0;$i<16;$i++) {
				$j = $i * 6;
				if ($dataset[$j+0] != "" && $dataset[$j+1] != "") {
					$query = "INSERT INTO log VALUES ('','".$_SESSION['username']."','".$day."','".$dataset[$j+0]."','".$dataset[$j+1]."','".$dataset[$j+2]."','".$dataset[$j+3]."','".$dataset[$j+4]."','".$dataset[$j+5]."','".$dataset[$j+6]."','".$dataset[$j+7]."','".$dataset[$j+8]."','".$dataset[$j+9]."')";
					$result = mysql_query($query) or die(ErrorLog(mysql_error()));
				}
			}
			mysql_free_result($result);
			header( "Location: main.php?state=Thank you, the daily log was successfully submitted" );
		} else {
			header( "Location: daily_log.php?e=t" );
		}
		
		mysql_close();
	
	}
?>