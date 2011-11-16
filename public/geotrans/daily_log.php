<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Daily Log</title>
<?php

	session_start();
	if (!session_is_registered('username')) {
		header( "Location: index.html" );
	} else {
?>
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


<body style="margin:0;background-color:#ffffff;font-size:12pt;">

<div  style="font-family:Helvetica, Arial, sans-serif;font-size:10pt;color:#666666;width:900px;">

<table width="100%">
<tr>
 <td align="right" bgcolor="#666666">
	<a href="index.html"><img src="pedals.png"></a>
 </td>
 <td align="left" bgcolor="#666666">
	<a href="index.html"><img src="ucsb_1.jpg"></a>
 </td>
</tr>
<tr>
<td colspan="2">

<h2>Please complete a log of todays activities</h2>
<p>Please begin your day with the location and activity taking place at 2am the day of, and end your log with the location and activity which you participated in at 1:59am the next morning. </p>
<p>Each location that you were at during the day should be recorded as a unique entry in the table</p>
<p>Please record the start and end time as well as the address as accurately as possible. It is ok to use building names for places on the UCSB campus, but use numerical building addresses where appropriate</p>
<p>Example:</p>
<p><img src="log_example.png" width="1337" height="430" /><br/>
</p>
<form action="daily_log2.php" method="post">
  
  Please select a day: 
  <select name="day">
 <option value="1117">November 17</option>
 <option value="1118">November 18</option>
 <option value="1119">November 19</option>
 <option value="1120">November 20</option>
 <option value="1121">November 21</option>
 <option value="1122">November 22</option>
 <option value="1123">November 23</option>
 <option value="1124">November 24</option>
 <option value="1125">November 25</option>
 <option value="1126">November 26</option>
 <option value="1127">November 27</option>
 <option value="1128">November 28</option>
 <option value="1129">November 29</option>
 <option value="1130">November 30</option>
 <option value="1201">December 01</option>
 <option value="1202">December 02</option>
 <option value="1203">December 03</option>
 <option value="1204">December 04</option>
 <option value="1205">December 05</option>
 <option value="1206">December 06</option>
 <option value="1207">December 07</option>
</select>
<br/><br/>
For today's activities please record the following details:
<br/><br/>

<table  border = 2>
	<tr>
		<td width = 16></td>

		<td width = 170>Start Time of activity (am/pm)</td>
		<td width = 170>End Time of activity (am/pm)</td>
		<td width = 170>Address (number and street) of activity</td>
        <td width = 40> City </td>
        <td width = 40> State </td>
        <td width = 40> Zip Code </td>
		<td width=  170>Name of place where the activity was conducted</td>
        <td width = 124>Mode of transportation used to arrive at the activity</td>
		<td width = 165>Activity Conducted</td>
        
		
	
	</tr>
	<tr>
		<td>1</td>
		<td><input type="text" name="stime1" length="6"></td>
		<td><input type="text" name="etime1" length="6"></td>
		<td><input type="text" name="add1" length="6"></td>
        <td><input type="text" name="city1" length="6"></td>
        <td><input type="text" name="state1" length="6"></td>
        <td><input type="text" name="zip1" length="6"></td> 
        <td><input type="text" name="place1" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode1"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act1" length="6"></td>

	</tr>
	<tr>
		<td>2</td>
		<td><input type="text" name="stime2" length="6"></td>
		<td><input type="text" name="etime2" length="6"></td>
		<td><input type="text" name="add2" length="6"></td>
        <td><input type="text" name="city2" length="6"></td>
        <td><input type="text" name="state2" length="6"></td>
        <td><input type="text" name="zip2" length="6"></td>
        <td><input type="text" name="place2" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode2"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act2" length="6"></td>
	</tr>
	<tr>
		<td>3</td>
		<td><input type="text" name="stime3" length="6"></td>
		<td><input type="text" name="etime3" length="6"></td>
		<td><input type="text" name="add3" length="6"></td>
        <td><input type="text" name="city3" length="6"></td>
        <td><input type="text" name="state3" length="6"></td>
        <td><input type="text" name="zip3" length="6"></td>
        <td><input type="text" name="place3" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode3"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act3" length="6"></td>

	</tr>
	<tr>
		<td>4</td>
		<td><input type="text" name="stime4" length="6"></td>
		<td><input type="text" name="etime4" length="6"></td>
		<td><input type="text" name="add4" length="6"></td>
        <td><input type="text" name="city4" length="6"></td>
        <td><input type="text" name="state4" length="6"></td>
        <td><input type="text" name="zip4" length="6"></td>
        <td><input type="text" name="place4" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode4"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act4" length="6"></td>
	</tr>
	<tr>
		<td>5</td>
		<td><input type="text" name="stime5" length="6"></td>
		<td><input type="text" name="etime5" length="6"></td>
		<td><input type="text" name="add5" length="6"></td>
        <td><input type="text" name="city5" length="6"></td>
        <td><input type="text" name="state5" length="6"></td>
        <td><input type="text" name="zip5" length="6"></td>
        <td><input type="text" name="place5" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode5"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act5" length="6"></td>
	</tr>
	<tr>
		<td>6</td>
		<td><input type="text" name="stime6" length="6"></td>
		<td><input type="text" name="etime6" length="6"></td>
		<td><input type="text" name="add6" length="6"></td>
        <td><input type="text" name="city6" length="6"></td>
        <td><input type="text" name="state6" length="6"></td>
        <td><input type="text" name="zip6" length="6"></td>
        <td><input type="text" name="place6" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode6"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act6" length="6"></td>
	</tr>	
	<tr>
		<td>7</td>
		<td><input type="text" name="stime7" length="6"></td>
		<td><input type="text" name="etime7" length="6"></td>
		<td><input type="text" name="add7" length="6"></td>
        <td><input type="text" name="city7" length="6"></td>
        <td><input type="text" name="state7" length="6"></td>
        <td><input type="text" name="zip7" length="6"></td>
        <td><input type="text" name="place7" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode7"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act7" length="6"></td>
        </tr>	
	<tr>
		<td>8</td>
		<td><input type="text" name="stime8" length="6"></td>
		<td><input type="text" name="etime8" length="6"></td>
		<td><input type="text" name="add8" length="6"></td>
        <td><input type="text" name="city8" length="6"></td>
        <td><input type="text" name="state8" length="6"></td>
        <td><input type="text" name="zip8" length="6"></td>
        <td><input type="text" name="place8" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode8"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act8" length="6"></td>
        </tr>	
	<tr>
		<td>9</td>
		<td><input type="text" name="stime9" length="6"></td>
		<td><input type="text" name="etime9" length="6"></td>
		<td><input type="text" name="add9" length="6"></td>
        <td><input type="text" name="city9" length="6"></td>
        <td><input type="text" name="state9" length="6"></td>
        <td><input type="text" name="zip9" length="6"></td>
        <td><input type="text" name="place9" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode9"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act9" length="6"></td>
        </tr>	
	<tr>
		<td>10</td>
		<td><input type="text" name="stime10" length="6"></td>
		<td><input type="text" name="etime10" length="6"></td>
		<td><input type="text" name="add10" length="6"></td>
        <td><input type="text" name="city10" length="6"></td>
        <td><input type="text" name="state10" length="6"></td>
        <td><input type="text" name="zip10" length="6"></td>
        <td><input type="text" name="place10" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode10"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act10" length="6"></td>
        </tr>	
	<tr>
		<td>11</td>
		<td><input type="text" name="stime11" length="6"></td>
		<td><input type="text" name="etime11" length="6"></td>
		<td><input type="text" name="add11" length="6"></td>
        <td><input type="text" name="city11" length="6"></td>
        <td><input type="text" name="state11" length="6"></td>
        <td><input type="text" name="zip11" length="6"></td>
        <td><input type="text" name="place11" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="6post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode11"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act11" length="6"></td>
        </tr>	
	<tr>
		<td>12</td>
		<td><input type="text" name="stime12" length="6"></td>
		<td><input type="text" name="etime12" length="6"></td>
		<td><input type="text" name="add12" length="6"></td>
        <td><input type="text" name="city12" length="6"></td>
        <td><input type="text" name="state12" length="6"></td>
        <td><input type="text" name="zip12" length="6"></td>
        <td><input type="text" name="place12" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode12"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act12" length="6"></td>
        </tr>	
	<tr>
		<td>13</td>
		<td><input type="text" name="stime13" length="6"></td>
		<td><input type="text" name="etime13" length="6"></td>
		<td><input type="text" name="add13" length="6"></td>
        <td><input type="text" name="city13" length="6"></td>
        <td><input type="text" name="state13" length="6"></td>
        <td><input type="text" name="zip13" length="6"></td>
        <td><input type="text" name="place13" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode13"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act13" length="6"></td>
        </tr>	
	<tr>
		<td>14</td>
		<td><input type="text" name="stime14" length="6"></td>
		<td><input type="text" name="etime14" length="6"></td>
		<td><input type="text" name="add14" length="6"></td>
        <td><input type="text" name="city14" length="6"></td>
        <td><input type="text" name="state14" length="6"></td>
        <td><input type="text" name="zip14" length="6"></td>
        <td><input type="text" name="place14" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode14"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act14" length="6"></td>
        </tr>	
	<tr>
		<td>15</td>
		<td><input type="text" name="stime15" length="6"></td>
		<td><input type="text" name="etime15" length="6"></td>
		<td><input type="text" name="add15" length="6"></td>
        <td><input type="text" name="city15" length="6"></td>
        <td><input type="text" name="state15" length="6"></td>
        <td><input type="text" name="zip15" length="6"></td>
        <td><input type="text" name="place15" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode15"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act15" length="6"></td>
        </tr>	
	<tr>
		<td>16</td>
		<td><input type="text" name="stime16" length="6"></td>
		<td><input type="text" name="etime16" length="6"></td>
		<td><input type="text" name="add16" length="6"></td>
        <td><input type="text" name="city16" length="6"></td>
        <td><input type="text" name="state16" length="6"></td>
        <td><input type="text" name="zip16" length="6"></td>
        <td><input type="text" name="place16" length="6" /></td>
        <!--<td><form id="form1" name="mode1" method="post" action="">
		  <blockquote>
		    <p id="mode" name="mode">-->
		      <td><select name="mode16"> <!--name="mode" id="mode"> -->
		        <option value="null" selected="selected">please select</option>
		        <option value="1">bicycle</option>
		        <option value="2">bus</option>
		        <option value="3">car (driver)</option>
		        <option value="4">car (passenger)</option>
		        <option value="5">motorcycle</option>
		        <option value="6">skateboard</option>
		        <option value="7">walk</option>
		        <option value="8">other</option>
		        </select> 
		      </p>
		   <!-- </blockquote>
		</form></td>-->
		<td><input type="text" name="act16" length="6"></td>
	</tr>
	<tr>
	 <td colspan="10" align="right">
	 <br/><br/>
	 	<input name="submit" type="submit" class="submit_button" id="submit" value="Submit" />
	 	<br/><br/>
	 </td>
	</tr>
</table>
</form>
</td>
</tr>
</table>
<br/><br/>
</div>
</body>

</html>

<?
	}
	?>