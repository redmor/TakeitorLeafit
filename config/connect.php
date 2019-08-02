<?php
	// Start a session for the whole website
	session_start();

	// connect to the database
	//$db = mysqli_connect("cscc-capstone-flowers.czo7kmlutdp9.us-east-2.rds.amazonaws.com", "flowersAdmin", "SolFlowerGreenWater2", "capstoneFlowers");
	  $db = mysqli_connect("localhost", "root", "", "dump20190726");
	
	// connection validation
	if (!$db) {
	die("Error connecting to database: " . mysqli_connect_error());
	}
	
	// define global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('ROOT_URL', 'http://localhost:5050/TakeitorLeafit/');
?>
