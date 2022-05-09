<?php
include "header.php";
?>

<?php
include "dbconnect.php";
if(isset($_POST['add_article'])){
	
	$sqq="UPDATE `article` SET `categoryid`='$_POST[category]',`articletype`='$_POST[type]',`articledate`='$dt',`title`='$_POST[title]',`articledescription`='$_POST[description]',`publisheddate`='$_POST[publishdate]',`status`='$_POST[status]' WHERE `articleid`='$_POST[articleid]'";
	if(mysqli_query($con,$sqq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Article  Updated Successfully!!");'; 
                    echo 'window.location.href = "update_post.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "update_post.php";';
            echo '</script>';
	}
}
?>
<style>
.classvalidate{
	color:Tomato;
}
textarea.form-control {
    height: 98px;
}
</style>
<?php
if(isset($_GET[article]))
{
	$sqledit ="SELECT a.*,b.* FROM `article` a LEFT JOIN articlecategory b ON a.	categoryid=b.articlecategoryid WHERE a.articleid='$_GET[article]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	
}
?>
<section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/40.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Post</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Post</li>
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
                            <h5>Update Post</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							<span class="classvalidate" id="idcategory">
                                    <label for="upload-file">Category</label></span>
                                    <select name="category" id="category" class="form-control">
									  <option value="">Select Category</option>
                                        <?php
			$sqlstateid ="SELECT * FROM articlecategory WHERE status='Active'";
			$qsqlstateid = mysqli_query($con,$sqlstateid);
			while($rsstateid = mysqli_fetch_array($qsqlstateid) )
			{
				if($rsstateid[articlecategoryid] == $rsedit[categoryid])
				{
				echo "<option value='$rsstateid[articlecategoryid]' selected>$rsstateid[category]</option>";
				}
				else
				{
				echo "<option value='$rsstateid[articlecategoryid]'>$rsstateid[category]</option>";
				}
			}
		?>
                                    </select>
                                </div>
                               
                                <div class="form-group">
							<span class="classvalidate" id="idtype">
                                    <label for="upload-file">Article Type</label></span>
									<select placeholder="Article Type" name="type" class="form-control">
									 
                                       <?php
				$arr = array("News","Articles");
				foreach($arr as $val)
				{
					if($val == $rsedit[articletype])
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
                                    <input type="text" class="form-control" name="type" id="type" placeholder="Article Type" value="<?php echo $rsedit['articletype'];?>">
									 <input type="hidden" class="form-control" name="articleid" id="type" placeholder="Article Type" value="<?php echo $rsedit['articleid'];?>">
                                </div>
								   
								  <div class="form-group">
							<span class="classvalidate" id="idtitle">
                                    <label for="upload-file">Article title</label></span>
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $rsedit['title'];?>">
                                </div>
                                <div class="form-group">
								<span class="classvalidate" id="iddescription">
                                    <label for="upload-file">Description</label></span>
                    <textarea  class="form-control" cols="30" rows="10" name="description" id="description" placeholder="Article description"><?php echo $rsedit['articledescription'];?></textarea>
                                </div>
                               
								  <div class="form-group">
							<span class="classvalidate" id="idpublishdate">
                                    <label for="upload-file">Publish Date</label></span>
               <input type="date" class="form-control" name="publishdate" id="publishdate" placeholder="Publish Date" value="<?php echo $rsedit['publisheddate'];?>">
                                </div> 
								 
                           
                               <div class="form-group">
							   <span class="classvalidate" id="idstatus">
                                    <label for="upload-file">Status</label></span>
                                    <select name="status" id="status" class="form-control">
									
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
                                <button type="submit" name="add_article" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Update </button>
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
	
	
	if(!document.getElementById("type").value.match(alphaspaceExp))
	{
		document.getElementById("idtype").innerHTML="Article Type should contain alphabets and characters...";
		validateform2="false";
	}
	if(document.getElementById("type").value=="")
	{
		document.getElementById("idtype").innerHTML="Article Type Should not be empty...";
		validateform="false";
	}
	if(document.getElementById("description").value=="")
	{	
		document.getElementById("iddescription").innerHTML="Description should not be empty...";
		validateform="false";
	} 
	
	if(document.getElementById("articledate").value=="")
	{	
		document.getElementById("idarticledate").innerHTML="Article Date should not be empty...";
		validateform="false";
	} 
	if(!document.getElementById("title").value.match(alphaspaceExp))
	{
		document.getElementById("idtitle").innerHTML="Title should contain alphabets and characters...";
		validateform2="false";
	}
	if(document.getElementById("title").value=="")
	{	
		document.getElementById("idtitle").innerHTML="Title should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("articleimage").value=="")
	{	
		document.getElementById("idarticleimage").innerHTML="Artcle Image should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("publishdate").value=="")
	{	
		document.getElementById("idpublishdate").innerHTML="Publish Date should not be empty...";
		validateform="false";
	} 
	if(document.getElementById("status").value=="")
	{
		document.getElementById("idstatus").innerHTML="Must Select status...";
		validateform="false";
	}
	if(document.getElementById("category").value=="")
	{
		document.getElementById("idcategory").innerHTML="Must Select Article Category...";
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