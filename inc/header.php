<?php
require_once 'config/connect.php';
include 'inc/functions.php';


//GETTING THE DEFAULT TIME ZONE
date_default_timezone_set('America/Indianapolis');

// SELECTION ADS FROM THE DATABASE
$get_ad = "SELECT * FROM ad_banner";
$run_ad = $db->query($get_ad);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Mali&display=swap" rel="stylesheet">
  <title>Take it or Leaf it | Best flower Arrangements</title>
</head>

<body>
  <div class="container-fluid header-bg"> <!-- MAIN CONTAINER START-->
    <div class="row top-menu"> <!-- TOP MENU START-->
	  <div class="col-md-2">
      </div>
      <div class="col-md-10 d-flex justify-content-end">
        <p class="h6"><?= date("l\, F j \| h:i A")?></p>
      </div>
    </div> <!-- TOP MENU END-->

    <div class="container px-0"> <!-- SUB CONTAINER START-->
      <nav class="navbar navbar-expand-lg navbar navbar-light m-0"> <!-- NAVIGARION MENU START-->
        <a class="navbar-brand" href="index.php"> 
          <img src="assets\img\logo3.png" alt=""><!-- WEBSITE LOGO-->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-4" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <?php if (isset($_SESSION['email'])): ?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Flowers</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="categories.php?cat=flowers">All Flowers</a>
                <a class="dropdown-item" href="categories.php?cat=aniversary">Aniversary</a>
                <a class="dropdown-item" href="categories.php?cat=marriage">Marriage</a>
                <a class="dropdown-item" href="categories.php?cat=graduation">Graduation</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gifts</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="categories.php?cat=gifts">All Gifts</a>
                <a class="dropdown-item" href="categories.php?cat=teddy">Teddy Bears</a>
                <a class="dropdown-item" href="categories.php?cat=chocolate">Chocolate</a>
              </div>
            </li>
            <li class="menu-separator">
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i> My Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> logout: <span class="text-danger"><?php echo $_SESSION['email']?></span></a>
            </li>
            <?php else: ?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Flowers</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="categories.php?cat=flowers">All Flowers</a>
                <a class="dropdown-item" href="categories.php?cat=aniversary">Aniversary</a>
                <a class="dropdown-item" href="categories.php?cat=marriage">Marriage</a>
                <a class="dropdown-item" href="categories.php?cat=graduation">Graduation</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gifts</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="categories.php?cat=gifts">All Gifts</a>
                <a class="dropdown-item" href="categories.php?cat=teddy">Teddy Bears</a>
                <a class="dropdown-item" href="categories.php?cat=chocolate">Chocolate</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </nav> <!-- NAVIGARION MENU END-->

      <div class="container d-flex" id="ads-banner"> <!-- ADS BANNER START-->
        <div class="col-md-6">
          <img src="assets\img\display.png" class="img-fluid" alt="">
          <p class="lead">Providing Flower Arrangements for every occasion, bringing joy to those who need it with
            beautiful colors and scents.</p>
          <form action="search.php" method="POST" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search for an item" name="search">
            <button class="search-btn my-2 my-sm-0" name="search-btn" type="submit">Search</button>
          </form>
        </div>
        <div class="col-md-6 ads-display">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="categories.php?cat=chocolate"><img src="assets\img\Banner\adFour.jpg" class="d-block w-100" alt="..."></a>
              </div>
              <?php while($ad = mysqli_fetch_assoc($run_ad)):?>
              <div class="carousel-item">
                <a href="<?= $ad['ad_link']; ?>"><img src="<?= $ad['ad_img']; ?>" class="d-block w-100" alt="..."></a>
              </div>
              <?php endwhile; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div> <!-- ADS BANNER END-->
    </div> <!-- SUB CONTAINER END-->
  </div> <!-- MAIN CONTAINER END-->
