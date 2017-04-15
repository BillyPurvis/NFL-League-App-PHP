<?php
	require('connection.php');
	if(isset($_POST)) {
		// Sanitize data
		$formDataArray = [];
		foreach ($_POST as $key => $value) {
			// $value = htmlentities($value, ENT_QUOTES);
			$formDataArray[$key] = htmlspecialchars(mysqli_real_escape_string($connection, $value));	
		}
	}
	// Fetch Form Data
	$teamID 	= $formDataArray['teamID'];
	$teamName  	= $formDataArray['teamName'];
    $teamConf     = $formDataArray['teamConference'];
    $teamDivision = $formDataArray['teamDivision'];
	$teamWins 	= $formDataArray['teamWins'];
	$teamLoses	= $formDataArray['teamLoses'];
	$teamTies 	= $formDataArray['teamTies'];
	$teamTDs 	= $formDataArray['teamTDs'];
	// Build Query
	$sqlQuery = "UPDATE nfl_teams SET 
		teamName='$teamName',
		teamConference='$teamConf',
		teamConference='$teamDivision',
		teamWins='$teamWins',
		teamLoses='$teamLoses',
		teamTies='$teamTies',
		teamTDs='$teamTDs'
	WHERE id=$teamID";
	
	if(!$connection->query($sqlQuery)) {
		$_SESSION['error'] = $connection->error;
	} else {
		$_SESSION['success'] = "Succesfully added $teamName!";
	}

	header('location: /');
	
		

