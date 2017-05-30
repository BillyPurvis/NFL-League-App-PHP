<?php

require(__DIR__.'/../core/bootstrap.php');

$playerID = $_GET['id'];

removeImage($playerID, "nfl_players", "playerImage");

header('location: /players/profile/?playerID='.$playerID);
