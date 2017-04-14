<?php 
	
	require('connection.php');

	$orderBy = 'teamPoints';
    if(isset($_GET['q'])) {
        $orderBy = $_GET['q'];
    }
	// statement
    $statement = "SELECT * FROM nfl_teams ORDER BY $orderBy DESC";

	$queryResults = $connection->query($statement);

	$connection->close();

	/*
	 * Before xDebug throws a wobbly with mySQL...
	 */
    unset($connection);