<?php

ob_start();

$email = "";
include_once "config/connect.php";

// DECLARING THE ARRAYS
$errors = array();
$successful = array();

/************************************************** REGISTER USERS **************************************************/

if (isset($_POST['reg_user'])) {

  //GET DATA

  $f_name = mysqli_real_escape_string($db, $_POST['f_name']);
  $l_name = mysqli_real_escape_string($db, $_POST['l_name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $street = mysqli_real_escape_string($db, $_POST['street']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $state = mysqli_real_escape_string($db, $_POST['state']);
  $zip = mysqli_real_escape_string($db, $_POST['zip']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  //VALIDATION

  if (empty($email) && empty($password_1)) {
      array_push($errors, "All fields are required");
    }elseif (empty($email)) {
      array_push($errors, "Email is required");
    }elseif (empty($password_1)) {
      array_push($errors, "Password is required");
    }

  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  //SELECT FROM DATABASE

  $sql = "SELECT * FROM customer WHERE email = '".$email."'";
     $result = mysqli_query($db, $sql);
     if(mysqli_num_rows($result)>=1)
        {
         array_push($errors, "Customer already exists");
        }
      else
         {

        if (count($errors) == 0) {
          $password = password_hash($password_1, PASSWORD_DEFAULT); // PASSWORD HASHING
          //WRITE DATA INTO THE DATABASE
          $query = "INSERT INTO customer(first_name, last_name, email, street, city, state, zip, password)
                VALUES('$f_name', '$l_name', '$email', '$street', '$city', '$state', '$zip', '$password')";
          mysqli_query($db, $query);

          header('location: Reg_success.php'); // CHANGE LOCATION AFTER SUCCESS
        }
}
}


/************************************************** LOGIN USERS **************************************************/

if (isset($_POST['login_user'])) {

  //GET DATA
  $email = $_POST['email'];
	$pass = $_POST['password'];

	if (empty($email) || empty($pass)) {
		array_push($errors, 'All fields are required');
		return;
	}

	$query = "SELECT * FROM customer WHERE email = '$email'";
	$result = $db->query($query);

	if (!$result) {
		echo $db->error;
		return;
	}

	if ($result->num_rows <= 0) {
		array_push($errors, 'Could not find user');
		return;
	}

	$user = $result->fetch_object();

	if (!password_verify($pass, $user->password)) {
		array_push($errors, 'Wrong password!');
		return;
	}

	$_SESSION['email'] = $email;
}


/************************************************** CHANGE PASSWORD **************************************************/
if (isset($_POST['passChange'])) {

  //GET DATA
  $email = mysqli_real_escape_string($db, $_SESSION['email']);
  $newPass = mysqli_real_escape_string($db, $_POST['new_pass']);
  $oldPass = mysqli_real_escape_string($db, $_POST['old_pass']);

  $get_currentPass = "SELECT password FROM customer WHERE email='$email'";
  $run_currentPass = $db->query($get_currentPass);

  // PASSWORD VALIDATION
	if (empty($newPass)) {
		array_push($errors, 'Please Enter a New Password');
		return;
	}elseif (empty($oldPass)) {
    array_push($errors, 'Please Enter your current password');
  }

  $user = $run_currentPass->fetch_object();

  //PASS MATCH VALIDATION
  if (!password_verify($oldPass, $user->password)) {
    array_push($errors, 'Your current password does not match the one we have');
    return;
  }

  // UPDATE NEW PASS IF NO ERRORS
  if (count($errors) == 0) {
    $nhp= password_hash($newPass, PASSWORD_DEFAULT);
    $query = "UPDATE customer SET password='$nhp' WHERE email='$email'";
    mysqli_query($db, $query);

    array_push($successful, "Password Updated Successfully!!!");
  }
}


/************************************************** DETERMINE LOCATION **************************************************/
function location($loc) {
  switch($loc){
    case $loc == '1000-Col':
      $city = "Columbus 1";
      break;
    case $loc == '1001-Col':
      $city = "Columbus 2";
      break;
    case $loc == '2000-Pitt':
      $city = "Pittsburgh 1";
      break;
    case $loc == '2001-Pitt':
      $city = "Pittsburgh 2";
      break;
    case $loc == '3000-Det':
    $city = "Detroit 1";
      break;
    case $loc == '3001-Det':
      $city = "Detroit 2";
    break;
    case $loc == '4000-Indy':
      $city = "Indianapolis 1";
      break;
    case $loc == '4001-Indy':
      $city = "Indianapolis 2";
      break;
    default:
      $city = "Columbus 1";
    }
    return $city;
}


/************************************************** UPDATE USERS **************************************************/
if (isset($_POST['update_user'])) {

  //GET DATA
  $f_name = mysqli_real_escape_string($db, $_POST['l_name']);
  $l_name = mysqli_real_escape_string($db, $_POST['f_name']);
  $street = mysqli_real_escape_string($db, $_POST['street']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $state = mysqli_real_escape_string($db, $_POST['state']);
  $zip = mysqli_real_escape_string($db, $_POST['zip']);

  //VALIDATION
  if (empty($f_name) || empty($l_name) || empty($street) || empty($city) || empty($state) || empty($zip)) {
      array_push($errors, "All fields are required");
    }

  //UPDATE DATABASE RECORS IF NO ERRORS
    if (count($errors) == 0) {
      $user_email = $_SESSION['email'];

      $get_update_user = "UPDATE customer SET first_name='$f_name',
                                              last_name='$l_name',
                                              street='$street',
                                              city='$city',
                                              state='$state',
                                              zip='$zip'
                          WHERE email='$user_email'";
      $run_update_user = $db->query($get_update_user);
      array_push($successful, "Updated Successfully!!!");
    }
}


/************************************************** ADD ITEMS TO THE CART **************************************************/

if(isset($_POST["cart-btn"])){
 if(isset($_COOKIE["shopping_cart"])) {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else{
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'item_id');

 if(in_array($_POST["p_id"], $item_id_list)){
  foreach($cart_data as $keys => $values){
   if($cart_data[$keys]["item_id"] == $_POST["p_id"]){
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["p_qty"];
   }
  }
 }
 else{
  $item_array = array(
   'item_id'   => $_POST["p_id"],
   'item_name'   => $_POST["p_name"],
   'item_price'  => $_POST["p_price"],
   'item_quantity'  => $_POST["p_qty"]
  );
  $cart_data[] = $item_array;
 }


 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:cart.php?success=1");
}

if(isset($_GET["action"])){
 if($_GET["action"] == "delete"){
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values){
   if($cart_data[$keys]['item_id'] == $_GET["id"]){
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:cart.php?remove=1");
   }
  }
 }
}

/************************************************** GET CATEGORIES **************************************************/

if(isset($_GET["cat"])){

  // DECLARING AN EMTY VARIABLE FOR CAT NAME
  $cat_name = "";

  //GET REQUESTS
if($_GET["cat"] == "gifts"){
    $get_items = "SELECT * FROM items WHERE item = 'gifts'";
    $cat_name = "All Gifts";
  }elseif($_GET["cat"] == "flowers"){
    $get_items = "SELECT * FROM items WHERE item = 'flowers'";
    $cat_name = "All Flower Arrangements";
  }elseif($_GET["cat"] == "chocolate"){
    $get_items = "SELECT * FROM items WHERE category = 'chocolate'";
    $cat_name = "Chocolate";
  }elseif($_GET["cat"] == "graduation"){
    $get_items = "SELECT * FROM items WHERE category = 'graduation'";
    $cat_name = "Graduation Arrangements";
  }elseif($_GET["cat"] == "marriage"){
    $get_items = "SELECT * FROM items WHERE category = 'marriage'";
    $cat_name = "Marriage Arrangements";
  }elseif($_GET["cat"] == "teddy"){
    $get_items = "SELECT * FROM items WHERE category = 'teddy-bears'";
    $cat_name = "Teddy Bears";
  }elseif($_GET["cat"] == "aniversary"){
    $get_items = "SELECT * FROM items WHERE category = 'anniversary'";
    $cat_name = "Aniversary Arrangements";
  }
}

/************************************************** DISPLAY ORDER DETAILS **************************************************/

if(isset($_POST['cOut-btn'])){
  //GET DATA
  $grand_total = $_POST['grand_total'];
  $item_Qty = $_POST['item_Qty'];  
  $item_Names = $_POST['item_Names'];
  $item_id = $_POST['item_id'];  
}

/************************************************** PLACE ORDERS **************************************************/
if(isset($_POST['placeOrder'])){

  $item_id = $_POST['item_id'];
  $grand_total = $_POST['grand_total'];
  $item_Qty = $_POST['item_Qty'];  
  $item_Names = $_POST['item_Names'];  
  $user_acct_num = $_POST['user_acct_num']; 

  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $street = $_POST['street'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
  $del_address = "$street. $city, $state $zip";

  $del_date = $_POST['del-date'];

  $cardHolder = $_POST['cardHolder'];
  $cvv = $_POST['cvv'];
  $cardNum = $_POST['cardNum'];
  $cc = $_POST['cc'];

  //VALIDATION


  if (empty($f_name)) {
    array_push($errors, "Please Enter Your Name");
  }elseif(empty($l_name)){
    array_push($errors, "Please Enter Your Last Name");
  }elseif(empty($street)){
    array_push($errors, "Please Enter a Valid Street");
  }elseif(empty($zip)){
    array_push($errors, "Please Enter a Valid Zip Code");
  }

  if($cc == 'visa'){
    $pattern = "/^([4]{1})([0-9]{12,16})$/"; 
    if (!preg_match($pattern,$cardNum)) {
      array_push($errors, "Please Enter a Valid VISA Card Number");
    }
  }elseif($cc == 'mastercard') {
    $pattern = "/^([51|52|53|54|55]{2})([0-9]{14,16})$/";
    if (!preg_match($pattern,$cardNum)) {
      array_push($errors, "Please Enter a Valid MASTERCARD Number");
  }
}

  //var_dump($total);

  if(!$errors){

    $qOne = "INSERT INTO order_history (acct_num, del_addy, items_ordered, del_date, `location`)
    VALUES ($user_acct_num, '$del_address', '$item_Names', '$del_date', '1000-Col')";

    $qTwo = "INSERT INTO order_items (item_price, order_num, item_id, qty) 
        SELECT i.sell_cost, MAX(o.order_num), $item_id as item_id, $item_Qty as qty 
        FROM items i CROSS JOIN order_history o 
        WHERE item_id = $item_id";

    $qthree = "UPDATE order_history h SET total=(SELECT SUM(item_price*qty) FROM order_items WHERE order_num=h.order_num) 
          ORDER BY order_num desc limit 1";

    mysqli_query($db,"START TRANSACTION");
    $insert1 = mysqli_query($db, $qOne);
    $insert2 = mysqli_query($db, $qTwo);
    $insert3 = mysqli_query($db, $qthree);
    mysqli_query($db,"COMMIT");

    setcookie('shopping_cart', '', time() - (86400 * 30));
    header("location: order_success.php");
  }
  
}


/************************************************** SOCIAL MEDIA SHARE LINKS **************************************************/

function shareBtn($id){
echo '<span class="shareBtn">
<a href="https://www.facebook.com/sharer.php?u=http://takeitorleafit.store/item.php?id='.$id.'" target="_blank">
<i class="fab fa-facebook-square"></i></a>
<a href="https://twitter.com/intent/tweet/?url=http://takeitorleafit.store/item.php?id='.$id.'" target="_blank">
<i class="fab fa-twitter-square"></i></a>
</span>';
} 

?>
