<?php
include("db.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>       
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Card</title>
  <link rel="stylesheet" href="css/login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <button onclick="history.back()"><img src="img/back.png" alt=""></button>
  <div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>LOGIN</h2>
        <div class="underline-title"></div>
      </div>
      <form method="post" class="form">
        <label for="user-name" style="padding-top:13px">
          &nbsp;Email - ID
        </label>
        <input id="user-name" class="form-content" type="email" name="email" autocomplete="off" required />
        <div class="form-border"></div>
        
        <label for="user-password" style="padding-top:22px">&nbsp;Password</label>
        <input id="user-password" class="form-content" type="password" name="password" required />
        <div class="form-border"></div>

        <label for="confirm-password" style="padding-top:22px">&nbsp;Confirm Password</label>
        <input id="confirm-password" class="form-content" type="password" name="confirm_password" required />
        <div class="form-border"></div>

        <div class="rdo_buttons">
          <input type="radio" name="rdo_btn" id="rdo" value="buyer">
          <label for="Buyer">Buyer</label>

          <input type="radio" name="rdo_btn" id="rdo" value="seller">
          <label for="Seller">Seller</label>
        </div>

        <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
        <a href="signup.php" id="signup">Don't have an account yet?</a>
      </form>
    </div>
  </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $btn = $_POST['rdo_btn'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; // Capture confirm password

    // Validate that password and confirm password match
    if ($password !== $confirm_password) {
        echo '<script>alert("Passwords do not match. Please try again.")</script>';
    } 
    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format. Please try again.")</script>';
    } 
    else {
        // Passwords match and email is valid, proceed with login logic
        if ($btn == 'buyer') {
            $q = "SELECT * FROM `buyer` WHERE `b_email`= '$email' AND `b_password` = '$password'";
            $result = mysqli_query($con, $q);
            if ($result) {
                $result_fetch = mysqli_fetch_assoc($result);
                $_SESSION['buyer_id'] = $result_fetch['b_id'];
                $_SESSION['name'] = $result_fetch['b_name'];
                if ($result_fetch['is_active'] == 0) {
                    echo '<script>alert("User not verified")</script>';
                } else {
                    echo "<script>window.location.href='buyer.php';</script>";
                }
            }
        } elseif ($btn == 'seller') {
            $q2 = "SELECT * FROM `seller` WHERE `s_email`='$email' AND `s_password` = '$password'";
            $result2 = mysqli_query($con, $q2);
            if ($result2) {
                $result_fetch2 = mysqli_fetch_assoc($result2);
                if ($result_fetch2['is_active'] == 0) {
                    echo '<script>alert("User not verified")</script>';
                } else {
                    $_SESSION["seller_id"] = $result_fetch2['s_id'];
                    $_SESSION["seller_name"] = $result_fetch2['s_name'];
                    echo "<script>window.location.href='seller/dashboard.php';</script>";
                }
            }
        }
    }
}
?>
