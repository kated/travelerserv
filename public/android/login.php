<?php
	
	require('enduro_functions.php');
	
	$devid = $_POST['devid'];
	$user = $_POST['u'];
	$pass = $_POST['p'];
	/* $devid = $_GET['devid'];
	$user = $_GET['u'];
	$pass = $_GET['p']; */
	$match = 0;
	$parcip = "";
	
	mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
	mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));
	
	$query1 = "SELECT participant_id, identification FROM devices WHERE participant_id = (SELECT id FROM participants WHERE first_name='".$user."' and encrypted_password = '".$pass."')";
	$result = mysql_query($query1) or die(ErrorLog(mysql_error()));
	
	$num_rows = mysql_num_rows($result);
	if ($num_rows != NULL) {
		while($row = mysql_fetch_array($result)){
			$parcip = $row['participant_id'];
			if ($row['indentification'] == $devid) {
				$match = 1;
			} else {
				$match = 2;	
			}
		}
	}
	if ($match == 1) {
		echo 1;	
	} else if ($match == 2) {
		$query2 = "UPDATE devices SET identification = '".$devid."' WHERE participant_id = ".$parcip;
		// echo $query2;
		mysql_query($query2) or die(ErrorLog(mysql_error()));
		echo 1;
	} else {
		echo 0;	
	}
	mysql_free_result($result);
	mysql_close();	// clean up your damn mess

?>