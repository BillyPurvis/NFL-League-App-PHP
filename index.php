<?php 
require('head.php');
require(__DIR__.'/core/bootstrap.php');


$queryResults = getAllTeams();
function queryFieldLength($queryResults) {
    return $queryResults->field_count;
}
?>

<h1 class="page-title">NFL Standings 2016</h1>
<table>
    <tr>
        <td>NFL Team</td>
        <td><a href="/">Net PTs</a></td>
        <td><a href="?q=teamPF">PF</a></td>
        <td><a href="?q=teamPA">PA</a></td>
        <td><a href="?q=teamWins">W</a></td>
        <td><a href="?q=teamLoses">L</a></td>
        <td><a href="?q=teamTies">T</a></td>
        <td><a href="?q=teamTDs">TDs</a></td>
        <td>Conference</td>
        <td>Division</td>
        <td>Edit Team</td>
        <td>Eject Team</td>
    </tr>
    <?php if (!empty($queryResults->num_rows)) : ?>
        <?php foreach ($queryResults as $teamItem) : ?>
            <tr>
                <td><?= html_entity_decode($teamItem['teamName']); ?></td>
                <td><?= $teamItem['teamPoints']; ?></td>
                <td><?= $teamItem['teamPF']; ?></td>
                <td><?= $teamItem['teamPA']; ?></td>
                <td><?= $teamItem['teamWins']; ?></td>
                <td><?= $teamItem['teamLoses']; ?></td>
                <td><?= $teamItem['teamTies']; ?></td>
                <td><?= $teamItem['teamTDs']; ?></td>
                <td><?= $teamItem['teamConference']; ?></td>
                <td><?= $teamItem['teamDivision']; ?></td>
                <td>
                    <a class="btn" href="/team/?q=<?= $teamItem['id'] ?>">Edit</a>
                </td>
                <td>
                    <a class="btn alt" href="/delete.php?teamID=<?= $teamItem['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php else : ?>
            <tr>

                <td colspan="<?= queryFieldLength($queryResults); ?>" style="text-align: center;"><br>No teams found!</td>
            </tr>
    <?php endif; ?>

</table>
<form id="add-team-form" method="POST" action="/insert.php">
    <?php require('feedback.php') ?>
    <div class="block-head">
        <h1>Add Your Team</h1>
    </div>
    <div class="form-body">
        <div class="form-field">
            <label>Team Name</label>
            <input type="text" name="teamName">
        </div>
        <div class="form-field">
            <label>Conference</label>
            <select name="teamConference">
                <option value="AFC">AFC</option>
                <option value="NFC">NFC</option>
            </select>
        </div>
        <div class="form-field">
            <label>Division</label>
            <select name="teamDivision">
                <option value="ACN">ACN</option>
                <option value="ACE">ACE</option>
                <option value="ACS">ACS</option>
                <option value="ACW">ACW</option>
                <option value="NCN">NCN</option>
                <option value="NCE">NCE</option>
                <option value="NCS">NCS</option>
                <option value="NCW">NCW</option>
            </select>
        </div>
        <div class="form-field">
            <label>Points For</label>
            <input type="number" value="0" name="teamPF">
        </div>
        <div class="form-field">
            <label>Points Against</label>
            <input type="number" value="0" name="teamPA">
        </div>
        <div class="form-field">
            <label>Wins</label>
            <input type="number" value="0" min="0" max="16" name="teamWins">
        </div>
        <div class="form-field">
            <label>Loses</label>
            <input type="number" value="0" min="0"  max="16" name="teamLoses">
        </div>
        <div class="form-field">
            <label>Ties</label>
            <input type="number" value="0" min="0"  max="16" name="teamTies">
        </div>
        <div class="form-field">
            <label>TDs</label>
            <input type="number" value="0" min="0" name="teamTDs">
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

<?php require('foot.php'); ?>