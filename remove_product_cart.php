<?php
include("db.php");
session_start();

$id = $_GET['id'];

$query = "DELETE FROM `my_cart` WHERE `cart_id` =".$id."";
$result=mysqli_query($con,$query);
if($result){
    header('location:./cart.php');
}

?>