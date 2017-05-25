<?php

require(__DIR__.'/core/bootstrap.php');

$teamID = $_GET['id'];

removeImage($teamID);

header('location: /team/?q='.$teamID);
