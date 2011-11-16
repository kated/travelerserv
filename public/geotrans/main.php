<?php

	session_start();
	if (!session_is_registered('username')) {
		header( "Location: index.html" );
	} else {
		$state = $_GET['state'];
		
		require 'db.php';
		$query = "SELECT * FROM questionnaire WHERE username = '".$_SESSION['username']."'";
		$result = mysql_query($query) or die(ErrorLog(mysql_error()));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style type="text/css">
.question {
	font-weight: bold;
}
.italicize {
	font-style: italic;
}
.submit_button {
	font-family: Ariel, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	color: #2E3963;
	line-height: normal;
	text-align: center;
	vertical-align: middle;
	position: relative;
	left: auto;
	top: auto;
	right: auto;
	bottom: auto;
}
</style>
</head>

<body><title>PEDALS main survey</title>


<body bgcolor=white>
<font face="Helvetica, Arial, sans-serif">
<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr>
<!-- First Row -->
<!-- Logo -->
<td width=200 bgcolor=#999999 valign=top><p><center><a href="index.html"><img src= pedals.png HD/Users/Kate/Dropbox/web_survey/ucsb_1.jpg alt="" width=80% border=0></a></center>


<!-- Breadcrumbs & Search -->
<td valign=top height=100% colspan=2><table border=0 width=100% cellspacing=0 cellpadding=0><tr><td bgcolor=606060 height=30%>

<!-- for a top navigation bar: <a href="index.html"><font color=white size=-1>Home</a> > <a href="examples.html"><font color=white>Examples</a> > <a href="example_dichotomous.html"><font color=white>Dichotomous Questions</a> -->


<td align=right bgcolor=606060><!-- <input type="text" size="20" value="Search Keywords"> <button>Search</button> --></align>
<!-- Title -->
<!--<span class="Cap">PE</span><span class="text">ople's</span> <span class="Cap">D</span><span class="text">aily</span> <span class="Cap">A</span><span class="text">ctivities</span> <span class="and">and</span> <span class="Cap">L</span><span class="text">ocations</span> <span class="Cap">S</span><span class="text">urvey</span></p></td> -->

<tr>
  <td  colspan=2 bgcolor=#999999><img src=ucsb_1.jpg width=80% height="154" HD/Users/Kate/Dropbox/web_survey/ucsb_1.jpg/> </table>


<tr>
<!-- Second Row -->
<!--  Sidebar -->
<td bgcolor=#999999 valign=top><br>
<!--&nbsp;&nbsp;<a href="index.html"><font color=white size=+1>About the Project</font></a><br>&nbsp;&nbsp;<a href="defs.html"><font color=white size=+1>Definitions</font></a><br>&nbsp;&nbsp;<a href="theory.html"><font color=white size=+1>Theory/Principles</font></a><hr>&nbsp;&nbsp;<a href="guidelines.html"><font color=white size=+1>Guidelines</font></a><br><table width=100% cellspacing=0 cellpadding=0 bgcolor=666699><tr><td bgcolor=white>&nbsp;&nbsp;<a href="examples.html"><font color=black size=+1>Examples</font></a></table><hr>&nbsp;&nbsp;<a href="tools.html"><font color=white size=+1>Tools/Services</font></a><br><hr>&nbsp;&nbsp;<a href="bibliography.html"><font color=white size=+1>Bibliography</font></a><br>&nbsp;&nbsp;<a href="addresources.html"><font color=white size=+1>Additional Resources</font></a><hr>&nbsp;&nbsp;<a href="aboutus.html"><font color=white size=+1>About Us</font></a><br><br> -->

<td width=10><td valign=top>
<!-- Main Content --><br>

<h2>
<div style="color:#991100;font-size:10pt;"><?php echo $state; ?></div><br/><br/>
Thank you for your participation <p></p>
<br />
<?php
		if (mysql_num_rows($result) == 0) {
			echo "Fill out the person questionnaire<a href=\"person_questionnaire.php\"> here</a>";
		} 
?>
<p></p>
<br />
Fill out your daily activity log <a href="daily_log.php">here</a></h2>
<p><br>

If you are finished please log out

<button onclick="location.href='logout.php';">Logout</button>
</form>
  
</table>
</body>

</html>
</body>
</html>

<!-- comments on this page: would like to have a checkmark to designate the complete or incomplete status of the survey portions
one daily activity log for each day???  -->

<?
	}
	?>