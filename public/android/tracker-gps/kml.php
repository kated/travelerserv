<?php
// require('phpsqlajax_dbinfo.php');

 // Opens a connection to a MySQL server.
 mysql_connect("localhost", "ucsbgeotracker", "ucsbgeotracker123") or die(ErrorLog(mysql_error()));
 mysql_select_db("ucsbgeotrackergps") or die(mysql_error());
 
 $month = $_GET['month'];
 $day = $_GET['day'];
 $user = $_GET['user'];
 

 // Selects all the rows in the markers table.
 $query = "SELECT * FROM fixes WHERE userid = ".$user." and ts like '%2011-".$month."-".$day."%'";
 $result = mysql_query($query);
 if (!$result) 
 {
  die('Invalid query: ' . mysql_error());
 }

// Creates an array of strings to hold the lines of the KML file.
$kml = array('<?xml version="1.0" encoding="UTF-8"?>');
$kml[] = '<kml xmlns="http://earth.google.com/kml/2.1">';
$kml[] = ' <Document>';
$kml[] = ' <Style id="yellowLineGreenPoly">';
$kml[] = ' <LineStyle>';
$kml[] = ' <color>7fff00ff</color>';
$kml[] = ' <width>4</width>';
$kml[] = ' </LineStyle>';
$kml[] = ' </Style>';
$kml[] = ' <Placemark>';
$kml[] = ' <name>Trips</name>';
$kml[] = ' <visibility>1</visibility>';
$kml[] = ' <description><![CDATA[Month:'.$month.'\nDay:'.$day.']]></description>';
$kml[] = ' <styleUrl>#yellowLineGreenPoly</styleUrl>';
$kml[] = ' <LineString>';
$kml[] = ' <tessellate>1</tessellate>';
$kml[] = ' <coordinates>';

// Iterates through the rows, printing a node for each row.
while ($row = @mysql_fetch_assoc($result)) 
{
  $kml[] = $row['lng'] . ','  . $row['lat'] . ',0';
} 

// End XML file
$kml[] = ' </coordinates>';
$kml[] = ' </LineString>';
$kml[] = ' </Placemark>';
$kml[] = ' </Document>';
$kml[] = '</kml>';
$kmlOutput = join("\n", $kml);
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;
?>