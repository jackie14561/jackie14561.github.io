#!/usr/local/bin/php-d display_errors=STDOUT
<?php 
	print('<?xml version = "1.0" encoding="utf-8"?>');
	print "\n";
	print('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"');
	print "\n";
	print('"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">');
	print "\n";
	print('<html xmlns="http://www.w3.org/1999/xhtml"');
	print "\n";
	print('xmlns:v="urn:schemas-microsoft-com:vml">');
	print "\n";

	date_default_timezone_set('America/Los_Angeles'); 
	$family = array("Joe", "Joanna", "Lil Cub", "Lil Pug", "Jacqueline");         	// you can add / remove family_members here
	try
	{
	 	$db = new SQLite3('dbjacqueline.db');
	}
	catch (Exception $exception)
	{
		echo '<p>There was an error connecting to thedatabase!</p>';
		if ($db)
		{
			echo $exception->getMessage();
		}
	}

	function pretty_date($timestamp)                 								// Format the current time to return a pretty formatted date
	{
		$year=date("Y",$timestamp);
		$month=date("F", $timestamp);
		$day =date("d", $timestamp);
		$day_2=date("D", $timestamp);
		$hour=date("g", $timestamp);
		$minute=date("i",$timestamp);
		$second=date("s",$timestamp);
		$ap=date("a",$timestamp);
		$pretty_date = $day_2.', '.$month.' '.intval($day).', '.$year.', '.$hour.':'.$minute.' '.$ap;
		return $pretty_date;
	}

	function hours_to_string($timestamp_hour)        								// as required, a function which returns hours in the format 'x.00am'
	{
		$hour=date("g", $timestamp_hour);
		$am_pm=date("a", $timestamp_hour);
		return $hour.'.00'.$am_pm;
	}

	function make_header($family)                    								// make header of the table using the family members' names.
	{
		echo '	
			<tr>	
			<th class="hr_td_"> &nbsp; </th>  
			';

		$arrlength = count($family);
		for($x = 0; $x < $arrlength; $x++)                							// loop thorugh each name.
		{
		    echo '
		    	<th class="table_header">'.$family[$x].'</th>
		    	';
		}
		echo '
			</tr> 
			';
	}

	function get_events($person, $timestamp)
	{
		$db = $GLOBALS['db'];
		$next_hour = $timestamp+3600;
		$sql = 'select event_title, event_message from event_table where person = "'.$person.'" and time >= '.$timestamp.' and time < '.$next_hour;
		$results = $db->query($sql) ;
		$events_array = Array();
		while ($row = $results->fetchArray()) {
		    array_push($events_array, $row["event_title"].": ".$row["event_message"]);
		}
		return $events_array;
	}

	function add_row($hour, $odd_even, $number_of_members, $timestamp_for_this_row)               			// add a row in a table, and set the even or odd class
	{
		$family = $GLOBALS['family'];
		if ($odd_even==0)
		{
			echo '
			<tr class="even_row"> 
			';
		}
		else
		{
			echo '
			<tr class="odd_row"> 
			';
		}
		echo '
			<td class="hr_td">'.$hour.'</td> 
			';

		for($x = 0; $x < $number_of_members; $x++)                        			// add table data rows for each family member
		{
			$current_member = $family[$x];
			$events_for_this_member = get_events($current_member, $timestamp_for_this_row);
			echo '<td>';
			foreach($events_for_this_member as $event)
			{		
				echo $event.'<br/>';
			}
			echo '
		    	</td>
		    	';
		}
		echo '</tr>';
	}

	function mytime ($hours_to_show, $current_timestamp, $number_of_members)      
	{
		$round_down_to_nearest_hour = strtotime(date("Y-m-d H:00:00", $current_timestamp));      // round down the current time to the nearest hour.
		$temp_time_to_show = $round_down_to_nearest_hour;

		$temp_hour = hours_to_string($temp_time_to_show);                         // the first row for the current hour.
		add_row($temp_hour, 0, $number_of_members, $temp_time_to_show);

		for ($x = 1; $x <= $hours_to_show ; $x++)                                 // iteratively add an hour to the temporary time and make a row.
		{
			$temp_time_to_show = strtotime('+1 hours', $temp_time_to_show);
			$temp_hour = hours_to_string($temp_time_to_show);
			add_row($temp_hour, $x%2, $number_of_members, $temp_time_to_show);                        // argument to let the add_row function know whether to ass an even or odd row.
		}
		
	}

	echo '
		<head>
		<title>Calendar</title> 

		<link rel="stylesheet" type="text/css" href="calendar.css" />

		</head>
		<body>

		<div class="container">
		';

	if (isset($_GET["time_stamp"]))
		$current_timestamp = $_GET["time_stamp"];
	else
		$current_timestamp = time();

	$hours_to_show = 12;														// modify the hours to show here
	$next_hours = $current_timestamp+$hours_to_show*3600;
	$previous_hours = $current_timestamp-$hours_to_show*3600;
	$pretty_current_date = pretty_date($current_timestamp);

	echo '	
		<h1>Bruin Family Schedule for '.$pretty_current_date.' </h1>
		<table id="event_table">
		';

	make_header($family);                                                     	// insert the header.
	mytime($hours_to_show, $current_timestamp, count($family));               	// make the table.

	echo '
		</table>
		';


	echo '
		<div>
		<form id="prev" method="get" action="calendar2.php">
			<p>
			<input type="hidden" name="time_stamp" value="'.$previous_hours.'"/>
			<input type="submit" value="Previous twelve hours"/>
			</p>
		</form>

		<form id="next" method="get" action="calendar2.php">
			<p>
			<input type="hidden" name="time_stamp" value="'.$next_hours.'"/>
			<input type="submit" value="Next twelve hours"/>
			</p>
		</form>

		<form id="today" method="get" action="calendar2.php">
			<p>
			<input type="submit" value="Today"/>
			</p>
		</form>
		</div>

		</div>
		</body>
		</html>
		';
?>