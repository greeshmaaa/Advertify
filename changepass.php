<?php
include "header.php";
include "dbconnect.php";	
if(isset($_POST['update_password']))
{
		$sql="UPDATE `advertiser` SET `password`='$_POST[newpass]' WHERE password='$_POST[oldpass]' AND `advertiserid`='$_SESSION[advertiserid]'";
	
	if(!mysqli_query($con,$sql))
	{
		echo "Error in update statement". mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated successfully..'); </script>";
		echo "<script>window.location.assign('home.php');</script>";
		
	}
	else
	{
		echo "<script>alert('Entered details not valid..'); </script>";
		echo "<script>window.location.assign('changepass.php');</script>";
	}



}
?>
<style>
.classvalidate{
	color:red;
}
</style>
<section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/49.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>change Password </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <div class="mag-breadcrumb py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
	<div class="video-submit-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <!-- Video Submit Content -->
                    <div class="video-submit-content mb-50 p-30 bg-white box-shadow">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h5>Change Password</h5>
                        </div>

                        <div class="video-info mt-30">
                         
						
                            
                     	  <form action="" method="post" role="form" onsubmit="return validateform()">
            <div class="form-group">
			<span class="classvalidate" id="idoldpass"></span>
			
              <input type="password" name="oldpass" class="form-control" id="oldpass" placeholder="Enter Old Password"/>
			   
              <div class="validation"></div>
            </div>
			
			 <div class="form-group">
			<span class="classvalidate" id="idnewpass"></span>
              <input type="password" name="newpass" class="form-control" id="newpass" placeholder="Enter New Password"  />
			    
              <div class="validation"></div>
            </div>
			 <div class="form-group">
			<span class="classvalidate" id="idconfpassword"></span>
              <input type="password" name="confpassword" class="form-control" id="confpassword" placeholder="Enter Confirm Password"  />
			   
              <div class="validation"></div>
            </div>
			
			<input type="submit"  name="update_password" class="btn mag-btn mt-30" value="Reset">
          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>
<script>
function validateform()
{
  var numericExpression = /^[0-9]+$/;
  var alphaExp = /^[a-zA-Z]+$/;
  var alphaspaceExp = /^[a-zA-Z\s]+$/;
  var alphaNumericExp = /^[0-9a-zA-Z]+$/;
  var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
  
  var validateform="true";
  $( ".classvalidate" ).empty();
  
  if(document.getElementById("newpass").value != document.getElementById("confpassword").value)
	{	
		document.getElementById("idnewpass").innerHTML="New Password and Confirm password not matching...";
		validateform="false";
	}
  if(document.getElementById("oldpass").value=="")
  {
    document.getElementById("idoldpass").innerHTML=" Old Password Should not be empty...";
    validateform="false";
  }
  
    
  
  if(document.getElementById("oldpass").value.length <6)
	{
		document.getElementById("idoldpass").innerHTML="Should contain more than 6 characters...";
		validateform="false";
	} 
	if(document.getElementById("newpass").value.length <6)
	{
		document.getElementById("idnewpass").innerHTML="Should contain more than 6 characters...";
		validateform="false";
	}
	if(document.getElementById("confpassword").value.length <6)
	{
		document.getElementById("idconfpassword").innerHTML="Should contain more than 6 characters...";
		validateform="false";
	}
  if(document.getElementById("newpass").value=="")
  {
    document.getElementById("idnewpass").innerHTML="New Password Should not be empty...";
    validateform="false";
  }
if(document.getElementById("confpassword").value=="")
  {
    document.getElementById("idconfpassword").innerHTML="Confirm Password Should not be empty...";
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