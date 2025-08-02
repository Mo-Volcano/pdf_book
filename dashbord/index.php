<?php
session_start(); 
include "include\db.php";
// check if seesion isset
if(isset($_SESSION["adminInfo"])){
    header("Location:admin.php");
}else{


   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volcano</title>
    <link rel="stylesheet" href="./../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-pr-asmr.css">
</head>

<body>

   
<div class="login-card-container">

        <div class="login-card">


            <div class="loga">
                <img src="images\fdfbd293900d3d6e7e449d362f7b3be0.jpg" alt="">
            </div>
            <div class="header">
                <h1>sing in</h1>
                <div>please login to platform</div>


            </div>
            <!-- log to dashboard -->
            <?php
            if(isset($_POST['log'])){
                $adminInfo = $_POST['adminInfo'];
                $adminPass = $_POST['password'];
                // check input is not empity
                if(empty($adminInfo) || empty($adminPass)){
                    echo "<div class='alert alert-danger'> الرجاء ملء الحقول ادناه</div>";
                }
                // check if value  are mathc
                else{
                    $query = " SELECT * FROM admin WHERE (adminName='$adminInfo' OR adminEmail='$adminInfo') AND adminPass='$adminPass'";
                    $result = mysqli_query($con , $query);
                    $row = mysqli_num_rows($result);

                    if($row > 0 ){
                      $_SESSION["adminInfo"] = $adminInfo;
                      header("location:admin.php");
                    }else{
                        echo "<div class='alert alert-danger'>البيانات غير متطابقة الرجاء المحاولة مرة اخرى</div>";

                    }
                }

            }
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" class="login-form">
                <div class="form-items"> <div class="mn"> 
                </div>                    
                        <input type="text" placeholder="Enter Email Or User Name"  autofocus name="adminInfo">
                </div>
                <div class="form-items">
                   
                   <div class="mn"> </div>

                    <input type="password" placeholder="Enter password"  name="password">
                
                </div>
                <div class="form-item-other">
                    <div class="checkbox">

                        <input type="checkbox" id="remember-me">
                        <label for="remember-me">remember me</label>
                    </div>
                    <a href="">I Forget my password</a>
                    
                </div>
                <button type="submit" name="log">sign in</button>
            </form>
            <div class="login-card-footer">Dont Hava Any Acount <a href="">Graute a free acount</a></div>
        </div>

        <!-- <div class="login-card-social">
            <div>Other sign platform</div>
            <div class="login-card-social-btn"><a href=""></a></div>
        </div> -->


    </div>
  
    <?php
}
?>














</body>

</html>
