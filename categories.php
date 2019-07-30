<?php
 include 'inc/header.php';
 //include 'inc/sidebar.php';
 $run_items = $db->query($get_items);
?>

      <!-- Main Content-->
      <div class="container">
      <div class="col-md-12">
        <h2 class="text-center m-5 section-title" id="flowers-section"><?php echo $cat_name; ?></h2>
        <div class="row mb-3">
          <?php while($items = mysqli_fetch_assoc($run_items)) : ?>
          <div class="col-lg-2 col-md-4 d-flex flex-column align-items-center mb-4">
            <img src="<?= $items['img']; ?>" alt="flowers" class="item-thumb" data-toggle="modal" data-target="#details-1">
            <a href="item.php?id=<?php echo $items['item_id']; ?>" class="item-title"><?= $items['item_name']; ?></a>
            <p class="price text-success">Price: $<?= $items['sell_cost']; ?></p>
          </div>
          <?php endwhile; ?>
        </div>
      </div><!-- Main Content end-->
      </div>
    <?php include 'inc/footer.php';?>
