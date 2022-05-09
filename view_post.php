<?php
include "header.php";
?>
<?php
if(isset($_GET[articlecategory]))
{
	$sql ="DELETE FROM `articlecategory` WHERE articlecategoryid='$_GET[articlecategory]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Article Category record deleted successfully');</script>";
		echo "<script>window.location='view_category.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
<?php
if(isset($_GET[articleid]))
{
	$sql ="DELETE FROM `article` WHERE articleid='$_GET[articleid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Post record deleted successfully');</script>";
		echo "<script>window.location='view_post.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
<style>
.col-lg-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 101.666667% !important;
}
</style>
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
                            <h5>Post</h5>
                        </div>
				<table class="table table-bordered">
				<thead>
				<tr>
			<th>Images</th>
			<th>Category</th>
			<th>Title</th>
			<th>Date</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
				</thead>
				<tbody>
				<?php
	$sql= "SELECT article.*,articlecategory.category FROM article LEFT JOIN articlecategory ON article.categoryid=articlecategory.articlecategoryid";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs[images] == "")
		{
			$imgname  = "img/noimage.jpg";
		}
		else if(file_exists("article-images/$rs[images]"))
		{
			$imgname = "article-images/$rs[images]";
		}
		else
		{
			$imgname  = "img/noimage.jpg";
		}
		echo "<tr>
			<td><img src='$imgname' width='75' height='50' ></td>
			<td>
				<b>Category:</b> $rs[category] 
			<br>
				<b>Article type:</b> $rs[articletype]
			</td>
			<td>$rs[title]</td>
			<td>
			<b>Published&nbsp;on:</b> <br>$rs[publisheddate] <bR>
			<b>Written:</b>  <br>$rs[articledate]
			</td>
			<td>$rs[status]</td>
			<td><a href='update_post.php?article=$rs[0]' style='color:#fff;'><button type='button' class='btn btn-success' >Update</a></td>
		<td><a href='view_post.php?articleid=$rs[0]' onclick='return confirmdel()' style='color:#fff;'><button type='button' class='btn btn-danger' >Delete</a></button></td>
		</tr>";
	}
	?>
				</tbody>
				</table>
				</div>
				</div>
				</div>
				</div></div>
<?php
include "footer.php";
?>

<script>
		function confirmdel()
		{
			if(confirm("Are you sure want to delete this record?") == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
</script>