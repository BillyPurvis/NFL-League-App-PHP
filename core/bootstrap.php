<?php
require(__DIR__.'/config.php');
require(__DIR__.'/connection.php');
require(__DIR__ . '/../players/fetchAllPlayers.php');
// instantiate session
session_start();


function getAllTeams() {
    global $connection;

    $orderBy = isset($_GET['q']) ? $_GET['q'] : 'teamPoints';
    $conferenceOpt = isset($_GET['c']) ? $_GET['c'] : null;
    $divisionOpt = isset($_GET['d']) ? $_GET['d'] : null;

    $statementAppend = '';
    if(isset($conferenceOpt)) {
        $statementAppend = "WHERE teamConference='$conferenceOpt'";
    } elseif (isset($divisionOpt)) {
        $statementAppend = "WHERE teamDivision='$divisionOpt'";
    }
    // statement
    $statement = "SELECT * FROM nfl_teams $statementAppend ORDER BY $orderBy DESC";


    return $connection->query($statement);
}

/**
 * Return a single team row
 * @param $id, integer, team ID in database
 */
function getSingleTeam($id) {
    global $connection;

    $statement = "SELECT * FROM nfl_teams WHERE id=$id";

    $teamResults = $connection->query($statement);

    foreach ($teamResults as $teamResult) {
        return $teamResult;
    }
}
/**
 * Returns the the current player's teamID converted into there
 * relative teamName
 *
 * @param $teamResults, Array, array of all the teams
 * @param $player, Array, array of the current player
 *
 */
function getPlayerTeamName($teamResults, $player) {
    foreach ($teamResults as $teamResult) {
        if ($teamResult['id'] === $player['playerTeamID']) {
            return html_entity_decode($teamResult['teamName']);
        }
    }
}


function isImage($file) {

    $fileIsImage = getimagesize($file);

    if(!$fileIsImage) {
        return false;
    }

    return true;
}

function isImageSizeExceeded($fileSize) {

    $maxUploadSize = 1048576;

    if($fileSize > $maxUploadSize) {
        return true;
    }

    return false;

}
// Upload image
function uploadTeamImage($file) {

    $uploadDir = 'uploads/';
    $isImage = isImage($file['tmp_name']);
    $isImageSizeExceeded  = isImageSizeExceeded($file['size']);

    if($isImage && !$isImageSizeExceeded) {
        move_uploaded_file($file['tmp_name'], $uploadDir.$file['name']);
        return $uploadDir.$file['name'];
    } else {
        return false;
    }
}

/**
 * Deletes the image associated to a user
 * @param $id, String, The current items MySQL row id
 * @param $table, String, Table to query
 * @param $columnName, String, column to delete image path from
 */
function removeImage($id, $table, $columnName) {
    global $connection;
    // TODO Stop chaning
    $image = getSingleTeam($id)[$columnName];
    unlink($image);

    // Empty image path column
    $statement =  "UPDATE $table SET $columnName='' WHERE id='$id'";

    if(!$connection->query($statement)) {
        $_SESSION['error'] = $connection->error;
    } else {
        $_SESSION['success'] = "Successfully removed image!";
    }

}

function createTeam($query) {
    global $connection;

    if(!$connection->query($query)) {
        $_SESSION['error'] = "Failed to create team";
        return;
    }
    $_SESSION['success'] = "Created team.";
}