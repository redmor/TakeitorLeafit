<?php
include 'inc/header.php';

if (isset($_SESSION['email'])){
    $user_email = $_SESSION['email'];

    $get_user = "SELECT * FROM customer WHERE email = '{$user_email}'";
    $run_user = $db->query($get_user);

    
    $get_order_history = "SELECT * FROM customer AS c JOIN order_history AS h ON c.acct_num = h.acct_num JOIN order_items AS oi on h.order_num = oi.order_num
                          WHERE email = '{$user_email}' ORDER BY trans_date DESC LIMIT 5";
    $run_order_history = $db->query($get_order_history);

}

?>

<?php if (isset($_SESSION['email'])): ?>
<div class="container">
  <div class="login_main">
    <div class="row"> <!-- Row Start-->
      <div class="col-sm-12 mb-3">
        <h2 class="text-center m-5 section-title" id="flowers-section">My Account</h2>
        <?php include('inc/errors.php'); ?>
      </div>
      <div class="col-sm-6 border-right"> <!-- Customer info Start-->
      <h3>Customer info <i class="fas fa-info"></i></h3>
        <?php while($user = mysqli_fetch_assoc($run_user)) : ?>
        <form method="POST" action="profile.php">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="fname">First name</label>
              <input type="text" class="form-control" value="<?php echo $user['first_name']; ?>" name="f_name" id="fname" placeholder="First name">
            </div>
            <div class="form-group col-md-6">
              <label>Last name</label>
              <input type="text" class="form-control" value="<?php echo $user['last_name']; ?>" name="l_name" placeholder="last name">
            </div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" value="<?php echo $user['email']; ?>" name="email" placeholder="Email" disabled>
          </div>
          <div class="form-group">
            <label>Street</label>
            <input type="text" class="form-control" value="<?php echo $user['street']; ?>" name="street" placeholder="Street">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>City</label>
              <select name="city" class="form-control">
                <option value="<?php echo $user['city']; ?>"><?php echo $user['city']; ?></option>
                <option value="Columbus">Columbus</option>
                <option value="Pittsburgh">Pittsburgh</option>
                <option value="Detroit">Detroit</option>
                <option value="Indianapolis">Indianapolis</option>
              </select>
            </div>
            <div class="form-group col-md-2">
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
              <input type="number" class="form-control" value="<?php echo $user['zip']; ?>" name="zip" size="2" min="11111" max="99999"placeholder="Zip">
            </div>
          </div>
          <div class="form-group">
            <input name="update_user" type="submit" value="update" class="btn btn-warning">
          </div>
        </form>
        <?php endwhile; ?>
      </div><!-- Customer info End-->

      <div class="col-sm-6"> <!-- Change password Start-->
        <h3>Change password <i class="fas fa-lock"></i></h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
          <div class="form-row">
          <div class="form-group col-md-6">
            <label>Current Password</label>
            <input type="password" name="old_pass" class="form-control" placeholder="Enter current pass">
          </div>
          <div class="form-group col-md-6">
            <label>New Password</label>
            <input type="password" name="new_pass" class="form-control" placeholder="Enter new pass" minlength="8">
          </div>
        </div>
          <input name="passChange" type="submit" value="Change" class="btn btn-warning">
        </form>
    </div> <!-- Change password End-->
  </div> <!-- Row End-->
  </div>
  <div class="row my-5">
    <div class="col-md-8">
      <h3>Order History <i class="fas fa-history" id="order_hist"></i></h3>
      <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" width="20%">Date</th>
            <th scope="col" width="40%">Address</th>
            <th scope="col" width="20%">Order #</th>
            <th scope="col">Price</th>
            <th scope="col" width="40%">Delivery date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php while($order_history = mysqli_fetch_assoc($run_order_history)) : ?>
          <tr>
            <td><?php echo $order_history['trans_date']; ?></td>
            <td><?php echo $order_history['del_addy'];?></td>
            <td><?php echo $order_history['order_num']; ?></td>
            <td>$<?php echo $order_history['total']; ?></td>
            <td><?php echo $order_history['del_date']; ?></td>
            <?php if($order_history['order_status'] == 'Canceled'):?>
            <?php echo "<td class='text-danger'>". $order_history['order_status'] ."</td>"?>
            <?php elseif($order_history['order_status'] == 'Delivered'):?>
            <?php echo "<td class='text-success'>". $order_history['order_status'] ."</td>"?>
            <?php elseif($order_history['order_status'] == 'Out For Delivery'):?>
            <?php echo "<td class='text-info'>". $order_history['order_status'] ."</td>"?>
            <?php else:?>
              <?php echo "<td>". $order_history['order_status'] ."</td>"?>
            <?php endif;?>
            <td><a href="orderDetails.php?order_id=<?php echo $order_history['id']; ?>" class="btn btn-sm btn-info">View</a></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<?php //echo("<script>location.href = 'login.php';</script>"); ?>
<?php header('location: login.php'); // CHANGE LOCATION AFTER SUCCESS ?>
<?php endif; ?>
<?php include('inc/footer.php'); ?>
