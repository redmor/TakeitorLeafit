<?php
session_start();
session_destroy();

header("Location: index.php");
?>
<?php include('inc/header.php'); ?>
  <meta http-equiv="refresh:" content="1;url=index.php" />
<?php include('inc/footer.php'); ?>
