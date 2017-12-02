!/usr/local/bin/php -d display_errors=STDOUT
<?php 
	$database="dbjackie14561.db";
	$table = "event_table";
	$field1 = "name";
	$field2 = "message";
	$field3 = "title";
	$field4= "date";
	$field5="time";


// Create the table
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 varchar(100),
$field2 varchar(300),
$field3 varchar(300),
$field4 varchar(100),
$field5 int(12);
)";
$result = $db->query($sql);

	if(isset($_POST["date"]) && isset($_POST["time"]) && isset($_POST["event_title"]) && isset($_POST["event_message"]) && isset($_POST["person"]))
	{
		date_default_timezone_set('America/Los_Angeles'); 
		$name = $_POST["person"];
		$message = $_POST["event_message"];
		$title = $_POST["event_title"];
		$date = $_POST["date"];
		$time = $_POST["time"];

		
		$timestamp = DateTime::createFromFormat("m-d-Y H:i", "$date $time")->getTimestamp();
		echo $timestamp."\n";
		// $timestamp = time()-8*3600;
		try
		{
		 	$db = new SQLite3($database);
		}
		catch (Exception $exception)
		{
			echo '<p>There was an error connecting to the database!</p>';
			if ($db)
			{
				echo $exception->getMessage();
			}
		}

		$result = "INSERT INTO $table(time, person, event_title, event_message) VALUES ($timestamp, $name, $title, $message)";
		// echo $query."\n";
		$results = $db->query($result) ;
	}
?>