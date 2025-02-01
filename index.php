<?php
session_start();
$_SESSION['buyer_id'] = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Document</title>
    <style>
        .cards1{
            display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
        }
        .cards-list {
  z-index: 0;
  display: flex;
  width: 100%;
  justify-content: space-around;
  flex-wrap: wrap;
}
.card {
  margin: 30px auto;
  width:27%;
  height: 500px !important;
  border-radius: 40px;
box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
  cursor: pointer;
  transition: 0.4s;
}

    </style>
</head>

<body>
    <!-- nav starts -->
    <div class="header">
        <a href="index.php" class="logo">
            <img src="img/agroshop-logo.png" alt="">
        </a>
        <div class="header-right">
            <a href="contact.php">Contact</a>
            <a href="about.html">About</a>
            <a href="review.php">Review</a>
            <!-- <a href="add_products.html">Add products</a> -->
        </div>
    </div>
    <!-- nav ends -->
    <h2>Welcome to agro shop</h2>


    <!-- Login/signup starts -->
    <div class="buttons" style="display: flex;justify-content: center;">
       <a href="login.php"><button class="button button1" style="margin-left: 20px;">login</button></a>
       <a href="signup.php"><button class="button button1" style="margin-left: 20px;">sign-up</button></a>
    </div>
    <!-- Login/signup ends -->


    <!-- cards start -->
<div class="cards1">

        
    <div class="cards-list">
        <div class="card">
            <a href="https://www.nabard.org/content1.aspx?id=23&catid=23" style="text-decoration: none ;height: inherit;">
            <div class="card_image"> <img src="img/gov_schemes.jpg" /> </div>
            <div class="card_title title-white">
                <p>Government schemes</p>
            </div>
            </a>
        </div>


        <div class="card">
            <a href="buy_products.php" style="text-decoration: none ;height: inherit;">
            <div class="card_image"> <img src="img/products.jpg" /> </div>
            <div class="card_title title-white">
                <p>Buy product</p>
            </div>
        </a>
        </div>
<!--        
    </div>
<div class="cards-list"> -->

    
    <div class="card">
        <a href="edit_profile.html" style="text-decoration: none ;height: inherit;">
            <div class="card_image"> <img src="img/profile.jpg" /> </div>
            <div class="card_title title-white">
                <p>Edit profile</p>
            </div>
        </a>
    </div>

<!-- 
    <div class="card ">
        <a href="" style="text-decoration: none ;height: inherit;">
            <div class="card_image"> <img src="img/rent.jpg" /> </div>
            <div class="card_title title-white">
                <p>Rent products</p>
            </div>
        </a>
    </div> -->
</div>

</div>
    <!-- cards end -->
</body>

</html>
