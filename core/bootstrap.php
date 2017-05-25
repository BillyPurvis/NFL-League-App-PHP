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

/**
 *  Moves the passed file to the passed upload dir
 * @param $file, Array, The passed file object
 * @param $uploadDir, String, Destinaition directory
 */
function imageUpload($file, $uploadDir) {

    // 1MB max upload
    $maxUploadSize = 1048576;

    // Get file data
    $tmpFileName = $file['tmp_name'];
    $fileName = $file['name'];
    $fileInfo = getimagesize($tmpFileName);

    // Check if file isn't too large
    if ($fileInfo === false) {
        $_SESSION['upload_error'] = "The was an error with your upload, check the file is correct and less than 1MB";
    } elseif (!file_exists($uploadDir.$fileName) && $fileInfo['size'] < $maxUploadSize) {
        move_uploaded_file($tmpFileName,$uploadDir.$fileName);
    } else {
        $_SESSION['upload_error'] = "Check image doesn't already exist, or exceeds 1MB";
    }
    return $uploadDir.$fileName;
}