<?php if (!empty($_SESSION['success']) ) : ?>
	<div class="alert alert-success">
		<p><?= $_SESSION['success']; ?></p>
	</div>
<?php elseif (!empty($_SESSION['error']) || !empty($_SESSION['upload_error'])) : ?>
	<div class="alert alert-warning">
		<p><?= $_SESSION['error']; ?></p>
        <p><?= $_SESSION['upload_error']; ?></p>
	</div>
<?php endif ?>
<?php 
	// reset variables
	$_SESSION['success'] = "";
	$_SESSION['error'] = "";
	$_SESSION['upload_error'] = "";
 ?>
