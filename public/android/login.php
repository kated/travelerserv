<?php
	// ini_set('display_errors','On');
	require('enduro_functions.php');
	
	$devid = $_POST['devid'];
	$user = $_POST['u'];
	$pass = $_POST['p'];
	$match = 0;
	$parcip = "";
	$fields_string = "";
	
	mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
	mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));

	$url = "http://geogremlin.geog.ucsb.edu/participants/sign_in";
	$fields = array(
        'participant[email]'=>urlencode($user),
        'participant[password]'=>urlencode($pass)
    );

	foreach($fields as $key=>$value) { 
		$fields_string .= $key.'='.$value.'&'; 
	}
	rtrim($fields_string,'&');
	
	//open connection
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$result2 = curl_exec($ch);

	curl_close($ch);
	
	if (substr($result2, 0, 7) == "Invalid") {
		echo 0;	
	} else {
		$query1 = "SELECT participant_id, identification FROM devices WHERE participant_id = (SELECT id FROM participants WHERE email ='".$user."')";
		// ErrorLog($query1);
		$result1 = mysql_query($query1) or die(ErrorLog(mysql_error()));
		$num_rows = mysql_num_rows($result1);
		if ($num_rows != NULL) {
			while($row = mysql_fetch_array($result1)){
				$parcip = $row['participant_id'];
				if ($row['indentification'] == $devid) {
					// nothing
				} else {
					$query2 = "UPDATE devices SET identification = '".$devid."' WHERE participant_id = ".$parcip;
					mysql_query($query2) or die(ErrorLog(mysql_error()));
					// ErrorLog($query2);
				}
			}
		}
		echo 1;	
		mysql_free_result($result1);
	}
	
	
	mysql_close();	// clean up your damn mess

?>