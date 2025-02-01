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
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/editprofile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="js/edit.js"></script>
    
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
    <!-- main content starts -->
<?php 
$details = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `buyer` WHERE b_id = '".$_SESSION['buyer_id']."'"));
?>
    <div class="row gutters-sm" style="display: flex;justify-content: center;">
                <div class="col-md-6 mb-2" style="height:300px;">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="img/user.jpg" alt="user"
                                    class="rounded-circle" style=" height: 150px;
    width: 150px;
    border-radius: 50%;">
                                <div class="mt-3">
                                    <h4><?php echo $details['b_name']?></h4>
                                    <p class="text-secondary mb-1"><?php echo $details['b_email']?></p>
                                    <p class="text-muted font-size-sm"><?php echo $details['b_mobile']?></p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
                <div class="row gutters-sm" style="display: flex;justify-content: center;">
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex justify-content-center align-items-center mb-3"  style="text-align: center;"><i class="material-icons mr-2">Previous orders</i></h6>
                                   
                                    <!-- table -->
                                    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">invoice</th>
      <th scope="col">Product name</th>
      <th scope="col">Quantity</th>
      <th scope="col">total price</th>
      <th scope="col">Placed on</th>
      <th scope="col">Bill</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $count2 = 1;
    $sql2 = "SELECT * FROM `payment_master` WHERE `b_id` = '".$_SESSION['buyer_id']."'";
    $result2 = mysqli_query($con,$sql2);
    while($row2 = mysqli_fetch_assoc($result2)){

        $order_master = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `order_master` WHERE `invoice` = '".$row2['invoice']."'"));

        $product = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `product_master` WHERE `p_id` = '".$order_master['p_id']."'"));

        $quan = $order_master['price'] / $product['price'];
echo '
<tr>
<th scope="row">'.$count2.'</th>
<td>'.$row2['invoice'].'</td>
<td>'.$product['p_name'].'</td>
<td>'.$quan.'</td>
<td>'.$row2['total_price'].'</td>
<td>'.$row2['placed_on'].'</td>
<td><a href="pdf.php?user_id='.$_SESSION['buyer_id'].'&invoice='.$row2['invoice'].'"><button type="button" class="btn btn-primary">Download</button></a></td>
</tr>
';

$count2 +=1;
    }
    ?>

  </tbody>
</table>
                                    <!-- table ends -->
                                </div>
                            </div>
                        </div>
                    </div>


            </div>

        </div>
    </div>
    <!-- main content ends -->
</body>

</html>