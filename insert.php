<?php
	
	require('connection.php');

	if(isset($_POST)) {
		// Sanitize data
		$formDataArray = [];
		foreach ($_POST as $key => $value) {
			$formDataArray[$key] = htmlspecialchars(mysqli_real_escape_string($connection, $value));	
		}
	}
	// Fetch Form Data
	$teamName  	= $formDataArray['teamName'];
    $teamPF     = $formDataArray['teamPF'];
    $teamPA     = $formDataArray['teamPA'];
	$teamWins 	= $formDataArray['teamWins'];
	$teamLoses	= $formDataArray['teamLoses'];
	$teamTies 	= $formDataArray['teamTies'];
	$teamTDs 	= $formDataArray['teamTDs'];


	// Build Query
	$sqlQuery = "INSERT INTO nfl_teams (teamName, teamPoints, teamPF, teamPA, teamWins, teamLoses, teamTies, teamTDs) VALUES ('$teamName', $teamPF-$teamPA, $teamPF, $teamPA, $teamWins, $teamLoses, $teamTies, $teamTDs)";

	if(!$connection->query($sqlQuery)) {
		$_SESSION['error'] = $connection->error;
	} else {
		$_SESSION['success'] = "Succesfully added $teamName!";
	}

	header('location: /');
	
		

