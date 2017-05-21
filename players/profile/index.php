<?php
require(__DIR__.'/../../head.php');
require(__DIR__.'/../../core/bootstrap.php');

$playerID = $_GET['playerID'];
// statement
$fetchPlayerSQL = "SELECT * FROM nfl_players WHERE id=$playerID";
$playerResults = $connection->query($fetchPlayerSQL);

$queryResults = getAllTeams();

?>




<h1 class="page-title">NFL Standings 2016</h1>
    <?php if (!empty($playerResults)) : ?>
        <?php foreach ($playerResults as $playerResult) : ?>
            <form id="add-team-form" method="POST" action="/players/profile/edit.php">
                <?php require('../../feedback.php') ?>
                <div class="block-head">
                    <h1>Add Your Team</h1>
                </div>
                <div class="form-body">
                    <div style="display: none;" class="form-field">
                        <label></label>
                        <input type="text" name="playerID" value="<?= $playerResult['id']; ?>">
                    </div>
                    <div class="form-field">
                        <label>Player Name</label>
                        <input type="text" name="playerName" value="<?= $playerResult['playerName'] ;?>">
                    </div>
                    <div class="form-field">
                        <label>Field Position</label>
                        <input type="text" name="playerPosition" value="<?= $playerResult['playerPosition'] ;?>">
                    </div>
                    <div class="form-field">
                        <label>Player's Team</label>
                        <select name="playerTeamID" id="">
                        </select>
<!--                        <input type="text" name="playerTeamID" value="--><?//= $playerResult['playerTeamID'] ;?><!--">-->
                    </div>
                </div>
                <button class="form-footer-btn" type="submit">Add Team</button>
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
<?php require('../../foot.php'); ?>

