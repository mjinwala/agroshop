<?php
include("db.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Core theme CSS (includes Bootstrap)-->

    <link rel="stylesheet" href="css/nav_style.css">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #inputQuantity {
            width: 65px;
        }

        .counter {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            border: none;
            background: darkgray;
            font-size: 25px;
            margin-right: 18px;
            transition: 0.2s;
        }

        .counter:hover {
            background-color: rgb(23, 2, 23);
            color: #ffff;
        }
    </style>
</head>

<body>
    <?php
    $id = $_GET['id'];
    $_SESSION['product'] = $id;
    $query = "SELECT * FROM product_master WHERE p_id= $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['p_name'];
            $price = $row['price'];
            $image = $row['image'];
            $desc = $row['p_info'];
            $cat_id = $row['cat_id'];
        }
        if ($cat_id == 1) {
            $category = "Fruits";
        } elseif ($cat_id == 2) {
            $category = "seeds";
        } elseif ($cat_id == 3) {
            $category = "tools";
        } elseif ($cat_id == 4) {
            $category = "others";
        }
    }
    ?>
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

    <!-- Product section-->
    <form method="post" action="add_to_cart.php?price=<?php echo $price ?>">
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" style="height: 350px;" src="seller/images/<?php echo $image ?>" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">Category :- <?php echo $category ?></div>
                        <h1 class="display-5 fw-bolder"><?php echo $name ?></h1>
                        <div class="fs-5 mb-5">
                            <span> Rs. <?php echo $price ?></span>
                        </div>
                        <p class="lead"><?php echo $desc ?></p>
                        <div class="d-flex">
                            <button type="button" class="counter" onclick="increment()">+</button>
                            <input class="form-control text-center me-3" id="inputQuantity" type="number" name="quantity" value="1" min="1" max="10" style="max-width: 3rem" readonly />
                            <button class="counter" type="button" onclick="decrement()">-</button>

                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query2 = "SELECT * FROM product_master WHERE cat_id = $cat_id LIMIT 5";
                $result2 = mysqli_query($con, $query2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $p_id2 = $row2['p_id'];
                    $name2 = $row2['p_name'];
                    $price2 = $row2['price'];
                    $image2 = $row2['image'];

                    echo '
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="seller/images/' . $image2 . '" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">' . $name2 . '</h5>
                                    <!-- Product price-->
                                   ' . $price2 . '
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="single_product.php?id=' . $p_id2 . '">View options</a></div>
                            </div>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
    </section>

    <!-- Footer-->
    <script src="js/scripts.js"></script>
    <script>
        function increment() {
            let inc = document.getElementById('inputQuantity');
            let numb1 = parseInt(inc.value);
            if (numb1 < 10) {  // Limit maximum value to 10
                numb1 += 1;
                inc.value = numb1;
            }
        }

        function decrement() {
            let dec = document.getElementById('inputQuantity');
            let numb2 = parseInt(dec.value);
            if (numb2 > 1) {  // Prevent decrement below 1
                numb2 -= 1;
                dec.value = numb2;
            }
        }
    </script>
</body>

</html>