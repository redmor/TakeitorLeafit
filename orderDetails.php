<?php
include 'inc/header.php';

 $order_id = mysqli_real_escape_string($db, $_GET['order_id']);

if (isset($_SESSION['email'])){

    $get_update_order = "SELECT * FROM order_history h JOIN order_items i ON h.order_num = i.order_num WHERE id={$order_id}";
    $run_update_order = $db->query($get_update_order);

}

if(isset($_POST['cancelOrdr'])){

    $cancelQry = "UPDATE order_history h JOIN order_items i ON h.order_num = i.order_num SET order_status = 'Canceled' WHERE id={$order_id}";
    $run_cancelQry = $db->query($cancelQry);

    header("location: profile.php#order_hist");
}
      
?>

<?php if (isset($_SESSION['email'])): ?>
<div class="container">
<div class="col-sm-12 mb-3">
    <h2 class="text-center m-5 section-title" id="flowers-section">Order Details</h2>
    <?php include('inc/errors.php'); ?>
</div>
  <div class="row my-5">
    <div class="col-md-10">
      <h3>Order History <i class="fas fa-history"></i></h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Address</th>
            <th scope="col">Order #</th>
            <th scope="col">Price</th>
            <th scope="col">Delivery date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php while($order_update = mysqli_fetch_assoc($run_update_order)) : ?>
          <tr>
            <td><?php echo $order_update['trans_date']; ?></td>
            <td><?php echo $order_update['del_addy'];?></td>
            <td><?php echo $order_update['order_num']; ?></td>
            <td><?php echo $order_update['total']; ?></td>
            <td><?php echo $order_update['del_date']; ?></td>
            <td><?php echo $order_update['order_status']; ?></td>
            <td>
            <form action="orderDetails.php?order_id=<?php echo $order_update['id']; ?>" method="POST">
                <input type="submit" class="btn btn-sm btn-danger" name="cancelOrdr" value="Cancel">
            </form>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php else: ?>
<?php //echo("<script>location.href = 'login.php';</script>"); ?>
<?php header('location: login.php'); // CHANGE LOCATION AFTER SUCCESS ?>
<?php endif; ?>
<?php include('inc/footer.php'); ?>