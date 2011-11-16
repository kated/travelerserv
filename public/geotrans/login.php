<?php
/* error_reporting(E_ALL);
ini_set('display_errors','On'); */
	
$username = addslashes($_POST['arg1']);
$password = md5($_POST['arg2']); 
// $password = $_POST['arg2'];

//check that the user is calling the page from the login form and not accessing it directly
//and redirect back to the login form if necessary
if (!isset($username) || !isset($password)) {
	header( "Location: index.html" );
} elseif (empty($username) || empty($password)) {
	header( "Location: index.html" );
} else{

	require 'db.php';
	$query = "select * from users where username='$username' AND password='$password'";
	$result = mysql_query($query);
	//check that at least one row was returned
	// echo $query;
	$rowCheck = mysql_num_rows($result);
	
	if($rowCheck > 0) {
		while($row = mysql_fetch_array($result)){
		  //start the session and register a variable
		  session_start();
		  session_register('username');
		  $_SESSION['username'] = $username;
		
		  //we will redirect the user to another page where we will make sure they're logged in
		  header( "Location: main.php" );
		
		  }
	} else {
		  //if nothing is returned by the query... send 'em packing	
		  header( "Location: index.html" );

	}
}
?> 