<?php

	session_start();
	if (!session_is_registered('username')) {
		header( "Location: index.html" );
	} else {
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

<body><title>PEDALS person questionnaire</title>


<body bgcolor=white>
<font face="Helvetica, Arial, sans-serif">
<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr>
<!-- First Row -->
<!-- Logo -->
<td width=200 bgcolor=#999999 valign=top><p><center><a href="index.html"><img src= pedals.png alt="" width=80% border=0></a></center>


<!-- Breadcrumbs & Search -->
<td valign=top height=100% colspan=2><table border=0 width=100% cellspacing=0 cellpadding=0><tr><td bgcolor=606060 height=30%>



<td align=right bgcolor=606060><!-- <input type="text" size="20" value="Search Keywords"> <button>Search</button> --></align>


<tr>
  <td  colspan=2 bgcolor=#999999><img src=ucsb_1.jpg width=80% height="154" /> </table>


<tr>
<!-- Second Row -->
<!--  Sidebar -->
<td bgcolor=#999999 valign=top><br>

<td width=10><td valign=top>
<!-- Main Content --><br>

<h2>
Please tell us about yourself
</h2>
<form name="person" action="person_questionnaire2.php" method="post">
<p><br>
  <span class="question">1. What is your gender?</span><br><br>
  <input type="radio" name="gender" value="0">Male<br>
  <input type="radio" name="gender" value="1">Female <br>    
  </p>
<p><br>
  <br>  
  
  <span class="question">2. What is your age?</span><br><br>
  Enter the correct number: <input type="text" name ="age" size ="3"> years old </p>
<p><br>
  <br>
  
  <span class="question">3. Please select the best description of your educational status:</span> 
</p>
<input type="radio" name="edu" value="1"> I am an undergraduate first year.<br>
<input type="radio" name="edu" value="2"> I am an undergraduate second year.<br>
<input type="radio" name="edu" value="3"> I am an undergraduate third year.<br>
<input type="radio" name="edu" value="4"> I am an undergraduate fourth year.<br>
<input type="radio" name="edu" value="5"> I am a graduate student. </p> 
<p><br><br>

 <span class="question">4. Please select the best description of your living situation or household </span>  <span class="italicize">(household is defined as a group of people who share the same cooking facilities):</span> <br><br>
 <input type="radio" name="hhold" value="1"> I live alone.<br>
<input type="radio" name="hhold" value="2"> I live with friends.<br>
<input type="radio" name="hhold" value="3"> I live with my family.<br>
<input type="radio" name="hhold" value="4"> I live in the dorms, co-op, sorority or fraternity.<br>
<input type="radio" name="hhold" value="5"> Other.<br>
If other please explain.<input type="textarea" name="hholdothr" rows=1 cols=50> </textarea></p><p><br><br />

<span class="question">5. How many people live in your household?: </span><br><br>
<input type="radio" name="hholdsz" value="1"> I live alone.<br>
<input type="radio" name="hholdsz" value="2"> I live with one other person.<br>
<input type="radio" name="hholdsz" value="3"> I live with 2-8 other people.<br>
<input type="radio" name="hholdsz" value="4"> I live with more than 9 other people.<br></p><p>
<br /><br/>

<span class="question">6. Are you employed </span> <span class="italicize">(do not include being a student)?: </span><br><br>
<input type="radio" name="emp" value="1"> No, I am not employed.<br>
<input type="radio" name="emp" value="2"> Yes, I have a part time job through UCSB.<br>
<input type="radio" name="emp" value="3"> Yes, I have a part time job outside of UCSB.<br>
<input type="radio" name="emp" value="4"> Yes, I have a full time job.<br></p>
<p>
  <span class="question">7. What type of Android phone do you have (ex. Nexus one, Droid Incredible, etc.)?</span><br />
  <br />
  <input type="text" name ="phone" size ="15" />
<p></p>
<p><br />
  <br/>
  
  <input name="submit" type="submit" class="submit_button" id="submit" value="Submit" />
</form>

<p>&nbsp;</p>
  <p><br>
  </p>


</table>
</body>

</html>
</body>
</html>
<?
	}
	?>