<?php
include('inc/header.php');


	$id = mysqli_real_escape_string($db, $_GET['id']);

	$get_detail = 'SELECT * FROM items WHERE item_id = '.$id;
	$run_detail = $db->query($get_detail);


?>
	<?php if (isset($_SESSION['email'])): ?>
		<div class="container my-5">
			<div class="row d-flex align-items-center">
				<div class="col-md-4">
					<?php while($item = mysqli_fetch_assoc($run_detail)) : ?>
					<img src="<?= $item['img']; ?>" class="img-fluid details-img" alt="item image">
				</div>
				<div class="col-md-6">
					<h3><?= $item['item_name']; ?><?= shareBtn($id); ?></h3>
					<p class="detail-bg"><span class="badge badge-success">Description</span><br> <?= $item['desc']; ?></p>
					<p class="detail-bg"><span class="badge badge-success">Price</span> $<?= $item['sell_cost']; ?></p>
					<form action="cart.php" method="POST">
						<div class="form-group col-md-6">
							<label>Quantity</label>
							<input type="number" class="form-control" name="p_qty" value="1" min="1" max="10">
						</div>
						<div>
							<input type="hidden" name="p_name" value="<?= $item['item_name']; ?>">
							<input type="hidden" name="p_price" value="<?= $item['sell_cost']; ?>">
							<input type="hidden" name="p_id" value="<?= $item['item_id']; ?>">
							<input type="submit" value="Add to cart" class="btn btn-outline-info mb-3 ml-3" name="cart-btn">
							<a href="index.php#flowers-section" class="btn btn-outline-success mb-3" name="back-btn">Continue Shopping <i class="fas fa-chevron-right"></i></a>
						</div>
					</form>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		</div>
<?php else: ?>
<div class="container my-5">
			<div class="row d-flex align-items-center">
				<div class="col-md-4">
					<?php while($item = mysqli_fetch_assoc($run_detail)) : ?>
					<img src="<?= $item['img']; ?>" class="img-fluid details-img" alt="item image">
				</div>
				<div class="col-md-6">
					<h3><?= $item['item_name']; ?><?= shareBtn($id); ?></h3>
					<p class="detail-bg"><span class="badge badge-success">Description</span><br> <?= $item['desc']; ?></p>
					<p class="detail-bg"><span class="badge badge-success">Price</span> $<?= $item['sell_cost']; ?></p>
					<div>
						<a href="index.php#flowers-section" class="btn btn-outline-success mb-3" name="back-btn">Continue Shopping <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
<?php endif; ?>
<?php include 'inc/moreItems.php'; ?>
<?php include('inc/footer.php'); ?>
