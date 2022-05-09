<?php
include "header.php";
include "dbconnect.php";
if(isset($_POST['register'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$pincode=$_POST['pincode'];
	$contactno=$_POST['contactno'];
	$status=$_POST['status'];
	$sqlq="INSERT INTO `advertiser`(`advertisername`, `emailid`, `password`, `address`, `City`, `pincode`, `contactno`, `Note`, `status`) VALUES ('$name','$email','$password','$address','$city','$pincode','$contactno','','$status')";
	if(mysqli_query($con,$sqlq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Registered Successfully!!");'; 
                    echo 'window.location.href = "login.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "register.php";';
            echo '</script>';
	}
}
?>
    <!-- ##### Header Area End ##### -->
<style>
.classvalidate{
	color:Tomato;
}
textarea.form-control {
    height: 134px !important;
}
</style>
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
                            <h5>Welcome To Our Portal!</h5>
                        </div>

                        <form action="" method="post" onsubmit="return validateform()">
						<div class="form-group">
						<span class="classvalidate" id="idname"></span>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" >
                            </div>
                            <div class="form-group">
							<span class="classvalidate" id="idemail"></span>
                                <input type="text" class="form-control" id="email" placeholder="Email" name="email">
								
                            </div>
                            <div class="form-group">
							<span class="classvalidate" id="idpassword"></span>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" >
                            </div>
							<div class="form-group">
							<span class="classvalidate" id="idaddress"></span>
  <textarea class="form-control" rows="1" id="address" name="address" placeholder="Address"></textarea>
                            </div>
							<div class="form-group">
							<span class="classvalidate" id="idcity"></span>
                                 <select class="form-control" id="city" name="city">
								 <option value="">Select City</option>
									<option value="Mangalore">Mangalore</option>
									<option value="Bangalore">Bangalore</option>
									
											</select>
                            </div>
							<div class="form-group">
							<span class="classvalidate" id="idpincode"></span>
                                 <input type="number" class="form-control" id="pincode" placeholder="Enter pincode" name="pincode">
                            </div>
							
							<div class="form-group">
							<span class="classvalidate" id="idcontactno"></span>
                                 <input type="number" class="form-control" id="contactno" placeholder="Enter Contact No" name="contactno">
                            </div>
							<div class="form-group">
							<span class="classvalidate" id="idstatus"></span>
                                <select class="form-control" id="status" name="status">
								<option value="">Select Status</option>
									<option value="Active">Active</option>
									<option value="Inactive">Inactive</option>
									
											</select>
                            </div>
                            
                            
                            <button type="submit" class="btn mag-btn mt-30" name="register">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Login Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-widget">
                        <!-- Logo -->
                        <a href="index.html" class="foo-logo"><img src="img/core-img/logo2.png" alt=""></a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <div class="footer-social-info">
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-widget">
                        <h6 class="widget-title">Categories</h6>
                        <nav class="footer-widget-nav">
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Life Style</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tech</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Travel</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Music</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Foods</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Fashion</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Game</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Football</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sports</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> TV Show</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-widget">
                        <h6 class="widget-title">Sport Videos</h6>
                        <!-- Single Blog Post -->
                        <div class="single-blog-post style-2 d-flex">
                            <div class="post-thumbnail">
                                <img src="img/bg-img/12.jpg" alt="">
                            </div>
                            <div class="post-content">
                                <a href="single-post.html" class="post-title">Take A Romantic Break In A Boutique Hotel</a>
                                <div class="post-meta d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Blog Post -->
                        <div class="single-blog-post style-2 d-flex">
                            <div class="post-thumbnail">
                                <img src="img/bg-img/13.jpg" alt="">
                            </div>
                            <div class="post-content">
                                <a href="single-post.html" class="post-title">Travel Prudently Luggage And Carry On</a>
                                <div class="post-meta d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-widget">
                        <h6 class="widget-title">Channels</h6>
                        <ul class="footer-tags">
                            <li><a href="#">Travel</a></li>
                            <li><a href="#">Fashionista</a></li>
                            <li><a href="#">Music</a></li>
                            <li><a href="#">DESIGN</a></li>
                            <li><a href="#">NEWS</a></li>
                            <li><a href="#">TRENDING</a></li>
                            <li><a href="#">VIDEO</a></li>
                            <li><a href="#">Game</a></li>
                            <li><a href="#">Sports</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Foods</a></li>
                            <li><a href="#">TV Show</a></li>
                            <li><a href="#">Twitter Video</a></li>
                            <li><a href="#">Playing</a></li>
                            <li><a href="#">clips</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <!-- Copywrite Text -->
                    <div class="col-12 col-sm-6">
                        <p class="copywrite-text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                    <div class="col-12 col-sm-6">
                        <nav class="footer-nav">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Advertisement</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
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

<script>
function validateform(){
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaspaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	var validateform="true";
	$( ".classvalidate" ).empty();
	
	
	if(!document.getElementById("name").value.match(alphaspaceExp))
	{
		document.getElementById("idname").innerHTML="Name should contain alphabets and characters...";
		validateform2="false";
	}
	if(document.getElementById("name").value=="")
	{
		document.getElementById("idname").innerHTML="Name Should not be empty...";
		validateform="false";
	}
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
	
	if(document.getElementById("city").value=="")
	{	
		document.getElementById("idcity").innerHTML="City Should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("address").value=="")
	{	
		document.getElementById("idaddress").innerHTML="Address should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("pincode").value.length != 6)
	{
		document.getElementById("idpincode").innerHTML="Pincode should contain 10 digits...";
		validateform="false";
	}
	if(document.getElementById("pincode").value.length > 6)
	{
		document.getElementById("idpincode").innerHTML="Pincode shouldnot contain more than 6 digits...";
		validateform="false";
	}
	if(document.getElementById("pincode").value=="")
	{	
		document.getElementById("idpincode").innerHTML="Pincode should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("contactno").value.match(alphaspaceExp))
	{
		document.getElementById("idcontactno").innerHTML="Contact number  should not  contain alphabets....";
		validateform="false";
	}	
	if(document.getElementById("contactno").value.length != 10)
	{
		document.getElementById("idcontactno").innerHTML="Contact number should contain 10 digits...";
		validateform="false";
	}
	if(document.getElementById("contactno").value.length > 10)
	{
		document.getElementById("idcontactno").innerHTML="Contact number shouldnot contain more than 10 digits...";
		validateform="false";
	}
	if(document.getElementById("contactno").value=="")
	{	
		document.getElementById("idcontactno").innerHTML="Contact No should not be empty...";
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
	
	if(document.getElementById("status").value=="")
	{
		document.getElementById("idstatus").innerHTML="Must Select status...";
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