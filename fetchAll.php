<?php 
	
	require('connection.php');

    $orderBy = isset($_GET['q']) ? $_GET['q'] : 'teamPoints';
	// statement
    $statement = "SELECT * FROM nfl_teams ORDER BY $orderBy DESC";
	$queryResults = $connection->query($statement);
	$connection->close();
	/*
	 * Before xDebug throws a wobbly with mySQL...
	 */
    unset($connection);