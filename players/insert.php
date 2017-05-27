<?php

require(__DIR__.'/../core/bootstrap.php');

if(isset($_POST)) {
    // Sanitize data
    $formDataArray = [];
    foreach ($_POST as $key => $value) {
        $formDataArray[$key] = htmlspecialchars(mysqli_real_escape_string($connection, $value));
    }
}
// Fetch Form Data
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
$uploadDir = '../uploads/players/';
$playerImageName  = imageUpload($playerImage, $uploadDir);

$sqlQuery = "INSERT INTO nfl_players (playerImage, playerName,playerAge, playerTeamID, playerBio, playerPosition)
VALUES ('$playerImageName','$playerName','$playerAge','$playerTeamID','$playerBio','$playerPosition')";

// if file exists, SQL won't be executed
if(empty($_SESSION['upload_error'])) {
    if(!$connection->query($sqlQuery)) {
        $_SESSION['error'] = $connection->error;
    } else {
        $_SESSION['success'] = "Succesfully added $playerName!";
    }
}
header('location: /players');



