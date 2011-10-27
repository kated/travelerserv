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
$kml[] = ' <Style id="restaurantStyle">';
$kml[] = ' <IconStyle id="restuarantIcon">';
$kml[] = ' <Icon>';
$kml[] = ' <href>http://geogremlin.geog.ucsb.edu/android/tracker-gps/marker.png</href>';
$kml[] = ' </Icon>';
$kml[] = ' </IconStyle>';
$kml[] = ' </Style>';
$kml[] = ' <Style id="barStyle">';
$kml[] = ' <IconStyle id="barIcon">';
$kml[] = ' <Icon>';
$kml[] = ' <href>http://geogremlin.geog.ucsb.edu/android/tracker-gps/marker.png</href>';
$kml[] = ' </Icon>';
$kml[] = ' </IconStyle>';
$kml[] = ' </Style>';

// Iterates through the rows, printing a node for each row.
while ($row = @mysql_fetch_assoc($result)) 
{
  $kml[] = ' <Placemark id="placemark' . $row['id'] . '">';
  $kml[] = ' <name>' . htmlentities($row['id']) . '</name>';
  $kml[] = ' <description>' . htmlentities($row['ts']) . '</description>';
  $kml[] = ' <styleUrl>#barStyle</styleUrl>';
  $kml[] = ' <Point>';
  $kml[] = ' <coordinates>' . $row['lng'] . ','  . $row['lat'] . '</coordinates>';
  $kml[] = ' </Point>';
  $kml[] = ' </Placemark>';
 
} 

// End XML file
$kml[] = ' </Document>';
$kml[] = '</kml>';
$kmlOutput = join("\n", $kml);
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;
?>