<?php
include("db.php");
session_start();

$result = mysqli_query($con,"UPDATE `buyer` SET `address`='".$_POST['address']."',`Nationality`='".$_POST['Nationality']."',`state`='".$_POST['state']."',`zipcode`='".$_POST['zip']."' WHERE `b_id` = '".$_SESSION['buyer_id']."' ");

// produci _id

$result2 = mysqli_query($con, "SELECT * FROM `my_cart` WHERE `b_id` = '" . $_SESSION['buyer_id'] . "'");
$invoice = rand(1000000,9999999);
while($row = mysqli_fetch_assoc($result2)){
    $order_id = mysqli_query($con,"INSERT INTO `order_master`(`b_id`, `p_id`, `price`,`invoice`) VALUES ('".$_SESSION['buyer_id']."','".$row['p_id']."','".$row['total_price']."','$invoice')");
}


$tot_price = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(price) FROM `order_master` WHERE `b_id` = '".$_SESSION['buyer_id']."'"));
$today=date("Y-m-d");
$payment_master = mysqli_query($con,"INSERT INTO `payment_master`(`b_id`, `total_price`,`invoice`,`placed_on`) VALUES ('".$_SESSION['buyer_id']."','".$tot_price['SUM(price)']."','$invoice','$today')");

$query = "DELETE FROM `my_cart` WHERE `b_id` ='" . $_SESSION['buyer_id'] . "'";
if($result){
    echo '<script> alert("succesfully order placed")</script>';
    echo '<script> alert("Thanks from buying with us")</script>';
    echo '<script>window.location.href="buyer.php"</script>';
}

?>
