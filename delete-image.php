<?php

require(__DIR__.'/core/bootstrap.php');

$teamID = $_GET['id'];

removeImage($teamID);

// Set DB field to null if img is deleted
$statement =  "UPDATE nfl_teams SET teamLogo='' WHERE id='$teamID'";

if(!$connection->query($statement)) {
    $_SESSION['error'] = $connection->error;
} else {
    $_SESSION['success'] = "Successfully updated $teamName!";
}

header('location: /team/?q='.$teamID);
