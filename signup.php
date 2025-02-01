<?php 
include("db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sign up</title>
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <button onclick="history.back()"><img src="img/back.png" alt=""></button>
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>Sign up</h2>
                <div class="underline-title"></div>
            </div>
            <form method="POST" class="form">

                <label for="user-name" style="padding-top:13px">
                    &nbsp;Name
                </label>
                <input id="user-name" class="form-content" type="text" name="name" autocomplete="on" required />
                <div class="form-border"></div>

                <label for="user-phone" style="padding-top:13px">
                    &nbsp;Phone number
                </label>
                <input id="user-phone" class="form-content" type="text" name="phone" autocomplete="on" required />
                <div class="form-border"></div>


                <label for="user-email" style="padding-top:13px">
                    &nbsp;Email
                </label>
                <input id="user-email" class="form-content" type="email" name="email" autocomplete="on" required />



                <div class="form-border"></div>
                <label for="user-password" style="padding-top:22px">&nbsp;Password
                </label>
                <input id="user-password" class="form-content" type="password" name="password" required />
                

                <div class="form-border"></div>
                <div class="rdo_buttons" style="margin-top: 10px;">

                    <input type="radio" name="rdo_btn" id="rdo" value="buyer">
                    <label for="Buyer">Buyer</label>
          
                      <input type="radio" name="rdo_btn" id="rdo"value="seller">
                      <label for="Buyer">Seller</label>
          
                  </div>
          
                <input id="submit-btn" type="submit" name="submit" value="Sign-up" />
                <a href="index.php" id="signup">Already have an account?</a>
            </form>
        </div>
    </div>
</body>

</html>
<?php
// seller mail function
  function seller_mail($email)
  {
    require ("PHPMAiler/src/PHPMailer.php");
    require ("PHPMAiler/src/SMTP.php");
    require ("PHPMAiler/src/Exception.php");

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
  
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'drive2122123@gmail.com';                     //SMTP username
        $mail->Password   = 'casitaiedifbybpd';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('drive2122123@gmail.com', 'Agroshop mail conformation link');
        $mail->addAddress($email);     //Add a recipient
      
        
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'E-mail Verification form Agroshop for seller';
        $mail->Body    = "Click here to <a href='http://localhost/agroshop/s_verify.php?email=$email'>Verify</a> Your email address";
    
        $mail->send();
        return TRUE;
    } catch (Exception $e) {
       return FALSE;
    }
  }

//   buyer mail function

  function buyer_mail($email)
  {
    require ("PHPMAiler/src/PHPMailer.php");
    require ("PHPMAiler/src/SMTP.php");
    require ("PHPMAiler/src/Exception.php");

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
  
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'drive2122123@gmail.com';                     //SMTP username
        $mail->Password   = 'casitaiedifbybpd';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('drive2122123@gmail.com', 'Agroshop mail conformation link');
        $mail->addAddress($email);     //Add a recipient
      
        
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'E-mail Verification form Agroshop for buyer';
        $mail->Body    = "Click here to <a href='http://localhost/agroshop/b_verify.php?email=$email'>Verify</a> Your email address";
    
        $mail->send();
        return TRUE;
    } catch (Exception $e) {
       return FALSE;
    }
  }



if (isset($_POST['submit'])){

    $btn = $_POST['rdo_btn'];
   
    $name = $_POST['name'];     
    $number=$_POST['phone'];
    $email =$_POST['email'];
    $password=$_POST['password'];

    if($btn == 'buyer'){

$query =mysqli_query($con,"SELECT * FROM `buyer` WHERE `b_email` = '".$email."' ");
$res2 =  mysqli_num_rows($query);

        if($res2!=0){
            echo '<script>alert("User already eists please enter another email id")</script>';
        }
        else{
    
            $q="INSERT INTO buyer(`b_id`, `b_name`, `b_password`, `b_email`, `b_mobile`, `is_active`) VALUES ('','$name','$password','$email','$number','0')";
    
            if($con->query($q)){
                echo '<script>alert("Please check your email for verfication")</script>';
                buyer_mail($email);
                echo '<script>window.location.href="index.php"</script>';
            }
            else{
                echo '<script>alert("sign up not sucess")</script>';
            }
        }
    }
    elseif($btn == 'seller'){
       
$query2 =mysqli_query($con,"SELECT * FROM `seller` WHERE `s_email` = '".$email."' ");
$res3 =  mysqli_num_rows($query2);

       if($res3 !=0 ){
        echo '<script>alert("User already eists please enter another email id")</script>';
       }
       else{
        
        $q2="INSERT INTO `seller`(`s_id`, `s_name`, `s_password`, `s_email`, `s_mobile`, `is_active`) VALUES ('','$name','$password','$email','$number','0')";
  
        if($con->query($q2)){
            echo '<script>alert("Please check your email for verification link")</script>';
            seller_mail($email);
           echo '<script>window.location.href="index.php"</script>';
        }
        else{
            echo '<script>alert("sing up not sucess")</script>';
        }
       }
    
    }
    else{
        echo '<script>alert("Please select an option")</script>';
    }
   
}
?>