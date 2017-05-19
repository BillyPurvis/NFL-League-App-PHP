<?php
require(__DIR__.'/../head.php');
require(__DIR__.'/../core/bootstrap.php');
?>

<h1 class="page-title">NFL Standings 2016</h1>
<table>
    <tr>
        <td>NFL Players</td>
    </tr>

    <?php if (!empty($players->num_rows)) : ?>
        <?php foreach ($players as $player) : ?>
            <tr>
                <td><?= html_entity_decode($player['playerName']); ?></td>

            </tr>
        <?php endforeach; ?>

        <?php else : ?>
            <tr>

                <td colspan="<?= queryFieldLength($players); ?>" style="text-align: center;"><br>No Player found!</td>
            </tr>
    <?php endif; ?>

</table>
<form id="add-team-form" method="POST" action="/insert.php">
    <?php require('../feedback.php') ?>
    <div class="block-head">
        <h1>Add Your Team</h1>
    </div>
    <div class="form-body">
        <div class="form-field">
            <label>Player Name</label>
            <input type="text" name="playerName">
        </div>
        <div class="form-field">
            <label>Field Position</label>
            <input type="text" name="playerPosition">
        </div>
        <div class="form-field">
            <label>Player's Team</label>
            <select name="playerTeam">
                <?php foreach ($queryResults as $teamItem) : ?>
                    <option value="<?= $teamItem['id'] ?>"><?= $teamItem['teamName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button class="form-footer-btn" type="submit">Add Team</button>
</form>
<div class="info">
    <div class="block-head">
        <h1>AFC & NFC</h1>
    </div>
    <p>
        The <strong>ACF</strong> (American Football Conference) and <strong>NFC</strong> (National Football Conference), each with 16 teams within
        their conference make up the <strong>32 NFL</strong> teams. Within the each conference, there are 4 divisions; North, East, South & West.
    </p>
</div>

<?php require('../foot.php'); ?>