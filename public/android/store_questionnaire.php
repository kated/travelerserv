<?php

	/* =================================================================================
	Author: Grant McKenzie (grantmckenzie.com)
	Client: GeoTrans Lab UCSB
	Date: September 2011
	Project: travelerserv
	Description: Stores android insitu questionnaires.
	==================================================================================== */
	require('android_functions.php');
	date_default_timezone_set('America/Vancouver');
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors','On');
	
	/* $devid = $_GET['uid'];
	$activityID = $_GET['id'];
	$loc = $_GET['loc'];
	$whom = $_GET['whom'];
*/
	
	$devid = $_POST['uid'];
	$activityID = $_POST['id'];
	$loc = $_POST['loc'];
	$whom = $_POST['whom'];

	mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
	mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));
	
	

	$query = "INSERT INTO questionnaire_records (participant_id, created_at, subject_id, subject_type) VALUES((SELECT participant_id FROM devices WHERE identification = '".$devid."'), '".date('y-m-d h:i:s')."',".$activityID.", 'Activity')";
	mysql_query($query) or die(ErrorLog(mysql_error()));  // ideally this would be a stored proc
	$questionnaireID = mysql_insert_id();

	
	$query = "INSERT INTO questionnaire_record_fields (questionnaire_record_id, kind, text, question, created_at, question_key) VALUES(".$questionnaireID.", 'StringAnswer', '".$loc."', 'Where were you?','".date('y-m-d h:i:s')."','howfeel')";
	mysql_query($query) or die(ErrorLog(mysql_error()));  // ideally this would be a stored proc
	
	mysql_close();	// clean up your damn mess

	
	// geogremlin.geog.ucsb.edu/android/store_questionnaire.php?uid=ffffffff-a1c8-ac27-d882-12cd1883a12b&id=123&loc=MyPlace&whom=1,0,1
?>


