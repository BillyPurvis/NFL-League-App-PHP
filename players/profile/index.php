<?php
require(__DIR__.'/../../head.php');
require(__DIR__.'/../../core/bootstrap.php');

$playerID = $_GET['playerID'];
// statement
$fetchPlayerSQL = "SELECT * FROM nfl_players WHERE id=$playerID";
$players = $connection->query($fetchPlayerSQL);

$teamResults = getAllTeams();

?>
<h1 class="page-title">NFL Standings 2016</h1>
    <?php if (!empty($players)) : ?>
        <?php foreach ($players as $player) : ?>
            <?php $currentPlayerTeam = getPlayerTeamName($teamResults, $player); ?>
            <div class="info">
                <div class="block-head">
                    <h1><?= $player['playerName'] ?></h1>
                </div>
                <ul>
                    <li><strong>Player's Team:</strong> <?= $currentPlayerTeam; ?></li>
                    <li><strong>Player's Age:</strong> <?= $player['playerAge']; ?></li>
                </ul>
                <h2><strong>Player's Story</strong></h2>
                <p>
                    <?= $player['playerBio']; ?>
                </p>
            </div>
            <form id="add-team-form" method="POST" action="/players/profile/edit.php">
                <?php require('../../feedback.php') ?>
                <div class="block-head">
                    <h1>Edit Player Info</h1>
                </div>
                <div class="form-body">
                    <div style="display: none;" class="form-field">
                        <label></label>
                        <input type="text" name="playerID" value="<?= $player['id']; ?>">
                    </div>
                    <div class="form-field">
                        <label>Player Name</label>
                        <input type="text" name="playerName" value="<?= $player['playerName'] ;?>">
                    </div>
                    <div class="form-field">
                        <label for="playerAge">Player Age</label>
                        <input type="number" name="playerAge" min="16" max="99" value="<?= $player['playerAge']?>">
                    </div>
                    <div class="form-field">
                        <label>Field Position</label>
                        <input maxlength="3" type="text" name="playerPosition" value="<?= $player['playerPosition'] ;?>">
                    </div>
                    <div class="form-field">
                        <label>Player's Team</label>
                        <select name="playerTeamID" id="">
                            <?php foreach ($teamResults as $teamResult) :?>
                                <?php if($teamResult['teamName']  === $currentPlayerTeam) :
                                    // TODO Make team option value an integer id not string

                                    ?>
                                    <option value="<?= $teamResults['playerTeamID']; ?>" selected><?= $currentPlayerTeam ?></option>
                                    <?php else:?>
                                    <option value="<?= $teamResult['id']; ?>"><?= $teamResult['teamName']; ?></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="playerBio"></label>
                        <textarea name="playerBio" maxlength="250" id="" placeholder="Write bio..."></textarea>
                    </div>
                </div>
                <button class="form-footer-btn" type="submit">Add Team</button>
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
<?php require('../../foot.php'); ?>

