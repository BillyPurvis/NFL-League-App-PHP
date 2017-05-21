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
$playerTeamID = $formDataArray['playerTeamID'];
$playerBio = $formDataArray['playerBio'];
$playerPosition = $formDataArray['playerPosition'];

$sqlQuery = "INSERT INTO nfl_players (playerName, playerTeamID, playerBio, playerPosition)
VALUES ('$playerName','$playerTeamID','$playerPosition','$playerBio')";

if(!$connection->query($sqlQuery)) {
    $_SESSION['error'] = $connection->error;
} else {
    $_SESSION['success'] = "Succesfully added $playerName";
}

header('location: /players');



