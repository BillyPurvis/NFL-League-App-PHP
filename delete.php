<?php 
	
	require('connection.php');

	$teamID = $_POST['teamID'];
	// delete statement
	$deleteQuery = "DELETE FROM nfl_teams WHERE id=$teamID";
	$connection->query($deleteQuery);

	header('location: /');
