<?php
 include 'inc/header.php';

 if(isset($_POST["search-btn"])){
    $search = mysqli_real_escape_string($db, $_POST['search']);
    $get_search = "SELECT * FROM items WHERE item_name LIKE '%$search%'";
    $run_search = mysqli_query($db, $get_search);
    $search_result = mysqli_num_rows($run_search);
  }
?>

<!-- Main Content-->
<div class="container">
    <div class="col-md-12">
        <h2 class="text-center m-5 section-title" id="flowers-section">Search Result</h2>
        <div class="row mb-3">
            <?php if($search_result > 0): ?>
            <?php while($items = mysqli_fetch_assoc($run_search)) : ?>
            <div class="col-lg-2 col-md-4 d-flex flex-column align-items-center mb-4 item-box">
                <img src="<?= $items['img']; ?>" alt="flowers" class="item-thumb" data-toggle="modal"
                    data-target="#details-1">
                <a href="item.php?id=<?php echo $items['item_id']; ?>" class="item-title"><?= $items['item_name']; ?></a>
                <p class="price text-success">Price: $<?= $items['sell_cost']; ?></p>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <div class="col-md text-center my-5 py-3 border">
                <h1>No results found!</h1>
            </div>
            <?php endif; ?>
        </div>
    </div><!-- Main Content end-->
</div>
<?php include 'inc/footer.php';?>