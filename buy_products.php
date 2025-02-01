<?php
include ("db.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/buy_products.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://use.fontawesome.com/b35db8cd99.js"></script>

    <title>Buy products</title>
  
</head>

<body>
    <!-- nav starts -->
    <div class="header">
        <a href="buyer.php" class="logo">
            <img src="img/agroshop-logo.png" alt="">
        </a>
        <div class="header-right">
            <a href="contact.html">Contact</a>
            <a href="about.html">About</a>
            <a href="review.html">Review</a>
            <!-- <a href="add_products.html">Add products</a> -->
        </div>
    </div>
    <!-- nav ends -->

    <!-- main starts -->
    <section id="product1" class="section-p1">

        <div class="pro-container">
            <!-- card1 -->

<?php
$query=mysqli_query($con,"SELECT * FROM `product_master` WHERE `status` = 1");
if($query){
while($row=mysqli_fetch_assoc($query)){
  $image = $row['image'];
  $name = $row['p_name'];
  $price = $row ['price'];
  $pid = $row['p_id'];
  $desc = $row['p_info'];
  $stat = $row['status'];

 
        
     
        echo '
        <div class="pro" 
                        style="font-family: "League Spartan, sans-serif;">
                        <a href="single_product.php?id='.$pid.'">
                        <img src="seller/images/'.$image.'" alt="">
                        <div class="des">
                            <span>'.$name.'</span>
                            <h5>'.$desc.'</h5>
                            <div class="star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>'.$price.'</h4>
                        </div>
                        </a>
        
                    </div>
                     
        
        ';
        
    
   

}

}
?>


            

            <!-- cards end -->
        </div>
    </section>
    <!-- main ends -->
</body>

</html>