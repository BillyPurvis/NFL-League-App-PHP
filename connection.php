<?php 
	
    require('core/config.php');

	// Create Connection
	$connection = new mysqli($host, $username, $password, $database);

	if(mysqli_connect_error()) {
		die('Err');
	}

	// instantiate session
    session_start();