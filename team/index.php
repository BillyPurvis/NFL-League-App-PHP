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
							<label>Net PTs</label>
							<input type="number" name="teamPoints" value="<?= $teamItem['teamPoints']; ?>">
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

