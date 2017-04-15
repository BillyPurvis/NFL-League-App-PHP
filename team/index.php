<?php 

	require('../head.php');
	require('../connection.php');

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
                                    if ($teamItem['teamConference'] == "NFC") : ?>
                                        <option selected value="NFC">NFC</option>
                                        <option value="AFC">AFC</option>
                                    <?php elseif($teamItem['teamConference'] != "NFC") : ?>
                                        <option value="NFC">NFC</option>
                                        <option selected value="AFC">AFC</option>
                                <?php endif; ?>

                            </select>
                        </div>
                        <div class="form-field">
                            <label>Division</label>
                            <select name="teamDivision">
                                <?php
                                    $division = ['ACN', 'ACE', 'ACS', 'ACW', 'NCN', 'NCE', 'NCS', 'NCW'];
                                    foreach ($division as $divisionName) : ?>
                                        <?php if ($divisionName == $teamItem['teamDivision']) : ?>
                                            <option value="<?= $divisionName; ?>" selected><?= $divisionName; ?></option>
                                        <?php else : ?>
                                        <option value="<?= $divisionName; ?>"><?= $divisionName; ?></option>
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

