<?php

require(__DIR__.'/core/bootstrap.php');

$teamID = $_GET['teamID'];
$teamImage = getSingleTeam($teamID)['teamLogo'];

// delete statement
$deleteQuery = "DELETE FROM nfl_teams WHERE id=$teamID";
$connection->query($deleteQuery);

unlink($teamImage);

header('location: /');
