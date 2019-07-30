<?php
 include 'inc/header.php';
 //include 'inc/sidebar.php';

?>

<?php if (isset($_SESSION['email'])): ?>
<!-- Main Content-->
<div class="container">
  <div class="col-md-12">
    <h2 class="text-center m-5 section-title" id="flowers-section">Your Shopping Cart</h2>
    <div style="clear:both"></div>
    <br />
    <h3>Order Details</h3>
    <div class="table-responsive">
      <div align="right">
      </div>
      <table class="table table-bordered">
        <thead>
        <tr>
          <th width="40%">Item Name</th>
          <th width="10%">Quantity</th>
          <th width="20%">Price</th>
          <th width="15%">Total</th>
          <th width="5%">Action</th>
        </tr>
        </thead>
        <?php
          if(isset($_COOKIE["shopping_cart"]))
          {
            $total = 0;
            $itemNum = 0;
            $itemName = null;
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values)
          {
        ?>
        <tr>
          <td><?php echo $values["item_name"]; ?></td>
          <td><?php echo $values["item_quantity"]; ?></td>
          <td>$ <?php echo $values["item_price"]; ?></td>
          <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
          <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span
                class="text-danger">Remove</span></a></td>
        </tr>
        <?php
          $total = $total + ($values["item_quantity"] * $values["item_price"]);
          $itemNum += $values["item_quantity"];
          $itemName = $itemName .= '[+] '. $values["item_name"] .'<br>';
          $GLOBALS['itemName'];
    }
   ?>
        <tr>
          <td colspan="3" align="right">Total</td>
          <td align="right">$ <?php echo number_format($total, 2); ?></td>
          <td></td>
        </tr>
        <tr>
        <form action="checkout.php" method="POST">
          <input type="hidden" name="total" value="$<?php echo number_format($total, 2); ?>">
          <input type="hidden" name="itemNum" value="<?php echo $itemNum; ?>">
          <input type="hidden" name="itemName" value="<?php echo $itemName; ?>">
          <td colspan="5" align="center"><button type="submit" class="btn btn-lg btn-outline-info mb-3" name="cOut-btn">Check Out <i class="fas fa-credit-card"></i></button></td>
        </form>
        </tr>
        <?php
   }
   else
   {
    echo '
    <tr>
     <td colspan="5" align="center">No Item in Cart</td>
    </tr>
    ';
   }
   ?>
      </table>
    </div><!-- Main Content end-->
  </div>
  </div>
  <?php else: ?>
  <?php echo("<script>location.href = 'login.php';</script>"); ?>
  <?php endif; ?>
<?php include 'inc/footer.php';?>
