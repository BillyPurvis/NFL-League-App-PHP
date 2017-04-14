<?php 
	
	require('connection.php');

	// statement
    $fetchAllQuery = "SELECT * FROM nfl_teams ORDER BY teamPoints DESC";

	$queryResults = $connection->query($fetchAllQuery);

	$connection->close();

	/*
	 * Before xDebug throws a wobbly with mySQL...
	 */
    unset($connection);