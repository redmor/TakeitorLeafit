<?php include 'inc/header.php';?>

<?php if (isset($_SESSION['email'])): ?>

<?php echo("<script>location.href = 'index.php';</script>"); ?>

<?php else: ?>

<div class="container">

  <div class="login_main">

    <div class="row">

      <div class="col-sm-12 mb-3">

        <h2 class="text-center m-5 section-title" id="flowers-section">Registration Form</h2>

      </div>

      <div class="col-sm-6">

        <?php include('inc/errors.php'); ?>

        <form method="POST" action="register.php#flowers-section">

          <div class="form-row">

            <div class="form-group col-md-6">

              <label for="fname">First name</label>

              <input type="text" class="form-control" name="f_name" id="fname" placeholder="First name">

            </div>

            <div class="form-group col-md-6">

              <label>Last name</label>

              <input type="text" class="form-control" name="l_name" placeholder="last name">

            </div>

          </div>

          <div class="form-group">

            <label>Email</label>

            <input type="email" class="form-control" name="email" placeholder="Email">

          </div>

          <div class="form-group">

            <label>Street</label>

            <input type="text" class="form-control" name="street" placeholder="Street">

          </div>

          <div class="form-row">

            <div class="form-group col-md-6">

              <label>City</label>

              <select name="city" class="form-control">

                <option></option>

                <option value="Columbus">Columbus</option>

                <option value="Pittsburgh">Pittsburgh</option>

                <option value="Detroit">Detroit</option>

                <option value="Indianapolis">Indianapolis</option>

              </select>

            </div>

            <div class="form-group col-md-2">

              <label>State</label>

              <select name="state" class="form-control">

                <option></option>

                <option value="OH">OH</option>

                <option value="PA">PA</option>

                <option value="MI">MI</option>

                <option value="IN">IN</option>

              </select>

            </div>

            <div class="form-group col-md-4">

              <label>Zip</label>

              <input type="number" class="form-control" name="zip" size="2" min="11111" max="99999"placeholder="Zip">

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-6">

              <label>Password</label>

              <input type="password" class="form-control" name="password_1" minlength="8" placeholder="password">

            </div>

            <div class="form-group col-md-6">

              <label>Re-enter password</label>

              <input type="password" class="form-control" name="password_2" minlength="8" placeholder="re-enter password">

            </div>

          </div>

          <div class="form-group">

            <input name="reg_user" type="submit" value="Register" class="btn btn-warning">

          </div>

        </form>

      </div>



      <div class="col-sm-6">



      </div>

    </div>

  </div>

</div>

<?php endif; ?>

<?php include('inc/footer.php'); ?>

