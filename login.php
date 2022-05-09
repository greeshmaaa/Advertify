<?php
include "header.php";
include "dbconnect.php";
if(isset($_POST['login'])){
	
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql="SELECT * FROM advertiser WHERE emailid='$email' AND password='$password'";
	$result=mysqli_query($con,$sql);
if ($row=mysqli_fetch_assoc($result))
	{
		$id=$row['advertiserid'];
		
		$a=$row['emailid'];
		$b=$row['password'];
		if(($email==$a)&&($password==$b))
		{
			//echo $id;
			session_start();
			
			$_SESSION['advertiserid']=$id;
			echo '<script type="text/javascript">'; 
				echo 'alert("Adverister successfully loggedin!!");'; 
				echo 'window.location.href = "home.php";';
				echo '</script>';
		}
		else {
				echo '<script type="text/javascript">'; 
				echo 'alert("Invalid Email ID or Password!!");'; 
				echo 'window.location.href = "login.php";';
				echo '</script>';
			}
				
	
	}
	else {
		echo '<script type="text/javascript">'; 
		echo 'alert("Invalid Email ID or Password!!");'; 
		echo 'window.location.href = "login.php";';
		echo '</script>';
		}
}

?>
<style>
.classvalidate{
	color:Tomato;
}
</style>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcrumb Area Start ##### -->
    <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/40.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <div class="mag-login-area py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="login-content bg-white p-30 box-shadow">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h5>Great to have you back!</h5>
                        </div>

                        <form action="" method="post" onsubmit="return validateform()">
                            <div class="form-group">
							<span class="classvalidate" id="idemail"></span>
                                <input type="email" class="form-control" id="email" placeholder="Email ID" name="email">
                            </div>
                            <div class="form-group">
							<span class="classvalidate" id="idpassword"></span>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                            </div>
                          
                            <button type="submit" class="btn mag-btn mt-30" name="login">Login</button>
							
                        </form>
						<br>
						<center><a href="forget-password.php">Forgot Password</a></center>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Login Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php
	include "footer.php";
	?>
<script>
function validateform(){
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaspaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	var validateform="true";
	$( ".classvalidate" ).empty();
	if(!document.getElementById("email").value.match(emailExp))
	{
		document.getElementById("idemail").innerHTML="Entered Email ID is not in a valid format....";
		validateform="false";
	}
	if(document.getElementById("email").value=="")
	{
		document.getElementById("idemail").innerHTML="Email Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("password").value.length <6)
	{
		document.getElementById("idpassword").innerHTML="Should contain more than 6 characters...";
		validateform="false";
	}
	if(document.getElementById("password").value=="")
	{
		document.getElementById("idpassword").innerHTML="New password Should not be empty...";
		validateform="false";
	}
	if(validateform=="true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>