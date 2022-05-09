<?php
include("header.php");
if(isset($_POST['submit']))
{
	$npwd = $_POST['newpassword'];
	$sql = "UPDATE advertiser SET password='$npwd' WHERE advertiserid='$_SESSION[custnewpasswordid]' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<SCRIPT>alert('Password updated successfully...');</SCRIPT>";
		echo "<SCRIPT>window.location='index.php';</SCRIPT>";
	}
	else
	{
		echo "<SCRIPT>alert('Old password and Reset password is same...');</SCRIPT>";		
	}
}
?>
<style>
.classvalidate
{
color:red;
}
</style>
<div class="mag-login-area py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="login-content bg-white p-30 box-shadow">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h5>Reset Password</h5>
                        </div>

                        <form action="" method="post" onsubmit="return validateform()">
                            <div class="form-group">
							
                                <input type="password" class="form-control"  placeholder="New Password" name="newpassword" id="newpassword">
								<span class="classvalidate" id="idnewpassword"></span>
                            </div>
                            <div class="form-group">
							
                                <input type="password" class="form-control"  placeholder="Re-Enter Password" name="confirmpassword" id="confirmpassword">
								<span class="classvalidate" id="idconfirmpassword"></span>
                            </div>
                            <button type="submit" name="submit" class="btn mag-btn mt-30">Update Password</button>
							
                        </form>
						
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
	
	if(document.getElementById("newpassword").value=="")
	{
		document.getElementById("idnewpassword").innerHTML="New Password Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("newpassword").value.length <6)
	{
		document.getElementById("idnewpassword").innerHTML="Should contain more than 6 characters...";
		validateform="false";
	}
	if(document.getElementById("confirmpassword").value.length <6)
	{
		document.getElementById("idconfirmpassword").innerHTML="Should contain more than 6 characters...";
		validateform="false";
	}
	if(document.getElementById("confirmpassword").value=="")
	{
		document.getElementById("idconfirmpassword").innerHTML="confirm password Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("newpassword").value != document.getElementById("confirmpassword").value)
	{	
		document.getElementById("idnewpassword").innerHTML="Password and Confirm password not matching...";
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