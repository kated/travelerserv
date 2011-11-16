<?php

 /* =====================================
	Author: Grant McKenzie
	Client: UCSB Geotrans Lab
	Date: November 2011
	Leadfile: person_questionnaire.php
 =========================================*/
	session_start();
	if (!session_is_registered('username')) {
		header( "Location: index.php" );
	} else {
		
		$gender = mysql_real_escape_string($_POST['gender']);
		$age = mysql_real_escape_string($_POST['age']);
		$edu = mysql_real_escape_string($_POST['edu']);
		$hhold = mysql_real_escape_string($_POST['hhold']);
		$hholdothr = mysql_real_escape_string($_POST['hholdothr']);
		$hholdsz = mysql_real_escape_string($_POST['hholdsz']);
		$emp = mysql_real_escape_string($_POST['emp']);
		
	
		require 'db.php';
		
		if ($gender != "" && is_numeric($age)) {
			$query = "INSERT INTO questionnaire VALUES ('','".$_SESSION['username']."',".$gender.",".$age.",".$edu.",".$hhold.",".$hholdsz.",".$emp.",'".$hholdothr."')";
			$result = mysql_query($query) or die(ErrorLog(mysql_error()));
			mysql_free_result($result);
			header( "Location: main.php?state=Thank you, the questionnaire was successfully submitted" );
		} else {
			header( "Location: person_questionnaire.php?e=t" );
		}
		
		mysql_close();
	
	}
?>