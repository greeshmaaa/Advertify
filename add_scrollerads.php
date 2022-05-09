
<?php
include "header.php";
?>

<?php
include "dbconnect.php";
if(isset($_POST['add_scrollerads'])){
	$advttitle=$_POST['advttitle'];
	
	$status=$_POST['status'];
	if(isset($_GET[editid]))
	{
		//Update statement starts here
		$sql = "UPDATE scrolleradvt SET advertiserid='$_POST[advertiserid]',advttitle='$_POST[advttitle]',advtdescription='$_POST[advtdescription]',status='$_POST[status]' WHERE scrolleradvtid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('scrolleradvt record updated successfully..');</script>";
			echo "<script>window.location='viewscrolleradvt.php';</script>";
		}
		//Update statement ends here
	}
	else
	{
	$sqq="INSERT INTO `scrolleradvt`(`advertiserid`, `advttitle`, `advtdescription`, `status`) VALUES ('$_SESSION[advertiserid]','$advttitle','$_POST[advtdescription]','$status')";
	if(mysqli_query($con,$sqq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Scroller-ads Added Successfully!!");'; 
                    echo 'window.location.href = "add_scrollerads.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "add_scrollerads.php";';
            echo '</script>';
	}
}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM  scrolleradvt WHERE scrolleradvtid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<style>
.classvalidate{
	color:Tomato;
}
textarea.form-control {
    height: 92px;
}
</style>
 <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/49.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Scroller-Ads</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Scroller-Ads</li>
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
                            <h5>Submit your Scroller-Ads</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							<span class="classvalidate" id="idadvttitle">
                                    <label for="upload-file">Scroller-Ads Title</label></span>
                                    <input type="text" class="form-control" name="advttitle" id="advttitle" placeholder="Scroller-Ads Title" value="<?php echo $rsedit[advttitle]; ?>">
                                </div>
                                
                                  <div class="form-group">
								    
								    <label for="upload-file">Enter scroll advertisement here</label>
								<span class="classvalidate" id="iddescription"></span>
                                  
                                   <textarea name="advtdescription"  class="form-control" onchange="loadscrollpreview(this.value)" onkeyup="countwords(this.value)" placeholder="scroll advertisement here" ><?php echo $rsedit[advtdescription]; /* */  ?></textarea>
		Number of words: <span id="divcountwords"><?php echo str_word_count($rsedit[advtdescription]); /* */  ?></span>
		<div class="col-md-6" id="divadvtpreview"><?php include("ajaxscrolladvtpreview.php"); ?>
		</div>
                                </div>
                                
                                
                               <div class="form-group">
							   <span class="classvalidate" id="idstatus">
                                    <label for="upload-file">Status</label></span>
                                    <select name="status" class="form-control" id="status">
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
                                        
                                    </select>
                                </div>
                                <button type="submit" name="add_scrollerads" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Add </button>
                            </form>
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
		document.getElementById("idadvttitle").innerHTML="Scroller-Ads Title should contain alphabets and characters...";
		validateform="false";
	}
	if(document.getElementById("advttitle").value=="")
	{
		document.getElementById("idadvttitle").innerHTML="Scroller-Ads Title Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("advticon").value=="")
	{
		document.getElementById("idadvticon").innerHTML="Icon Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("description").value=="")
	{
		document.getElementById("iddescription").innerHTML="Description Should not be empty...";
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
<script>
function loadscrollpreview(scrollmsg)
{
if (scrollmsg == "") 
	{
        document.getElementById("divadvtpreview").innerHTML = "";
        return;
    } 
	else 
	{ 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divadvtpreview").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxscrolladvtpreview.php?scrollmsg="+scrollmsg,true);
        xmlhttp.send();
}
}
function countwords(scrolladvt)
{
	document.getElementById("divcountwords").innerHTML = scrolladvt.split(' ').length-1;
}
</script>