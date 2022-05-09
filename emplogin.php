	<?php
	
include "dbconnect.php";
if(isset($_POST['emplogin'])){
	
	$loginid=$_POST['loginid'];
	$password=$_POST['password'];
	$sql="SELECT * FROM employee WHERE loginid='$loginid' AND password='$password'";
	$result=mysqli_query($con,$sql);
if ($row=mysqli_fetch_assoc($result))
	{
		$id=$row['employeeid'];
		
		$a=$row['loginid'];
		$b=$row['password'];
		if(($loginid==$a)&&($password==$b))
		{
			//echo $id;
			session_start();
			
			$_SESSION['employeeid']=$id;
			echo '<script type="text/javascript">'; 
				echo 'alert("Employee successfully loggedin!!");'; 
				echo 'window.location.href = "employee/home.php";';
				echo '</script>';
		}
		else {
				echo '<script type="text/javascript">'; 
				echo 'alert("Invalid Email ID or Password!!");'; 
				echo 'window.location.href = "index.php";';
				echo '</script>';
			}
				
	
	}
	else {
		echo '<script type="text/javascript">'; 
		echo 'alert("Invalid Email ID or Password!!");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
		}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>ADVERTIFY</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
      <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/40.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Employee Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<div class="mag-login-area py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="login-content bg-white p-30 box-shadow">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h5>Great to have you back!</h5>
                        </div>

                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Login ID" name="loginid">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                            </div>
                            
                            <button type="submit" class="btn mag-btn mt-30" name="emplogin">Login</button>
                        </form>
						<br>
						<center><a href="forget-password.php">Forget Password</a></center>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
	
<script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>