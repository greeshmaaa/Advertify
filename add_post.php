<?php
include "header.php";
?>
<?php
	
if(isset($_FILES['articleimage']))
{

$allowedExts = array("jpg","jpeg","png");
$extension = pathinfo($_FILES['articleimage']['name'], PATHINFO_EXTENSION);
if (($_FILES["articleimage"]["size"] <= 20240000000000000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["articleimage"]["error"] > 0)
    {
		$image_names='';
    }
  else
    {
    
    $image_names=$_FILES["articleimage"]["name"];
	
    if (file_exists("article-images/" . $_FILES["articleimage"]["name"]))
      {
      
      }
    else
      {
      move_uploaded_file($_FILES["articleimage"]["tmp_name"],
      "article-images/" . $_FILES["articleimage"]["name"]);
    
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
if(isset($_POST['add_article'])){
	
	$sqq="INSERT INTO `article`(`categoryid`, `articletype`,`title`, `articledescription`, `images`, `publisheddate`, `status`) VALUES ('$_POST[category]','$_POST[type]','$_POST[title]','$_POST[description]','$image_names','$_POST[publishdate]','$_POST[status]')";
	if(mysqli_query($con,$sqq)){
		 echo '<script type="text/javascript">'; 
                    echo 'alert("Article  Added Successfully!!");'; 
                    echo 'window.location.href = "add_post.php";';
                    echo '</script>';
	}
	else{
		 echo '<script type="text/javascript">'; 
            echo 'alert("Something Went Wrong!!");'; 
            echo 'window.location.href = "add_post.php";';
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
                            <h5>Article publishing Tool</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
							
							<div class="form-group">
							
                                    <label for="upload-file">Category</label><span class="classvalidate" id="idcategory"></span>
                                    <select name="category" id="category" class="form-control">
									  <option value="">Select Category</option>
                                        <?php
				$sqlarticlecategory  = "SELECT * FROM articlecategory WHERE status='Active'";
				$qsqlarticlecategory = mysqli_query($con,$sqlarticlecategory);
				while($rsarticlecategory = mysqli_fetch_array($qsqlarticlecategory))
				{
					if($rsedit[articlecategoryid] == $rsarticlecategory[articlecategoryid])
					{
					echo "<option value='$rsarticlecategory[articlecategoryid]' selected>$rsarticlecategory[category]</option>";
					}
					else
					{
					echo "<option value='$rsarticlecategory[articlecategoryid]'>$rsarticlecategory[category]</option>";
					}
				}
				?>
                                    </select>
                                </div>
                               
                                <div class="form-group">
							
                                    <label for="upload-file">Post Type</label><span class="classvalidate" id="idtype"></span>
									<select placeholder="Article Type" name="type" class="form-control" id="type">
			  <option value="">Select PostType</option>
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
                                </div>
								  
								  <div class="form-group">
							
                                    <label for="upload-file">Article title <span class="classvalidate" id="idtitle"></span></label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Article Title">
                                </div>
								
                                <div class="form-group">
								
                                    <label for="upload-file">Description</label><span class="classvalidate" id="iddescription"></span>
                    <textarea  class="form-control" cols="30" rows="10" name="description" id="description" placeholder="Article description"></textarea>
                                </div>
                                <div class="form-group">
							
                                    <label for="upload-file">Article Images</label><span class="classvalidate" id="idarticleimage"></span>
                                    <input type="file" class="form-control" name="articleimage" id="articleimage" placeholder="Article Image">
                                </div>
								  <div class="form-group">
						
                                    <label for="upload-file">Publish Date</label>	<span class="classvalidate" id="idpublishdate"></span>
                                    <input type="date" class="form-control" name="publishdate" id="publishdate" value="<?php echo date("Y-m-d"); ?>" placeholder="Publish Date" min="<?php echo date("Y-m-d"); ?>">
                                </div> 
								 
                           
                               <div class="form-group">
							   
                                    <label for="upload-file">Status</label><span class="classvalidate" id="idstatus"></span>
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
                                <button type="submit" name="add_article" class="btn mag-btn mt-30"><i class="fa fa-plus"></i> Add </button>
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