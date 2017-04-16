<?php
	
	require('connection.php');

	if(isset($_POST)) {
		// Sanitize data
		$formDataArray = [];
		foreach ($_POST as $key => $value) {
			$formDataArray[$key] = htmlspecialchars(mysqli_real_escape_string($connection, $value)) . '\'';
		}
	}

	// Fetch Form Data
	$insertData = [
        'teamName'       => $formDataArray['teamName'],
        'teamConference' => $formDataArray['teamConference'],
        'teamDivision' => $formDataArray['teamDivision'],
        'teamPoints'    => $formDataArray['teamPF'] - $formDataArray['teamPA'] .' \'',
        'teamPF'        => $formDataArray['teamPF'],
        'teamPA'        => $formDataArray['teamPA'],
        'teamWins '	    => $formDataArray['teamWins'],
        'teamLoses'	    => $formDataArray['teamLoses'],
        'teamTies'	    => $formDataArray['teamTies'],
        'teamTDs'	    => $formDataArray['teamTDs']
    ];
	// Build Query
	//$sqlQuery = "INSERT INTO nfl_teams (teamName, teamConference, teamDivision, teamPoints, teamPF, teamPA, teamWins, teamLoses, teamTies, teamTDs) VALUES ('$teamName', '$teamConf', '$teamDivision', $teamPF-$teamPA, $teamPF, $teamPA, $teamWins, $teamLoses, $teamTies, $teamTDs)";

    $newSql = sprintf('INSERT INTO nfl_teams (%s) values (%s)',
        implode(',', array_keys($insertData)),
        '\'' . implode(', \'', array_values($insertData))
    );

    $formattedSQL = rtrim($newSql, '\'');


	if(!$connection->query($formattedSQL)) {
		$_SESSION['error'] = $connection->error;
	} else {
		$_SESSION['success'] = "Succesfully added $teamName!";
	}

	header('location: /');
	
		

