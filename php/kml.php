<?php

 // Opens a connection to a MySQL server.
$connection = mysql_connect("localhost","enduro3001","3nduro3001");
if (!$connection) 
{
  die('Not connected : ' . mysql_error());
}

// Sets the active MySQL database.
$db_selected = mysql_select_db("travelerserv_production", $connection);
if (!$db_selected) 
{
  die ('Can\'t use db : ' . mysql_error());
}

 // Selects all the rows in the markers table.
 $query = 'SELECT * FROM travel_fixes WHERE participant_id = 2 and device_id = 2 ORDER BY created_at DESC limit 70';
 $result = mysql_query($query);
 if (!$result) 
 {
  die('Invalid query: ' . mysql_error());
 }

// Creates an array of strings to hold the lines of the KML file.
$kml = array('<?xml version="1.0" encoding="UTF-8"?>');
$kml[] = '<kml xmlns="http://www.opengis.net/kml/2.2">';
$kml[] = '<Document>';
$kml[] = '<name>Paths</name>';
$kml[] = '<description>Travelerserv</description>';
$kml[] = '<Style id="yellowLineGreenPoly">';
$kml[] = '<LineStyle>';
$kml[] = '<color>E69900ff</color>';
$kml[] = '<width>4</width>';
$kml[] = '</LineStyle>';
$kml[] = '<PolyStyle>';
$kml[] = '<color>7f00ff00</color>';
$kml[] = '</PolyStyle>';
$kml[] = '</Style>';
$kml[] = '<Placemark>';
$kml[] = '<name>Path</name>';
$kml[] = '<description>SocialTrackr movement</description>';
$kml[] = '<styleUrl>#yellowLineGreenPoly</styleUrl>';
$kml[] = '<LineString>';
// $kml[] = '<tessellate>1</tessellate>';
$kml[] = '<coordinates>';
// Iterates through the rows, printing a node for each row.
while ($row = @mysql_fetch_assoc($result)) 
{
  $kml[] = $row['longitude'] . ','  . $row['latitude'] . ' ';
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