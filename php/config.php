<?php
	session_start();

   	define('DB_SERVER', '127.0.0.1'); //Server IP ADDRESS
   	define('DB_USERNAME', 'drew'); //STUDENT ACCOUNT ADMIN
   	define('DB_PASSWORD', 'trepidation1');//STUDENT ACCOUNT PASSWORD
   	define('DB_DATABASE', 'project');
   	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Could not connect");

   	if (!$db) {
   	 echo "Error: Unable to connect to MySQL." . PHP_EOL;
   	 echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
   	 echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
   	 exit;
	}

?>