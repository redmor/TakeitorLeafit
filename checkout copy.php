<?php
include 'inc/header.php';

if (isset($_SESSION['email'])){

    $user_email = $_SESSION['email'];
    $get_user = "SELECT * FROM customer WHERE email = '{$user_email}'";
    $run_user = $db->query($get_user);


    $date = strtotime("+1 day");
    $del_date = date('Y-m-d', $date);
}
?>



<?php if (isset($_SESSION['email'])): ?>
<div class="container">
  <div class="login_main">
    <div class="row">
      <!-- Row Start-->

      <div class="col-sm-12 mb-3">
        <h2 class="text-center m-5 section-title" id="flowers-section">Check Out</h2>
        <?php include('inc/errors.php'); ?>
      </div>

      <div class="col-sm-6 border-right">
        <!-- Customer info Start-->
        <h3><span class="num-badge">1</span> Shipping Address</h3>
        <?php while($user = mysqli_fetch_assoc($run_user)) : ?>
        <form method="POST" action="checkout.php">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="fname">First name</label>
              <input type="text" class="form-control" value="<?php echo $user['first_name']; ?>" name="f_name"
                id="fname" placeholder="First name">
            </div>
            <div class="form-group col-md-6">
              <label>Last name</label>
              <input type="text" class="form-control" value="<?php echo $user['last_name']; ?>" name="l_name"
                placeholder="last name">
            </div>
          </div>
          <div class="form-group">
            <label>Street</label>
            <input type="text" class="form-control" value="<?php echo $user['street']; ?>" name="street"
              placeholder="Street">
          </div>
          <div class="form-row">
            <div class="form-group col-md-5">
              <label>City</label>
              <select name="city" class="form-control">
                <option value="<?php echo $user['city']; ?>"><?php echo $user['city']; ?></option>
                <option value="Columbus">Columbus</option>
                <option value="Pittsburgh">Pittsburgh</option>
                <option value="Detroit">Detroit</option>
                <option value="Indianapolis">Indianapolis</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label>State</label>
              <select name="state" class="form-control">
                <option value="<?php echo $user['state']; ?>"><?php echo $user['state']; ?></option>
                <option value="OH">OH</option>
                <option value="PA">PA</option>
                <option value="MI">MI</option>
                <option value="IN">IN</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>Zip</label>
              <input type="number" class="form-control" value="<?php echo $user['zip']; ?>" name="zip" size="2"
                min="11111" max="99999" placeholder="Zip">
            </div>
          </div>
          <h3><span class="num-badge">2</span> Payment Method</h3>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="owner">Card Holder</label>
              <input type="text" class="form-control" id="owner">
            </div>
            <div class="form-group col-md-4">
              <label for="cvv">CVV</label>
              <input type="text" class="form-control" id="cvv">
            </div>
          </div>
          <div class="form-group" id="card-number-field">
            <label for="cardNumber">Card Number</label>
            <input type="text" class="form-control" id="cardNumber">
          </div>
          <div class="form-row ">
            <div class="form-group col-md-6 d-flex">
              <select class="form-control mr-2">
                <option value="01">January</option>
                <option value="02">February </option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select class="form-control">
                <option value="19"> 2019</option>
                <option value="20"> 2020</option>
                <option value="21"> 2021</option>
				        <option value="22"> 2022</option>
                <option value="23"> 2023</option>
                <option value="24"> 2024</option>
              </select>
            </div>
            <div class="form-group col-md-6">
			<div class="h1">
			  <i class="fab fa-cc-visa"></i>
              <i class="fab fa-cc-mastercard"></i>
			</div>
            </div>
          </div>
          <div class="form-group">
            <input name="placeOrder" type="submit" value="Place an order" class="btn btn-warning">
          </div>

        <?php endwhile; ?>
      </div> <!-- Customer info End-->

      <div class="col-sm-6 border-left">
        <!-- Order Summary Start-->
        <h3><span class="num-badge">3</span> Order Summary</h3>
        <table class="table table-bordered">
          <tr>
            <td>Products</td>
            <td><?php echo $itemName; ?></td>
          </tr>
          <tr>
            <td># items</td>
            <td><?php echo $itemNum; ?></td>
          </tr>
          <tr>
            <td>Total price</td>
            <td><?php echo $total; ?></td>
          </tr>
        </table>
        <input type="hidden" name="itemName" value="><?php echo $itemName; ?>">
        <input type="hidden" name="itemNum" value="><?php echo $itemNum; ?>">
        <input type="hidden" name="itemtotal" value="><?php echo $total; ?>">

        <div class="my-5">
          <h3><span class="num-badge">4</span> Other Options</h3>

        <div class="form-group">
          <label for="del-date" class="col-form-label">Choose Your Delivery Date</label>
          <div class="col-10">
            <input class="form-control" type="date" value="<?php echo $del_date; ?>" min="<?php echo $del_date; ?>" id="del-date">
          </div>
        </div>
        </div>

      </div> <!-- Order Summary End-->
      </form>
    </div><!-- Row End-->

  </div>
</div>
<?php else: ?>
<?php //echo("<script>location.href = 'login.php';</script>"); ?>
<?php header('location: login.php'); // CHANGE LOCATION AFTER SUCCESS ?>
<?php endif; ?>
<?php include('inc/footer.php'); ?>