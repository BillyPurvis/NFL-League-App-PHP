<?php if (!empty($_SESSION['success']) ) : ?>
	<div class="alert alert-success">
		<p><?= $_SESSION['success']; ?></p>
	</div>
<?php elseif (!empty($_SESSION['error'])) : ?>
	<div class="alert alert-warning">
		<p><?= $_SESSION['error']; ?></p>
	</div>
<?php endif ?>
<?php 
	// reset variables
	$_SESSION['success'] = "";
	$_SESSION['error'] = "";
 ?>
