<?php
require(__DIR__.'/../head.php');
require(__DIR__.'/../core/bootstrap.php');

$teamResults = getAllTeams();

?>

<h1 class="page-title">NFL Players 2016</h1>
<table>
    <tr>
        <td>Player's Name</td>
        <td>Player's Age</td>
        <td>Player's Team</td>
        <td>Player's Position</td>
        <td>Edit Player</td>
        <td>Eject Player</td>
    </tr>
    <?php if (!empty($players->num_rows)) : ?>
        <?php foreach ($players as $player) : ?>
            <tr>
                <td><?= html_entity_decode($player['playerName']); ?></td>
                <td><?= html_entity_decode($player['playerAge']); ?></td>
                <td><?= getPlayerTeamName($teamResults, $player); ?></td>
                <td><?= html_entity_decode($player['playerPosition']); ?></td>
                <td>
                    <a class="btn" href="/players/profile/?playerID=<?= $player['id'] ?>">Edit</a>
                </td>
                <td>
                    <a class="btn alt" href="/players/delete.php?playerID=<?= $player['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php else : ?>
            <tr>
                <td colspan="<?= $players->field_count ?>" style="text-align: center;"><br>No Player found!</td>
            </tr>
    <?php endif; ?>

</table>
<form id="add-team-form" method="POST" action="/players/insert.php" enctype="multipart/form-data">
    <?php require('../feedback.php') ?>
    <div class="block-head">
        <h1>Add Your Team</h1>
    </div>
    <div class="form-body">
        <div class="form-field">
            <label>Player Image</label>
            <input type="file" name="playerImage">
        </div>
        <div class="form-field">
            <label>Player Name</label>
            <input type="text" name="playerName">
        </div>
        <div class="form-field">
            <label for="playerAge">Player Age</label>
            <input type="number" name="playerAge" min="16" max="99">
        </div>
        <div class="form-field">
            <label>Field Position</label>
            <input maxlength="3" type="text" name="playerPosition">
        </div>
        <div class="form-field">
            <label>Player's Team</label>
            <select name="playerTeamID">
                <?php foreach ($teamResults as $teamResult) : ?>
                    <option value="<?= $teamResult['id'] ?>"><?= $teamResult['teamName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-field">
            <label for="playerBio"></label>
            <textarea maxlength="250" name="playerBio" placeholder="Write bio..."></textarea>
        </div>
    </div>
    <button class="form-footer-btn" type="submit">Add Team</button>
</form>
<?php require('../foot.php'); ?>