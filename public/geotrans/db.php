<?php
	$con = mysql_connect("localhost", "ucsbgeotracker", "ucsbgeotracker123");
	if (!$con) {
	  die('Could not connect: ' . mysql_errorno());
	}
		
	mysql_select_db("ucsbgeotrackergps", $con);
?>