<?php
include("db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/responsive.css">
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
    <section id="contact">
       <form action="" method=post>
       <div class="contact-box">
          <div class="contact-links">
            <h2>CONTACT US</h2>
            
          </div>
          <div class="contact-form-wrapper">
        
              <div class="form-item">
                <input type="text" name="u_name" required>
                <label>Name:</label>
              </div>
              <div class="form-item">
                <input type="text" name="email" required>
                <label>Email:</label>
              </div>
              <div class="form-item">
                <input type="text" name="phone" required>
                <label>Phone number:</label>
              </div>
              <div class="form-item">
                <textarea class="" name="message" required></textarea>
                <label>Message:</label>
              </div>
              <button class="submit-btn" name="submit">Send</button>  
            </form>
          </div>
        </div>
      </section>
    <!-- main ends -->
<?php
if(isset($_POST['submit'])){

  $name = $_POST['u_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

$query= "INSERT INTO `contact_master`(`contact_id`, `name`, `phone`, `descripition`, `email`) VALUES ('','$name','$phone','$message','$email')";
$result =mysqli_query($con,$query);
if($result){
  echo '<script>alert("success")</script>';
}else {
echo  '<script>alert("unsuccess")</script>';
}
}


?>






</body>
</html>