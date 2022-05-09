<?php
include "header.php";
?>
<?php
	
if(isset($_FILES['advtimg']))
{

$allowedExts = array("jpg","jpeg","png");
$extension = pathinfo($_FILES['advtimg']['name'], PATHINFO_EXTENSION);
if (($_FILES["advtimg"]["size"] <= 20240000000000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["advtimg"]["error"] > 0)
    {
		$image_names='';
    }
  else
    {
    
    $image_names=$_FILES["advtimg"]["name"];
	
    if (file_exists("webads-images/" . $_FILES["advtimg"]["name"]))
      {
      
      }
    else
      {
      move_uploaded_file($_FILES["advtimg"]["tmp_name"],
      "webads-images/" . $_FILES["advtimg"]["name"]);
    
      }
    }
  }
									
else
  {
	  $image_names='';
  }
}
?>
<?php
include "dbconnect.php";
if(isset($_POST['add_webads'])){
	$advttitle=$_POST['advttitle'];
	$advtimg=$_POST['advtimg'];
	$advtdescription=$_POST['advtdescription'];
	$advtemail=$_POST['advtemail'];
	$advtwww=$_POST['advtwww'];
	$advtaddress=$_POST['advtaddress'];
	$advttype=$_POST['advttype'];
	$status=$_POST['status'];
	if(isset($_GET[editid]))
	{
		//Update statement starts here
		$sql = "UPDATE webads SET advttitle='$_POST[advttitle]'";
		if($_FILES[advtimg][name] != "")
		{
		$sql = $sql .",advtimg='$filename'";
		}
		
	    $sql = $sql . ",advtdescription='$_POST[advtdescription]',advtemail='$_POST[advtemail]',advtwww='$_POST[advtwww]',advtaddress='$_POST[advtaddress]',advttype='$_POST[advttype]',status='$_POST[status]',cpc='$_POST[cpc]' WHERE webadid ='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Web Advertisement template record updated successfully..');</script>";
			echo "<script>window.location='view_webads.php';</script>";
		}
		//Update statement ends here
	}
	else{
	$sqq="INSERT INTO `webads`(`advertiserid`, `advttitle`, `advtimg`, `advtdescription`, `advtemail`, `advtwww`, `advtaddress`, `advttype`, `cpc`,`status`) VALUES ('$_SESSION[advertiserid]','$advttitle','$image_names','$advtdescription','$advtemail','$advtwww','$advtaddress','$advttype','$_POST[cpc]','$status')";
	if(mysqli_query($con,$sqq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Web-Ads Added Successfully!!");'; 
                    echo 'window.location.href = "add_webads.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "add_webads.php";';
            echo '</script>';
	}
}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM  webads WHERE webadid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
		if($rsedit[advtimg] == "")
		{
			$imgname  = "img/noimage.jpg";
		}
		else if(file_exists("webads-images/$rsedit[advtimg]"))
		{
			$imgname = "webads-images/$rsedit[advtimg]";
		}
		else
		
		{
			$imgname  = "img/noimage.jpg";
		}
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
                        <h2>Web Ads</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Web Ads</li>
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
                            <h5>Submit your Web Ads</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							<span class="classvalidate" id="idadvttitle">
                                    <label for="upload-file">Web-Ads Title</label></span>
                                    <input type="text" class="form-control" name="advttitle" id="advttitle"  value="<?php echo $rsedit[advttitle]; ?>" placeholder="Web-Ads Title">
                                </div>
                                <div class="form-group">
								<span class="classvalidate" id="idadvtimg">
                                    <label for="upload-file">Upload Your Image</label></span>
                                    <input type="file" class="form-control-file"  name="advtimg" >
									<?php
			if($rsedit[advtimg] != "")
			{
			?>
			<img src="<?php echo $imgname; ?>" >
			<?php
			}
			?>
                                </div>
                                
                                <div class="form-group">
								<span class="classvalidate" id="idadvtdescription">
                                    <label for="upload-file">Web-Ads Description</label></span>
                    <textarea  class="form-control" cols="30" rows="10" name="advtdescription" id="advtdescription" placeholder="Web-Ads Description"><?php echo $rsedit[advtdescription]; ?></textarea>
                                </div>
                                <div class="form-group">
								<span class="classvalidate" id="idadvtemail">
                                    <label for="upload-file">Web-Ads Email</label></span>
                                    <input type="text" class="form-control" name="advtemail" id="advtemail" value="<?php echo $rsedit[advtemail]; ?>" placeholder="Web-Ads Email" >
                                </div>
								  <div class="form-group">
								  <span class="classvalidate" id="idadvtwww">
                                    <label for="upload-file">Website Name</label></span>
                                    <input type="text" class="form-control" name="advtwww" id="advtwww" value="<?php echo $rsedit[advtwww]; ?>" placeholder="Website Name">
                                </div>
								 <div class="form-group">
								 <span class="classvalidate" id="idadvtaddress">
                                    <label for="upload-file">Web-Ads Address</label></span>
                                    <textarea  class="form-control" cols="30" rows="10" name="advtaddress" id="advtaddress" placeholder="Web-Ads Address"><?php echo $rsedit[advtaddress]; ?></textarea>
                                </div>
								 <div class="form-group">
								 <span class="classvalidate" id="idcpc">
                                    <label for="upload-file">Cost Per Click</label></span>
                                    <input type="text" class="form-control" name="cpc" id="cpc" value="<?php echo $rsedit[cpc]; ?>" placeholder="Cost Per Click">
                                </div>
                                <div class="form-group">
								<span class="classvalidate" id="idadvttype">
                                    <label for="upload-file">Advertisement Type:</label></span>
                                     <select placeholder="Advertisement type" name="advttype" class="form-control" id="advttype" >
			  <option value="">Select Advertisement Type:</option>
			  <?php
				$arr = array("Banner Ads","Text Ads");
				foreach($arr as $val)
				{
					if($val == $rsedit[advttype])
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
                               <div class="form-group">
							   <span class="classvalidate" id="idstatus">
                                    <label for="upload-file">Status</label></span>
                                    <select name="status" id="status" class="form-control">
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
                                <button type="submit" name="add_webads" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Add </button>
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
	
	
	if(!document.getElementById("advttitle").value.match(alphaspaceExp))
	{
		document.getElementById("idadvttitle").innerHTML="Web-Ads Title should contain alphabets and characters...";
		validateform2="false";
	}
	if(document.getElementById("advttitle").value=="")
	{
		document.getElementById("idadvttitle").innerHTML="Web-Ads Title Should not be empty...";
		validateform="false";
	}
	if(!document.getElementById("advtemail").value.match(emailExp))
	{
		document.getElementById("idadvtemail").innerHTML="Entered Web-Ads Email is not in a valid format....";
		validateform="false";
	}
	if(document.getElementById("advtemail").value=="")
	{
		document.getElementById("idadvtemail").innerHTML="Web-Ads Email Should not be empty...";
		validateform="false";
	}
	
	
	if(document.getElementById("advtdescription").value=="")
	{	
		document.getElementById("idadvtdescription").innerHTML="Web-Ads Description should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("advtwww").value=="")
	{	
		document.getElementById("idadvtwww").innerHTML="Web-Ads www should not be empty...";
		validateform="false";
	} 
	
	if(document.getElementById("advttype").value=="")
	{	
		document.getElementById("idadvttype").innerHTML="Web-Ads Catagory should not be empty...";
		validateform="false";
	} 
	
	if(document.getElementById("advtaddress").value=="")
	{
		document.getElementById("idadvtaddress").innerHTML="Web-Ads Address Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("cpc").value=="")
	{
		document.getElementById("idcpc").innerHTML="Cost Per Click Should not be empty...";
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