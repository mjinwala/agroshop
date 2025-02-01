<?php
include("db.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

        </div>
    </div>
    <!-- nav ends -->
    <!-- main starts -->
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <!-- Set columns width -->
                                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details
                                </th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Quantity</th>

                                <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>



                            <!-- products -->
                            <?php
                            $query = "SELECT COUNT(`p_id`),`p_id`,`cart_id`,quantity FROM `my_cart` WHERE `b_id` = '".$_SESSION['buyer_id']."' GROUP by `p_id`";
                            $result = mysqli_query($con, $query);
                         while($row = mysqli_fetch_assoc($result)){
                            // if($row['COUNT(`p_id`)'] > 1){
                              $sql = mysqli_query($con,"SELECT SUM(`quantity`),SUM(`total_price`) FROM `my_cart` WHERE `p_id` = '".$row['p_id']."'");

                                while($row2 = mysqli_fetch_assoc($sql)){
                                    $sql3 =  mysqli_query($con,"SELECT * FROM `product_master` WHERE `p_id` = '".$row['p_id']."'");
                                    $row3 = mysqli_fetch_assoc($sql3);
                                    $product_total_price = $row2['SUM(`total_price`)'];
                                    $product_name = $row3['p_name'];
                                    $product_price = $row3['price'];
                                    $product_image = $row3['image'];
                                    $product_quantity = $row2['SUM(`quantity`)'];
                                    $cat_id = $row3['cat_id'];

                                    if ($cat_id == 1) {
                                        $category = "Fruits";           
                                    } elseif ($cat_id == 2) {
                                        $category = "seeds";
                                    } elseif ($cat_id == 3) {
                                        $category = "tools";
                                    } elseif ($cat_id == 4) {
                                        $category = "others";
                                    }
                                   
                                



                                echo '
<tr>
<td class="p-4">
    <div class="media align-items-center">
        <img src="seller/images/' . $product_image . '"
            class="d-block ui-w-40 ui-bordered mr-4" alt="">
        <div class="media-body">
            <a href="#" class="d-block text-dark">' . $product_name . '</a>
            <small>
                <span class="text-muted">Category: </span> ' . $category . '
            </small>
        </div>
    </div>
</td>
<td class="text-right font-weight-semibold align-middle p-4">' . $product_price . '</td>
<td class="text-right font-weight-semibold align-middle p-4">' . $product_quantity . '</td>
<td class="text-right font-weight-semibold align-middle p-4">' . $product_total_price . '</td>
<td class="text-center align-middle px-0"><a href="remove_product_cart.php?id=' . $row['cart_id'] . '"
        class="shop-tooltip close float-none text-danger" title=""
        data-original-title="Remove">×</a></td>
</tr>
';
                                }
                                   
                                
                            }                            
                            ?>

                            <!-- product -->
                        </tbody>
                    </table>
                </div>
                <!-- / Shopping cart table -->

                <div class="text-right mt-4">
                    <label class="text-muted font-weight-normal m-0">Total price</label>

<?php 
$r1 = mysqli_query($con,"SELECT SUM(total_price) FROM `my_cart` WHERE `b_id` = '".$_SESSION['buyer_id']."'");
$ro1 = mysqli_fetch_assoc($r1);
    $total_price = $ro1['SUM(total_price)'];
    $_SESSION['total_price'] = $ro1['SUM(total_price)'];
?>


                    <div class="text-large"><strong>Rs <?php echo $total_price ?></strong></div>
                </div>
            </div>
        </div>

        <div class="float-right">
            <a href="buy_products.php"><button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Back to shopping</button></a>
            <a href="checkout.php"> <button type="button" class="btn btn-lg btn-primary mt-2">Checkout</button></a>
        </div>

    </div>
    </div>
    </div>
    <!-- main ends -->


    <!-- boot strap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>