<?php
include "header.php";
?>

<?php
include "dbconnect.php";
if(isset($_POST['add_category'])){
	
	$sqq="INSERT INTO `articlecategory`(`category`, `description`, `status`) VALUES ('$_POST[category]','$_POST[categorydescription]','$_POST[status]')";
	if(mysqli_query($con,$sqq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Article Category Added Successfully!!");'; 
                    echo 'window.location.href = "add_category.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "add_category.php";';
            echo '</script>';
	}
}
?>
<style>
.classvalidate{
	color:Tomato;
}
</style>
<section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/40.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Category</h2>
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
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                            <h5>Add Category</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							<span class="classvalidate" id="idcategory">
                                    <label for="upload-file">Category</label></span>
                                    <input type="text" class="form-control" name="category" id="category">
                                </div>
                               
                                
                                <div class="form-group">
								<span class="classvalidate" id="idcategorydescription">
                                    <label for="upload-file">Description</label></span>
                    <textarea  class="form-control" cols="30" rows="10" name="categorydescription" id="categorydescription"></textarea>
                                </div>
                              
								 
								 
                           
                               <div class="form-group">
							   <span class="classvalidate" id="idstatus">
                                    <label for="upload-file">Status</label></span>
                                    <select name="status" id="status" class="form-control">
									  <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        
                                    </select>
                                </div>
                                <button type="submit" name="add_category" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Add </button>
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
	
	
	if(!document.getElementById("category").value.match(alphaspaceExp))
	{
		document.getElementById("idcategory").innerHTML="Category should contain alphabets and characters...";
		validateform2="false";
	}
	if(document.getElementById("category").value=="")
	{
		document.getElementById("idcategory").innerHTML="Category Should not be empty...";
		validateform="false";
	}
	
	
	
	
	if(document.getElementById("categorydescription").value=="")
	{	
		document.getElementById("idcategorydescription").innerHTML="Category Description should not be empty...";
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