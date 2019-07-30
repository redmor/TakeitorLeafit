<?php

// SELECT ITEMS FROM DATABASE
$get_items = "SELECT * FROM items WHERE featured = 1 LIMIT 10";
$run_items = $db->query($get_items);

?>

      <!-- Main Content START-->
      <div class="container more_items">
        <hr>
        <div class="row d-flex justify-content-center">
          <?php while($items = mysqli_fetch_assoc($run_items)) : ?>
          <div class="col-1 mb-5">
            <img src="<?= $items['img']; ?>" alt="flowers" class="img-fluid">
            <a href="item.php?id=<?php echo $items['item_id']; ?>" class="item-title" style="font-size: 0.8rem;"><?= $items['item_name']; ?></a>
          </div>
          <?php endwhile; ?>
        </div>
      </div><!-- Main Content END-->
