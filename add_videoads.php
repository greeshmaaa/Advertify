
<?php
include "header.php";
?>
<?php

if(isset($_FILES['advtvideo']))
{

$allowedExts = array("mp3", "mp4", "wma","wmv","mp");
$extension = pathinfo($_FILES['advtvideo']['name'], PATHINFO_EXTENSION);
if (($_FILES["advtvideo"]["size"] <= 202400000000000000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["advtvideo"]["error"] > 0)
    {
		$video_description='';
   
    }
  else
    {
   
    $video_description=$_FILES["advtvideo"]["name"];
	
    if (file_exists("videoads/" . $_FILES["advtvideo"]["name"]))
      {
      
      }
    else
      {
      move_uploaded_file($_FILES["advtvideo"]["tmp_name"],
      "videoads/" . $_FILES["advtvideo"]["name"]);
      }
    }
  }
									
else
  {
	  $video_description='';
  }

}
?>
<?php
include "dbconnect.php";
if(isset($_POST['add_videoads'])){
	$advttitle=$_POST['advttitle'];
	$advtimg=$_POST['advtvideo'];
	
	$status=$_POST['status'];
	if(isset($_GET[editid]))
	{
	
		$sql = "UPDATE `videoads` SET `advertiserid`='$_SESSION[advertiserid]',`Advttitle`='$_POST[advttitle]',`Videoadvt`='$video_description',`Status`='$_POST[status]' WHERE `videoaddid`='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert('videoadvt record updated successfully...');</SCRIPT>";
		}
	}
		
	else{
	$sqq="INSERT INTO `videoads`(`advertiserid`, `Advttitle`, `Videoadvt`, `Status`) VALUES ('$_SESSION[advertiserid]','$advttitle','$video_description','$status')";
	if(mysqli_query($con,$sqq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Video-ads Added Successfully!!");'; 
                    echo 'window.location.href = "add_videoads.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "add_videoads.php";';
            echo '</script>';
	}
}
}
if(isset($_GET[editid]))
{
	$sqq="SELECT * FROM videoads WHERE videoaddid='$_GET[editid]'";
	$dd=mysqli_query($con,$sqq);
	$rew=mysqli_fetch_array($dd);
}
?>
<style>
.classvalidate{
	color:Tomato;
}
</style>
 <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/49.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Video-Ads</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Video-Ads</li>
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
                            <h5>Submit your Video-Ads</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							<span class="classvalidate" id="idadvttitle">
                                    <label for="upload-file">Video-Ads Title</label></span>
                                    <input type="text" class="form-control" name="advttitle" id="advttitle" value="<?php echo $rew['Advttitle'];?>" placeholder="Video-Ads Title">
                                </div>
								
                 <br>
				Video advertisement Status:<span id="videoadvt" class="errmsg"></span>
                                    <input type="file" class="form-control"  name="advtvideo" id="advtvideo" accept="video/mp4">
                               <br>
                               <div class="form-group">
							   <span class="classvalidate" id="idstatus">
                                    <label for="upload-file">Status</label></span>
                                    <select name="status" class="form-control" id="status">
									<option value=''>Select</option>
	<?php
	$arr = array("Active","Inactive");
	foreach($arr as $val)
	{
		if($val == $rew['Status'])
		{
		echo "<option value='$val' selected>$val</option>";
		}
		else
		{
		echo "<option value='$val'>$val</option>";
		}
	}
	?>
                                        
                                    </select>
                                </div>
                                <button type="submit" name="add_videoads" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Submit </button>
                            </form>
                        </div>
						<br>
						<div class="col-md-5">
						<section class="sidebar">
							<header>
								<h5 style="color:#d32f2f;">Video Advertisement</h5>
							</header>
							<p>
<?php
if(isset($_GET[editid]))
{
?>
	<video controls="" autoplay="" name="media" style="width:100%;"><source src="videoads/<?php echo $rew['Videoadvt']; ?>" type="video/mp4"></video>
<?php
}
else
{
?>
	<img src="images/viewpreview.jpg" width="100%" >
<?php
}
?>						</p>
						</section>
					</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?><script>
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
		document.getElementById("idadvttitle").innerHTML="Video-Ads Title should contain alphabets and characters...";
		validateform2="false";
	}
	if(document.getElementById("advttitle").value=="")
	{
		document.getElementById("idadvttitle").innerHTML="Video-Ads Title Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("advtvideo").value=="")
	{
		document.getElementById("idadvtvideo").innerHTML="Video Should not be empty...";
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