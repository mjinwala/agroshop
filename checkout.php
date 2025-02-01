<?php
include("db.php");
session_start();

?>




<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: Arial;
      font-size: 17px;
      padding: 8px;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      display: -ms-flexbox;
      /* IE10 */
      display: flex;
      -ms-flex-wrap: wrap;
      /* IE10 */
      flex-wrap: wrap;
      margin: 0 -16px;
    }

    .col-25 {
      -ms-flex: 25%;
      /* IE10 */
      flex: 25%;
    }

    .col-50 {
      -ms-flex: 50%;
      /* IE10 */
      flex: 50%;
    }

    .col-75 {
      -ms-flex: 75%;
      /* IE10 */
      flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
      padding: 0 16px;
    }

    .container {
      background-color: #f2f2f2;
      padding: 5px 20px 15px 20px;
      border: 1px solid lightgrey;
      border-radius: 3px;
    }

    input[type=text],
    select,
    option {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    label {
      margin-bottom: 10px;
      display: block;
    }

    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    .btn {
      background-color: #04AA6D;
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }

    .btn:hover {
      background-color: #45a049;
    }

    a {
      color: #2196F3;
    }

    hr {
      border: 1px solid lightgrey;
    }

    span.price {
      float: right;
      color: grey;
    }


    input[type=submit] {
      transform: translate(20%, 0%);
      background-color: #2F3C7E;
      color: #fff;
      border: none;
      border-radius: 16px;
      font-size: 24px;
      width: 70%;
      height: 50px;
      transition: 0.2s ease-in-out;
    }

    input[type=submit]:hover {
      background: #2196F3;
      cursor: pointer;
      color: #282828;

    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
      .row {
        flex-direction: column-reverse;
      }

      .col-25 {
        margin-bottom: 20px;
      }
    }
  </style>
</head>

<body>

  <h2>Agroshop Checkout Form</h2>

  <div class="row">
    <div class="col-75">
      <div class="container">
        <form action="pay.php" method="post">
          <?php
          $result = mysqli_query($con, "SELECT * FROM `buyer` WHERE `b_id` = '" . $_SESSION['buyer_id'] . "'");
          while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['b_name'];
            $email = $row['b_email'];
            $phone = $row['b_mobile'];
            $address =  $row['address'];
            $zip = $row['zipcode'];
            $state = $row['state'];
            $city = $row['Nationality'];
          }


          ?>


          <div class="row">
            <div class="col-50">
              <h3>Billing Address</h3>
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" id="fname" name="firstname" value="<?php echo $name ?>">
              <label for="email"><i class="fa fa-envelope"></i> Email</label>
              <input type="text" id="email" name="email" value="<?php echo $email ?>" readonly>
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="address" value="<?php echo $address ?>" placeholder="Enter address">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <select name="Nationality" id="country">
                <option value="Indian">Indian</option>
                <option value="Non-indian">Non-indian</option>
              </select>
              <div class="row">
                <div class="col-50">
                  <label for="state">State</label>
                  <select name="state">
                    <option>Select state</option>
                    <?php
                    $states = array("Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttarakhand", "Uttar Pradesh", "West Bengal", "Andaman and Nicobar Islands", "Chandigarh", "Dadra and Nagar Haveli", "Daman and Diu", "Delhi", "Lakshadweep", "Puducherry");
                    $arrlength = count($states);
                    for ($i = 0; $i < $arrlength; $i++) {
                      echo '<option value="' . $states[$i] . '">' . $states[$i] . '</option>';
                    }
                    ?>


                  </select>

                  <!-- <input type="text" id="state" name="state" value="<?php echo $state ?>" placeholder="Enter your state"> -->
                </div>
                <div class="col-50">
                  <label for="zip">Zip</label>
                  <input type="text" id="zip" name="zip" value="<?php echo $zip ?>">
                </div>
              </div>
            </div>

            <div class="col-50">
              <h3>Payment</h3>
              <label for="fname">Accepted Cards</label>
              <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <i class="fa fa-cc-discover" style="color:orange;"></i>
              </div>
              <label for="cname">Phone Number</label>
              <input type="text" id="cname" name="phone" value="<?php echo $phone ?>" readonly>
              <label for="ccnum">Alternative phone number</label>
              <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">

            </div>

          </div>

          <!-- <input type="submit" value="Continue to checkout" class="btn"> -->
          <?php


          require('config.php');
          require('razorpay-php/Razorpay.php');

          use Razorpay\Api\Api;

          $ord_id = rand(1000, 2000);
          $api = new Api($keyId, $keySecret);

          $orderData = [
            'receipt'         => $ord_id,
            'amount'          => $_SESSION['total_price'] * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
          ];

          $displayCurrency = 'INR';
          $razorpayOrder = $api->order->create($orderData);

          $razorpayOrderId = $razorpayOrder['id'];

          $_SESSION['razorpay_order_id'] = $razorpayOrderId;

          $displayAmount = $amount = $orderData['amount'];


          if ($displayCurrency !== 'INR') {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);

            $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
          }

          $data = [
            "key"               => $keyId,
            "amount"            =>  $_SESSION['total_price'] * 100,
            "name"              => "AgroShop",
            "description"       => "Agroshop Payment gateway",
            "image"             => "images/logo1.png",
            "prefill"           => [
              "name"              => "$name",
              "email"             => "$email",
              "contact"           => "$phone",
            ],
            "notes"             => [

              "merchant_order_id" => "12312321",
            ],

            "theme"             => [
              "color"             => "#5272BF"
            ],
            "order_id"          => $razorpayOrderId,

          ];


          if ($displayCurrency !== 'INR') {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
          }

          $json = json_encode($data);


          ?>

          <form action="pay.php" method="POST">
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="3456" data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
            </script>
            <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
            <input type="hidden" name="shopping_order_id" value="<?php echo $ord_id ?>">
          </form>

        </form>
      </div>
    </div>
    <div class="col-25">
      <div class="container">



        <?php
        $result2 = mysqli_query($con, "SELECT * FROM `my_cart` WHERE `b_id` = '" . $_SESSION['buyer_id'] . "'");
        $items = mysqli_num_rows($result2);
        echo '
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b> ' . $items . '</b></span></h4>';
        while ($row2 = mysqli_fetch_assoc($result2)) {
          $product = $row2['p_id'];
          $price = $row2['total_price'];
          $result3 = mysqli_query($con, "SELECT * FROM `product_master` WHERE `p_id` = '" . $product . "'");
          while ($row3 = mysqli_fetch_assoc($result3)) {
            $p_name = $row3['p_name'];
            echo ' <p><a href="#">' . $p_name . '</a> <span class="price">Rs ' . $price . '</span></p>';

          }
        }
        ?>





        <hr>
        <?php
       
        $r1 = mysqli_query($con, "SELECT SUM(total_price) FROM `my_cart` WHERE `b_id` = '" . $_SESSION['buyer_id'] . "'");
        while ($ro1 = mysqli_fetch_assoc($r1)) {
          $_SESSION['total_price'] = $ro1['SUM(total_price)'];
        }
        ?>

        <p>Total <span class="price" style="color:black"><b>Rs <?php echo  $_SESSION['total_price'] ?></b></span></p>
      </div>
    </div>
  </div>

</body>

</html>