<?php 

	require('../connection.php');

	// statement
    $statement = "SELECT * FROM nfl_players";
	$queryResults = $connection->query($statement);
	$connection->close();
	/*
	 * Before xDebug throws a wobbly with mySQL...
	 */
    unset($connection);