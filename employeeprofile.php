
<?php
include "header.php";
?>


<?php
include "dbconnect.php";
if(isset($_POST['update'])){
	$name=$_POST['name'];
	$loginid=$_POST['loginid'];
	$password=$_POST['password'];
	
	$status=$_POST['status'];
	
	$sqq="UPDATE `employee` SET `empname`='$name',`loginid`='$loginid',`password`='$password',`status`='$status' WHERE `employeeid`='$_SESSION[employeeid]'";
	if(mysqli_query($con,$sqq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Employee Profile Updated Successfully!!");'; 
                    echo 'window.location.href = "home.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "employeeprofile.php";';
            echo '</script>';
	}
}
?>
<style>
.classvalidate{
	color:Tomato;
}
</style>
<?php
$sqll="select * FROM employee  WHERE employeeid='$_SESSION[employeeid]'";
$rem=mysqli_query($con,$sqll);
$row=mysqli_fetch_array($rem);
?>
 <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/49.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Profile </h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Set Up profile</li>
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
                            <h5>Update Profile</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="" method="post" onsubmit="return validateform()">
						<div class="form-group">
						<span class="classvalidate" id="idname"></span>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $row['empname'];?>">
                            </div>
                            <div class="form-group">
						<span class="classvalidate" id="idloginid"></span>
                         <input type="text" class="form-control" id="loginid" placeholder="Loginid" name="loginid" value="<?php echo $row['loginid'];?>">
                            </div>
                            
                            <div class="form-group">
							<span class="classvalidate" id="idpassword"></span>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $row['password'];?>" >
                            </div>
							
							<div class="form-group">
							<span class="classvalidate" id="idstatus"></span>
                                 <select class="form-control" id="status" name="status">
								  <option value="">Select Status</option>
								<?php
				$arr = array("Active","Inactive");
				foreach($arr as $val)
				{
					if($val == $row[status])
				{
					echo "<option selected value='$val'>$val</option>";
				}
				else
				{
					echo "<option value='$val'>$val</option>";
				}
				}
			  ?>
									
											</select>
                            </div>
							
							
							
                          
                            <button type="submit" class="btn mag-btn mt-30" name="update">Update</button>
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
		validateform="false";
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