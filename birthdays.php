#!/usr/local/bin/php
<?php print'<?xml version = "1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My Birthday</title>
</head>
<body>
<p>


<?php

date_default_timezone_set('America/Los_Angeles'); 
$year = 1996;
$ts = mktime(0,0,0,10,19,$year);
echo "<table id='display'>";
for($day = 1; $day < 32; $day++)
{
	echo "<tr><td>Dates:</td>";
	echo "<td> Days of the Week: </td></tr>";
	
	echo "<tr><td>";
	echo date('n/j/Y', $ts);
	echo "</td>";
   
	echo "<td>";
	echo date('l', $ts);
	echo "</td></tr>";
	
	
    
	$ts += 24*3600;
	
}
echo "</table>";

?>

	
	



</p>
</body>
</html>
