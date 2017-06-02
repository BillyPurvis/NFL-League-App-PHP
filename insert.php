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
$teamLogoName = '';
$file = $_FILES['teamLogo'];
$fileErrorCode = $file['error'];

if(!empty($fileErrorCode)) {
    array_push($uploadErrors, 'Issue');
} else {
    $uploadPath = uploadTeamImage($file);
    if($uploadPath !== false) {
        $teamLogoName = $uploadPath;
    }
}
// Build Query
$sqlQuery = "INSERT INTO nfl_teams (teamName, teamConference, teamDivision,
 teamPoints, teamPF, teamPA, teamWins, teamLoses, teamTies, teamTDs, teamLogo) 
 VALUES ('$teamName', '$teamConf', '$teamDivision',
  $teamPF-$teamPA, $teamPF, $teamPA, $teamWins, 
  $teamLoses, $teamTies, $teamTDs, '$teamLogoName')";


// if file exists, SQL won't be executed
if(empty($_SESSION['upload_error'])) {
    if(!$connection->query($sqlQuery)) {
        $_SESSION['error'] = $connection->error;
    } else {
        $_SESSION['success'] = "Success!";
    }
}

header('location: /');



