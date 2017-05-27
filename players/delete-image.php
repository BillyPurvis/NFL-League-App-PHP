<?php

require(__DIR__.'/core/bootstrap.php');

$teamID = $_GET['id'];

removeImage($teamID, "nfl_teams", "teamLogo");

header('location: /team/?q='.$teamID);
