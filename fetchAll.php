<?php 
	
	require('connection.php');

    $orderBy = isset($_GET['q']) ? $_GET['q'] : 'teamPoints';
    $conferenceOpt = isset($_GET['c']) ? $_GET['c'] : null;
    $divisionOpt = isset($_GET['d']) ? $_GET['d'] : null;

    $statementAppend = '';
    if(isset($conferenceOpt)) {
        $statementAppend = "WHERE teamConference='$conferenceOpt'";
    } elseif (isset($divisionOpt)) {
        $statementAppend = "WHERE teamDivision='$divisionOpt'";
    }
	// statement
    $statement = "SELECT * FROM nfl_teams $statementAppend ORDER BY $orderBy DESC";
	$queryResults = $connection->query($statement);
	$connection->close();
	/*
	 * Before xDebug throws a wobbly with mySQL...
	 */
    unset($connection);