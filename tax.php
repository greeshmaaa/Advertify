<?php
include "header.php";
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		//Update statement starts here
		$sql = "UPDATE tax SET taxtype='$_POST[taxtype]',taxamt='$_POST[taxamt]',description='$_POST[description]',status='$_POST[status]' WHERE taxid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('tax record updated successfully..');</script>";
			echo "<script>window.location='taxsetting.php';</script>";
		}
		//Update statement ends here
	}
	else
	{	
	$sql = "INSERT INTO `tax`(`taxtype`, `taxamt`, `description`, `status`) VALUES ('$_POST[taxtype]','$_POST[taxamt]','$_POST[description]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('tax record inserted successfully..');</script>";
		echo "<script>window.location='tax.php';</script>";
	}
}
}
//2  - Selecting the record starts here..
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM  tax WHERE taxid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
// 2 - Select the record ends here..

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
                        <h2>TAX</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Tax</li>
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
                            <h5>Add Tax</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							
                                    <label for="upload-file">Tax Type:</label> <span class="classvalidate" id="idtaxtype"></span>
                                   <input type="text" value="<?php echo $rsedit[taxtype]; ?>" name="taxtype" placeholder="Tax Type" class="form-control" id="taxtype">
                                </div>
                               
                                
                                <div class="form-group">
								
                                    <label for="upload-file">Tax Amount:</label> <span class="classvalidate" id="idtaxamt"></span>
                   <input type="text" value="<?php echo $rsedit[taxamt]; ?>" name="taxamt" placeholder="Tax Amount" class="form-control" id="taxamt">
                                </div>
                              
								 
								 
                           
                               <div class="form-group">
							  
                                    <label for="upload-file">Description:</label> <span class="classvalidate" id="iddescription"></span>
                                         <textarea name="description"  placeholder="Description" class="form-control" id="description"><?php echo $rsedit[description]; ?></textarea>
                                </div>
								                               <div class="form-group">
							  
                                    <label for="upload-file">Status</label> <span class="classvalidate" id="idstatus"></span>
                                         <select placeholder="Status" name="status" id="status" class="form-control">
			  <option value="">Select Status</option>
			  <?php
				$arr = array("Active","Inactive");
				foreach($arr as $val)
				{
				if($val == $rsedit[status])
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
                                <button type="submit" name="submit" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Submit </button>
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
	
	

	if(document.getElementById("taxamt").value=="")
	{
		document.getElementById("idtaxamt").innerHTML="Tax Amount Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("taxtype").value=="")
	{
		document.getElementById("idtaxtype").innerHTML="Tax Type Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("description").value=="")
	{	
		document.getElementById("iddescription").innerHTML="Description should not be empty...";
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