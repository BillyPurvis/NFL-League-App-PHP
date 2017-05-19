<?php
require(__DIR__.'/../head.php');
require(__DIR__.'/../core/bootstrap.php');
?>

<h1 class="page-title">NFL Players 2016</h1>
<table>
    <tr>
        <td>Player's Name</td>
        <td>Player's Team</td>
        <td>Player's Position</td>
        <td>Edit Player</td>
        <td>Eject Player</td>
    </tr>
    <?php if (!empty($players->num_rows)) : ?>
        <?php foreach ($players as $player) : ?>
            <tr>
                <td><?= html_entity_decode($player['playerName']); ?></td>
                <?php foreach ($queryResults as $teamItem) : ?>
                    <?php if ($teamItem['id'] === $player['playerTeamID']) :?>
                        <td><?= html_entity_decode($teamItem['teamName']); ?></td>
                    <?php endif; ?>
                <?php endforeach; ?>
                <td><?= html_entity_decode($player['playerPosition']); ?></td>
                <td>
                    <a class="btn" href="/players/profile/?q=<?= $player['id'] ?>">Edit</a>
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
<form id="add-team-form" method="POST" action="/players/insert.php">
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
            <select name="playerTeamID">
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