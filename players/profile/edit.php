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
$playerTeamID = $formDataArray['playerTeamID'];
$playerBio = $formDataArray['playerBio'];
$playerPosition = $formDataArray['playerPosition'];

// Build Query
$sqlQuery = "UPDATE nfl_players SET 
    playerName='$playerName',
    playerTeamID='$playerTeamID',
    playerBio='$playerBio',
    playerPosition='$playerPosition'
WHERE id=$playerID";

if(!$connection->query($sqlQuery)) {
    $_SESSION['error'] = $connection->error;
} else {
    $_SESSION['success'] = "Successfully updated $teamName!";
}

header('location: /players');



