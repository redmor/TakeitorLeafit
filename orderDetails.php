<?php
include 'inc/header.php';

 $order_id = mysqli_real_escape_string($db, $_GET['order_id']);

if (isset($_SESSION['email'])){

    $get_update_order = "SELECT order_status, oi.order_num, i.item_id, oi.qty, i.item_name, total, del_addy, del_date, trans_date 
                         FROM customer AS c JOIN order_history AS h ON c.acct_num = h.acct_num 
                                                     JOIN order_items AS oi on h.order_num = oi.order_num 
                                                     JOIN items AS i ON oi.item_id = i.item_id 
                         WHERE id={$order_id}";
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
    </div>
    <div class="row my-5">
        <div class="col-md-10 mx-auto">
            <?php while($order_update = mysqli_fetch_assoc($run_update_order)) : ?>
            <?php if($order_update['order_status'] == 'Canceled') : ?>
                <div class="col-md-12 border py-3">
                    <table class="table table-striped">
                    <thead>
                        <div class="col-md-12 d-flex justify-content-between">
                            <h3>Order (#<?php echo $order_update['order_num']; ?>)</h3>
                            <h4><?php echo $order_update['trans_date']; ?></h4>
                        </div>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Number of items</th>
                            <td><?php echo $order_update['qty']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Items</th>
                            <td><a href="item.php?id=<?php echo $order_update['item_id']; ?>"><?php echo $order_update['item_name']; ?></a></td>
                        </tr>
                        <tr>
                            <th scope="row">Total</th>
                            <td>$<?php echo $order_update['total']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Delivery Address</th>
                            <td><?php echo $order_update['del_addy'];?></td>
                        </tr>
                        <tr>
                            <th scope="row">Delivery Date</th>
                            <td><?php echo $order_update['del_date']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Order Status</th>
                            <?php if($order_update['order_status'] == 'Canceled'):?>
                            <?php echo "<td class='text-danger'>". $order_update['order_status'] ."</td>"?>
                            <?php else:?>
                            <?php echo "<td>". $order_update['order_status'] ."</td>"?>
                            <?php endif;?>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="col-md-12 py-3">
                    <table class="table table-striped">
                    <thead>
                        <div class="col-md-12 d-flex justify-content-between">
                            <h3>Order (#<?php echo $order_update['order_num']; ?>)</h3>
                            <h4><?php echo $order_update['trans_date']; ?></h4>
                        </div>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Number of items</th>
                            <td><?php echo $order_update['qty']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Items</th>
                            <td><a href="item.php?id=<?php echo $order_update['item_id']; ?>"><?php echo $order_update['item_name']; ?></a></td>
                        </tr>
                        <tr>
                            <th scope="row">Total</th>
                            <td>$<?php echo $order_update['total']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Delivery Address</th>
                            <td><?php echo $order_update['del_addy'];?></td>
                        </tr>
                        <tr>
                            <th scope="row">Delivery Date</th>
                            <td><?php echo $order_update['del_date']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Order Status</th>
                            <?php if($order_update['order_status'] == 'Canceled'):?>
                            <?php echo "<td class='text-danger'>". $order_update['order_status'] ."</td>"?>
                            <?php else:?>
                            <?php echo "<td>". $order_update['order_status'] ."</td>"?>
                            <?php endif;?>
                        </tr>
                        <tr>
                            <th scope="row">Actions</th>
                            <td>
                                <form action="orderDetails.php?order_id=<?php echo $order_update['id']; ?>"
                                    method="POST">
                                    <input type="submit" class="btn btn-sm btn-danger btn-cancel" name="cancelOrdr" value="Cancel">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php //echo("<script>location.href = 'login.php';</script>"); ?>
    <?php header('location: login.php'); // CHANGE LOCATION AFTER SUCCESS ?>
    <?php endif; ?>

    <?php include('inc/footer.php'); ?>

    <!--<script>
$(document).ready(function(){
    var getVal = $('.order_status').text();
    if(getVal == 'Canceled'){
        $('.btn-cancel').remove();
    }
    
  });
</script>