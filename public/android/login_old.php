<?php
	// ini_set('display_errors','On');
	require('enduro_functions.php');
	// require('bcrypt.class');
	
	$devid = $_GET['devid'];
	$user = $_GET['u'];
	$pass = $_GET['p'];
	/* $devid = $_GET['devid'];
	$user = $_GET['u'];
	$pass = $_GET['p']; */
	$match = 0;
	$parcip = "";
	
	mysql_connect("localhost", "enduro3001", "3nduro3001") or die(ErrorLog(mysql_error()));
	mysql_select_db("travelerserv_production") or die(ErrorLog(mysql_error()));

	$salt="$2a$10$K3QMLJjVHcHM1qEbQFXxDu";
	/* $bcrypt = new Bcrypt(15);
	$hash = $bcrypt->hash($pass);
	$isGood = $bcrypt->verify($pass, $hash); */
	
	$encryptedPassword = sha1($salt.$str."4a3798857ca2675c7cbab6ed4d34264c3c5d6658b84f689c078a78a23190c83b5625b7ace670e46a285bb5a2c96dee4783a41252c0e36d995babfa44146427b3");
	
	// $encryptedPassword=crypt($pass,$salt);
	ErrorLog($encryptedPassword);
	$query1 = "SELECT participant_id, identification FROM devices WHERE participant_id = (SELECT id FROM participants WHERE first_name='".$user."' and encrypted_password = '".$encryptedPassword."')";
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