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
$teamID 	= $formDataArray['teamID'];
$teamName  	= $formDataArray['teamName'];
$teamConf     = $formDataArray['teamConference'];
$teamDivision = $formDataArray['teamDivision'];
$teamWins 	= $formDataArray['teamWins'];
$teamLoses	= $formDataArray['teamLoses'];
$teamTies 	= $formDataArray['teamTies'];
$teamTDs 	= $formDataArray['teamTDs'];

/**
 * Upload and check for file, return error
 * otherwise continue with SQL Query
 */
$teamLogoFile = $_FILES['teamLogo'];

$filePath = uploadTeamImage($teamLogoFile);

//
//if($teamLogoFile['size'] > 0) {
//    $uploadDir = 'uploads/';
//    $teamLogoName  = imageUpload($teamLogoFile, $uploadDir);
//}
//uploadTeamImage($teamLogoFile);




// Build Query
$sqlQuery = "UPDATE nfl_teams SET 
    teamName='$teamName',
    teamConference='$teamConf',
    teamDivision='$teamDivision',
    teamWins='$teamWins',
    teamLoses='$teamLoses',
    teamTies='$teamTies',
    teamTDs='$teamTDs',
    teamLogo='$filePath'
WHERE id=$teamID";

// if file exists, SQL won't be executed
if(empty($_SESSION['upload_error'])) {
    if(!$connection->query($sqlQuery)) {
        $_SESSION['error'] = $connection->error;
    } else {
        $_SESSION['success'] = "Succesfully added $teamName!";
    }
}

header('location: /team/?q='.$teamID);



