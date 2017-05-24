<?php
require(__DIR__.'/../head.php');
require(__DIR__.'/../core/bootstrap.php');

$teamID = $_GET['q'];
// statement
$fetchSingleQuery = "SELECT * FROM nfl_teams WHERE id=$teamID";
$queryResults = $connection->query($fetchSingleQuery);
$connection->close();
?>
<h1 class="page-title">NFL Standings 2016</h1>
    <?php if (!empty($queryResults)) : ?>
        <?php foreach ($queryResults as $teamItem) : ?>
            <form id="add-team-form" method="POST" action="../edit.php">
                <?php require('../feedback.php') ?>
                <div class="form-head">
                    <div class="team-logo">
                        <img src="/<?= $teamItem['teamLogo'];?>" alt="">
                    </div>
                    <h1>Edit Your Team</h1>
                </div>
                <div class="form-body">
                    <div style="display: none;" class="form-field">
                        <label></label>
                        <input type="text" name="teamID" value="<?= $teamID; ?>">
                    </div>
                    <div class="form-field">
                        <label>Team Name</label>
                        <input type="text" name="teamName" value="<?= html_entity_decode($teamItem['teamName']); ?>">
                    </div>
                    <div class="form-field">
                        <label>Conference</label>
                        <select name="teamConference">
                            <?php
                                $conferences = ['AFC', 'NFC'];
                                foreach ($conferences as $conference) : ?>
                                    <?php if ($conference == $teamItem['teamConference']) : ?>
                                        <option selected value="<?= $conference ?>"><?= $conference ?></option>
                                    <?php else : ?>
                                        <option value="<?= $conference ?>"><?= $conference ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Division</label>
                        <select name="teamDivision">
                            <?php
                                $divisions = ['ACN', 'ACE', 'ACS', 'ACW', 'NCN', 'NCE', 'NCS', 'NCW'];
                                foreach ($divisions as $division) : ?>
                                    <?php if ($division == $teamItem['teamDivision']) : ?>
                                        <option value="<?= $division; ?>" selected><?= $division; ?></option>
                                    <?php else : ?>
                                    <option value="<?= $division; ?>"><?= $division; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Wins</label>
                        <input type="number" min="0" max="16" name="teamWins" value="<?= $teamItem['teamWins']; ?>">
                    </div>
                    <div class="form-field">
                        <label>Loses</label>
                        <input type="number" min="0"  max="16" name="teamLoses" value="<?= $teamItem['teamLoses']; ?>">
                    </div>
                    <div class="form-field">
                        <label>Ties</label>
                        <input type="number" min="0"  max="16" name="teamTies" value="<?= $teamItem['teamTies']; ?>">
                    </div>
                    <div class="form-field">
                        <label>TDs</label>
                        <input type="number" min="0" name="teamTDs" value="<?= $teamItem['teamTDs']; ?>">
                    </div>
                </div>
                <button class="form-footer-btn" type="submit">Save Team Updates</button>
            </form>

        <?php endforeach; ?>
    <?php endif; ?>
<?php require('../foot.php'); ?>

