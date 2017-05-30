<?php

require(__DIR__.'/../../core/bootstrap.php');
if(isset($_POST)) {
    // Sanitize data
    $formDataArray = [];
    foreach ($_POST as $key => $value) {
        // $value = htmlentities($value, ENT_QUOTES);
        $formDataArray[$key] = htmlspecialchars(mysqli_real_escape_string($connection, $value));
    }
}
// Fetch Form Data
$playerID = $formDataArray['playerID'];
$playerName = $formDataArray['playerName'];
$playerAge = $formDataArray['playerAge'];
$playerTeamID = $formDataArray['playerTeamID'];
$playerBio = $formDataArray['playerBio'];
$playerPosition = $formDataArray['playerPosition'];

/**
 * Upload and check for file, return error
 * otherwise continue with SQL Query
 */

$playerImage = $_FILES['playerImage'];
$uploadDir = '../../uploads/players/';
$playerImageName  = imageUpload($playerImage, $uploadDir);

// Build Query
$sqlQuery = "UPDATE nfl_players SET 
    playerName='$playerName',
    playerAge='$playerAge',
    playerTeamID='$playerTeamID',
    playerBio='$playerBio',
    playerPosition='$playerPosition',
    playerImage='$playerImageName'
WHERE id=$playerID";

// if file exists, SQL won't be executed
if(empty($_SESSION['upload_error'])) {
    if(!$connection->query($sqlQuery)) {
        $_SESSION['error'] = $connection->error;
    } else {
        $_SESSION['success'] = "Succesfully edited $playerName!";
    }
}

header('location: /players/profile/?playerID='.$playerID);



