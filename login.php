<?php 
include('inc/header.php');
?>

<?php if (isset($_SESSION['email'])): ?>
<?php //echo("<script>location.href = 'index.php';</script>"); ?>
<?php header('location: index.php'); // CHANGE LOCATION AFTER SUCCESS ?>
<?php else: ?>
<div class="container">
  <div class="login_main">
    <div class="row">
      <div class="col-sm-12 mb-3">
        <h2 class="text-center m-5 section-title" id="flowers-section">Login</h2>
      </div>
      <div class="col-sm-6">
        <?php include('inc/errors.php'); ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Email</label>
              <input placeholder="email" class="form-control" name="email" type="email" autofocus>
            </div>
            <div class="form-group col-md-6">
              <label>Password</label>
              <input placeholder="Password" class="form-control" name="password" type="password">
            </div>
          </div>
          <div class="form-group">
            <input class="btn btn-warning" name="login_user" type="submit" value="Login">
          </div>
        </form>
        <div class="row">
          <div class="col-md-12 mb-5">
            <p>Not a memeber yet? <a href="register.php">Register here</a></p>
          </div>
        </div>
      </div>
      <div class="col-sm-6">

      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php include('inc/footer.php'); ?>
