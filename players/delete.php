<?php

require(__DIR__.'/../core/bootstrap.php');

$playerID = $_GET['playerID'];
// delete statement
$deleteQuery = "DELETE FROM nfl_players WHERE id=$playerID";
$connection->query($deleteQuery);

header('location: /players');
