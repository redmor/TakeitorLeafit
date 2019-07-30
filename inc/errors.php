
<?php  if (count($errors) > 0) : ?>
<?php /************************************************** Check for Errors **************************************************/ ?>
		<?php foreach ($errors as $error) : ?>
			<div id="errors" class="alert alert-danger text-center" role="alert"><?php echo $error ?></div>
		<?php endforeach ?>
<?php  endif ?>


<?php  if (count($successful) > 0) : ?>
<?php /************************************************** Check for Success **************************************************/ ?>
		<?php foreach ($successful as $success) : ?>
			<div id="errors" class="alert alert-success text-center" role="alert"><?php echo $success ?></div>
		<?php endforeach ?>
<?php  endif ?>
