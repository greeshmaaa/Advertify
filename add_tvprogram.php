<?php
include "header.php";
?>
<?php
	
if(isset($_FILES['img']))
{

$allowedExts = array("jpg","jpeg","png");
$extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
if (($_FILES["img"]["size"] <= 20240000000000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["img"]["error"] > 0)
    {
		$image_names='';
    }
  else
    {
    
    $image_names=$_FILES["img"]["name"];
	
    if (file_exists(".imgtvprogram/" . $_FILES["img"]["name"]))
      {
      
      }
    else
      {
      move_uploaded_file($_FILES["img"]["tmp_name"],
      "imgtvprogram/" . $_FILES["img"]["name"]);
    
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
if(isset($_POST['add_tvprogram'])){
	$fdt =$_POST[fdt];
	$ftime  =$_POST[ftime];
	$tdt  =$_POST[tdt];
	$ttime =$_POST[ttime];
	if(isset($_GET[editid]))
	{
			$sql = "UPDATE tvprogram SET programtype='$_POST[programtype]',title='$_POST[programtitle]',description='$_POST[description]'";
		if($_FILES[img][name] != "")
		{
		$sql = $sql .",img='$image_names'";
		}
		
		$sql = $sql . ",scrolladvtcost='$_POST[scrolladvtcost]',videoadvtcost='$_POST[videoadvtcost]',ftime='$fdt $ftime:00',ttime='$tdt $ttime:00',note='$_POST[note]',status='$_POST[status]' WHERE tvprogramid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('tvprogram record updated successfully..');</script>";
			echo "<script>window.location='add_tvprogram.php';</script>";
		}
	}
	else{
		$sql = "INSERT INTO tvprogram(programtype,title,description,img,scrolladvtcost,videoadvtcost,ftime,ttime,note,status) VALUES('$_POST[programtype]','$_POST[programtitle]','$_POST[description]','$image_names','$_POST[scrolladvtcost]','$_POST[videoadvtcost]','$fdt $ftime:00','$tdt $ttime:00','$_POST[note]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('tvprogram record inserted successfully..');</script>";
			echo "<script>window.location='add_tvprogram.php';</script>";
		}
	}
}
	if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM  tvprogram WHERE tvprogramid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<style>
.classvalidate{
	color:Tomato;
}
textarea.form-control {
    height: 82px;
}
</style>
<section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/40.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Tv Program</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Tv Program</li>
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
                            <h5>Add Tv Program</h5>
							
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							
                                    <label for="upload-file">Program Type</label><span class="classvalidate" id="idprogramtype"></span>
                                   <select placeholder="program type" name="programtype" id="programtype" class="form-control">
			  <option value="">Select Program Type</option>
			  <?php
			  
				$arr = array("Reality show","News","Serial","Movie","Others");
				foreach($arr as $val)
				{
					if($val == $rsedit[programtype])
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
                            <div class="form-group">
							
                                    <label for="upload-file">Program Title</label><span class="classvalidate" id="idprogramtitle"></span>
                                    <input type="text" class="form-control" name="programtitle" id="programtitle" value="<?php echo $rsedit['title'];?>" placeholder="Program Title">
                                </div>   
                                
                                <div class="form-group">
							
                                    <label for="upload-file">Description</label>	<span class="classvalidate" id="iddescription"></span>
                    <textarea  class="form-control" cols="30" rows="10" name="description" id="description" placeholder="Description"><?php echo $rsedit['description'];?></textarea>
                                </div>
                               <div class="form-group">
							
                                    <label for="upload-file">Program Image</label><span class="classvalidate" id="idprogram_image"></span>
                                    <input type="file" class="form-control" name="img" id="program_image">
									<?php
if(isset($_GET[editid]))
{		
		if($rsedit[img] != "")
		{
			if(file_exists("imgtvprogram/".$rsedit[img]))
			{
				$img = "imgtvprogram/".$rsedit[img];
			}
		}
		else
		{
				$img = "img/testimonial-bg-1.jpg";
		}
	echo "<img src='$img' style='width: 100px;height:100px;'>";
}
?>
                                </div> 
								<div class="form-group">
							
                                    <label for="upload-file">Scroller Advt Cost(Cost Per Word)</label><span class="classvalidate" id="idscrolladvtcost"></span>
                                    <input type="text" class="form-control" name="scrolladvtcost" id="scrolladvtcost" value="<?php echo $rsedit['scrolladvtcost'];?>" placeholder="Scroller Advt Cost">
                                </div>  
								<div class="form-group">
							
                                    <label for="upload-file">video Advt Cost(Cost Per Second)</label><span class="classvalidate" id="idvideoadvtcost"></span>
                                    <input type="text" class="form-control" name="videoadvtcost" id="videoadvtcost" value="<?php echo $rsedit['videoadvtcost'];?>" placeholder="video Advt Cost">
                                </div>  
                           <div class="form-group">
							
                                    <label for="upload-file">Program starts at:</label></span>
									<table>
				<tr>
				<?php
				$datetime = date_create($rsedit['ftime']);
				$date = date_format($datetime,"Y-m-d");
				$time = date_format($datetime,"H:i \A\M");
					if($rsedit['ftime'])
					{
					?>
					<td>
					
			<input  type="date" value="<?php echo $date;?>" placeholder="Start time" name="fdt" class="form-control" >
					</td>
					<td>
					
			<input  value="<?php echo $time ;?>" placeholder="Start time" name="ftime" class="form-control">
					</td>
					<?php
					}
					else
					{
					date_default_timezone_set('Asia/Kolkata');
					?>
					<td>
					
			<input type="date" value="<?php echo date("Y-m-d");?>" placeholder="Start time" name="fdt" class="form-control" >
					</td>
					<td>
					
			<input  value="<?php echo date("h:i \A\M");?>" placeholder="Start time" name="ftime" class="form-control">
					</td>
					<?php
					}
					?>
				</tr>
			</table>
                                    
                                </div>
								<div class="form-group">
							
                                    <label for="upload-file">Program End at:</label>
                                   
									<table>
				<tr>
				<?php
				$datetime = date_create($rsedit['ttime']);
				$date1 = date_format($datetime,"Y-m-d");
				$time1 = date_format($datetime,"H:i \P\M");
					if($rsedit['ttime'])
					{
					?>
					<td>
			<input type="date" value="<?php echo $date1;?>" placeholder="Start time" name="tdt" class="form-control">
					</td>
					<td>
			<input  value="<?php echo $time1 ;?>" placeholder="Start time" name="ttime" class="form-control">
					</td>
					<?php
					}
					else
					{
					date_default_timezone_set('Asia/Kolkata');
					?>
					<td>
			<input type="date" value="<?php echo date("Y-m-d");?>" placeholder="Start time" name="tdt" class="form-control">
					</td>
					<td>
			<input  value="<?php echo date("h:i \P\M");?>" placeholder="Start time" name="ttime" class="form-control">
					</td>
					<?php
					}
					?>
				</tr>
			</table>
                                </div>
									<div class="form-group">
							
                                    <label for="upload-file">Note</label><span class="classvalidate" id="idnote"></span>
                                   <textarea  class="form-control" cols="30" rows="10" name="note" id="note" placeholder="Note"><?php echo $rsedit['note'];?></textarea>
                                </div>
								
                               <div class="form-group">
							  
                                    <label for="upload-file">Status</label> <span class="classvalidate" id="idstatus"></span>
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
                                <button type="submit" name="add_tvprogram" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Submit </button>
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
	
	
	if(!document.getElementById("programtitle").value.match(alphaspaceExp))
	{
		document.getElementById("idprogramtitle").innerHTML="Program title should contain alphabets and characters...";
		validateform2="false";
	}
	if(document.getElementById("programtype").value=="")
	{
		document.getElementById("idprogramtype").innerHTML="Program Type Should not be empty...";
		validateform="false";
	}
	
	
	
	
	if(document.getElementById("programtitle").value=="")
	{	
		document.getElementById("idprogramtitle").innerHTML="Program title should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("description").value=="")
	{	
		document.getElementById("iddescription").innerHTML="Description should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("program_image").value=="")
	{	
		document.getElementById("idprogram_image").innerHTML="Image should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("scrolladvtcost").value=="")
	{	
		document.getElementById("idscrolladvtcost").innerHTML="Scrolladvtcost should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("videoadvtcost").value=="")
	{	
		document.getElementById("idvideoadvtcost").innerHTML="Videoadvtcost should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("status").value=="")
	{
		document.getElementById("idstatus").innerHTML="Must Select status...";
		validateform="false";
	}
	if(document.getElementById("note").value=="")
	{
		document.getElementById("idnote").innerHTML="Note should not be empty...";
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