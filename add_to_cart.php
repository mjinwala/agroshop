<?php
include("db.php");
session_start();
if($_SESSION['buyer_id'] == null){
    echo"
    <script>
     window.location.href='login.php';
    </script>
    "; 
}
else{
$product = $_SESSION['product'];
$user=$_SESSION['buyer_id'];
$quantity = $_POST['quantity'];
$price = $_GET['price'];
$total = $quantity * $price;
$query = "INSERT INTO `my_cart`(`cart_id`, `b_id`, `p_id`, `quantity`,`total_price`) VALUES ('','$user','$product','$quantity','$total')";
$result=mysqli_query($con,$query);
if($result){
    header('location:./cart.php');
}
}
?>