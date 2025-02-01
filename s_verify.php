<?php
require ('db.php');
if(isset($_GET['email']))
{
$query = "SELECT * FROM `seller` WHERE `s_email` = '$_GET[email]'";
$result = mysqli_query($con,$query);
    if($result)
    {
        if(mysqli_num_rows($result) == 1)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['is_active'] == 0)
            {
                $update = "UPDATE `seller` SET `is_active`='1' WHERE `s_email` = '$result_fetch[s_email]'";
                if(mysqli_query($con,$update))
                {
                    echo"
                    <script>
                     alert('User verification sucessfull');
                     window.location.href='login.php';
                    </script>";  
                }
            }
            else
            {
            echo"
            <script>
             alert('User already verified');
             window.location.href='index.php';
            </script>
            "; 
            }
        }
        
    }
    else
    {
        echo"
        <script>
         alert('Server Error');
         window.location.href='index.php';
        </script>
        ";
    }
}
?>