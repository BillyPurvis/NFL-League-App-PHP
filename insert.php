<?php

require(__DIR__.'/core/bootstrap.php');

if(isset($_POST)) {
    // Sanitize data
    $formDataArray = [];
    foreach ($_POST as $key => $value) {
        $formDataArray[$key] = htmlspecialchars(mysqli_real_escape_string($connection, $value));
    }
}
// Fetch Form Data
$teamName  	  = $formDataArray['teamName'];
$teamConf     = $formDataArray['teamConference'];
$teamDivision = $formDataArray['teamDivision'];
$teamPF       = $formDataArray['teamPF'];
$teamPA       = $formDataArray['teamPA'];
$teamWins 	  = $formDataArray['teamWins'];
$teamLoses	  = $formDataArray['teamLoses'];
$teamTies 	  = $formDataArray['teamTies'];
$teamTDs 	  = $formDataArray['teamTDs'];

// Upload img
$uploadErrors = [];
$file = $_FILES['teamLogo'];
$fileErrorCode = $file['error'];


// Check Error Array
if($fileErrorCode !== 0 &&  $fileErrorCode !== 4) {
    // Investigate error
    array_push($uploadErrors, [$fileErrorCode]);
} else {

    $imagePath = uploadTeamImage($file);

    if(!$imagePath) {
        // if false there was an error
    } else {
        // else the path is returned and we can add to the DB query
        $teamLogoName = $imagePath;
    }
}

// Build Query
$sqlQuery = "INSERT INTO nfl_teams (teamName, teamConference, teamDivision,
 teamPoints, teamPF, teamPA, teamWins, teamLoses, teamTies, teamTDs, teamLogo) 
 VALUES ('$teamName', '$teamConf', '$teamDivision',
  $teamPF-$teamPA, $teamPF, $teamPA, $teamWins, 
  $teamLoses, $teamTies, $teamTDs, '$teamLogoName')";

createTeam($sqlQuery);



header('location: /');



