<?php
include 'inc/header.php';

if (isset($_SESSION['email'])){

    $user_email = $_SESSION['email'];
    $get_user = "SELECT * FROM customer WHERE email = '{$user_email}'";
    $run_user = $db->query($get_user);


    $date = strtotime("+1 day");
    $del_date = date('Y-m-d', $date);
    $max_date = date('Y-m-d', strtotime("+30 days"));
  
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

      <div class="col-sm-6 border-right"> <!-- Customer info Start-->
      <form method="POST" action="checkout.php">
      <!-- //////////////////////////////////////////////// Order Summary ////////////////////////////////////////////////-->
      <div class="my-5">    
      <h3><span class="num-badge">1</span> Order Summary</h3>
        <table class="table table-bordered">
          <tr>
            <td>Products</td>
            <td><?php echo $item_Names; ?></td>
          </tr>
          <tr>
            <td># items</td>
            <td><?php echo $item_Qty; ?></td>
          </tr>
          <tr>
            <td>Total price</td>
            <td>$<?php echo $grand_total; ?></td>
          </tr>
        </table>
        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
        <input type="hidden" name="item_Names" value="<?php echo $item_Names; ?>">
        <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
        <input type="hidden" name="item_Qty" value="<?php echo $item_Qty; ?>">
        </div>

    <!-- //////////////////////////////////////////////// Customer info ////////////////////////////////////////////////-->

        <h3><span class="num-badge">2</span> Shipping Address</h3>
          <?php while($user = mysqli_fetch_assoc($run_user)) : ?>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="fname">First name</label>
                <input type="text" class="form-control" value="<?php echo $user['first_name']; ?>" name="f_name"
                  id="fname" placeholder="First name">
                  <input type="hidden" name="user_acct_num" value="<?php echo $user['acct_num']; ?>">
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
      <?php endwhile; ?>
      </div> <!-- Customer info End-->

      <div class="col-sm-6 border-left"><!-- Order Summary Start-->

    <!-- //////////////////////////////////////////////// Other Options ////////////////////////////////////////////////-->
        <div class="my-5">
          <h3><span class="num-badge">3</span> Other Options</h3>

        <div class="form-group">
          <label for="del-date" class="col-form-label">Choose Your Delivery Date</label>
          <div class="col-10">
            <input class="form-control" name="del-date" type="date" value="<?php echo $del_date; ?>" 
                    min="<?php echo $del_date; ?>" max="<?php echo $max_date; ?>" id="del-date">
          </div>
        </div>
        </div>
    <!-- //////////////////////////////////////////////// Payment Method ////////////////////////////////////////////////-->

    <h3><span class="num-badge">4</span> Payment Method</h3>
    <p class="mb-2">Choose You Payment Method</p>
  <div class="form-row mb-3">
    <div class="form-check form-check-inline h1">
      <input class="form-check-input" type="radio" name="cc" id="Radio1" value="visa" checked>
      <label class="form-check-label" for="Radio1"><i class="fab fa-cc-visa"></i></label>
    </div>
    <div class="form-check form-check-inline h1">
      <input class="form-check-input" type="radio" name="cc" id="Radio2" value="mastercard">
      <label class="form-check-label" for="Radio2"><i class="fab fa-cc-mastercard"></i></label>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="owner">Card Holder</label>
      <input type="text" name="cardHolder" class="form-control" id="owner">
    </div>
    <div class="form-group col-md-4">
      <label for="cvv">CVV</label>
      <input type="text" name="cvv" class="form-control" id="cvv" pattern="\d*" maxlength="3">
    </div>
  </div>
  <div class="form-group" id="card-number-field">
    <label for="cardNumber">Card Number</label>
    <input type="text" name="cardNum" class="form-control" id="cardNumber" pattern="\d*" maxlength="16">
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
  </div>
      </div> <!-- Order Summary End-->
      <div class="form-group mx-auto mt-5">
        <input name="placeOrder" type="submit" value="Place an order" class="btn btn-lg btn-warning">
      </div>
      </form>
    </div><!-- Row End-->

  </div>
</div>
<?php else: ?>
<?php //echo("<script>location.href = 'login.php';</script>"); ?>
<?php header('location: login.php'); // CHANGE LOCATION AFTER SUCCESS ?>
<?php endif; ?>
<?php include('inc/footer.php'); ?>