<?php 

	if(isset($_POST["date"]) && isset($_POST["time"]) && isset($_POST["event_title"]) && isset($_POST["event_message"]) && isset($_POST["person"]))
	{
		date_default_timezone_set('America/Los_Angeles'); 
		$name = $_POST["person"];
		$message = $_POST["event_message"];
		$title = $_POST["event_title"];
		$date = $_POST["date"];
		$time = $_POST["time"];

		// $name = "Joe";
		// $date = "08-16-2017";
		// $time = "17:00";
		// $event_title = "Test";
		// $event_message = "Test";
		
		// echo $name."\n";
		// echo "$date\n";
		// echo "$time\n";
		$timestamp = DateTime::createFromFormat("m-d-Y H:i", "$date $time")->getTimestamp();
		echo $timestamp."\n";
		// $timestamp = time()-8*3600;
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
		$query = 'insert into event_table(time, person, event_title, event_message) values ('.$timestamp.', "'.$name.'", "'.$title.'", "'.$message.'")';
		// echo $query."\n";
		$results = $db->query($query) ;
	}
?>