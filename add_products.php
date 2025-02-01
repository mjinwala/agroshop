<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/add_product.css">
    <title>Document</title>
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
            <a href="add_products.html">Add products</a>
        </div>
    </div>
    <!-- nav ends -->
    <!-- main content starts -->
        <div class="formbold-form-wrapper">
            <form action=""  enctype="multipart/form-data"  method="POST">

                <div class="formbold-input-flex">
                    <div>
                        <label for="firstname" class="formbold-form-label">
                            Product name
                        </label>
                        <input type="text" name="p_name" id="firstname" class="formbold-form-input" />
                    </div>
                    

                    <div>
                        <label for="lastname" class="formbold-form-label">Category </label>
                        <select name="category" id="cat_id">
                            <option value="cat1">1</option>
                            <option value="cat2">2</option>
                            <option value="cat3">3</option>
                        </select>
                    </div>
                </div>

                

                <div class="formbold-mb-3">
                    <label for="address" class="formbold-form-label">
                        Product description
                    </label>
                    <input type="text" name="description" class="formbold-form-input" />
                </div>

                <div class="formbold-mb-3">
                    <label for="address2" class="formbold-form-label">
                       Price of product
                    </label>
                    <input type="text" name="Price" class="formbold-form-input" />
                </div>
                    
                        <label for="area" class="formbold-form-label">Product image </label>
                        <input type="file" name="file" />
                
               
                     <input type="submit" name="submit" value="add product"/>
            </form>
        </div>
    </div>

    <!-- main content ends -->
</body>

</html>

<?php
$con = mysqli_connect("localhost","root","","agroshop");





if(isset($_POST['submit']))
{ 

    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $name = "pro". rand(1,30);
    $filename = $name.".".$extension;
    $filepath = "images/". $filename;
    move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);

$query = "INSERT INTO `product_master`(`p_id`, `cat_id`, `p_name`, `p_info`, `price`, `image`, `status`) VALUES ('','1','".$_POST['p_name']."','".$_POST['description']."','".$_POST['Price']."','$filename','1')";
$result = mysqli_query($con,$query);
if($result){
    echo '<script>alert("success")</script>';
}
else{

    echo '<script>alert("unsuccess")</script>';
}
}

?>