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
                            <h5>Category</h5>
                        </div>
				<table class="table table-bordered">
				<thead>
				<tr>
				<th>Category</th>
				<th>Description</th>
				<th>Status</th>
				<th colspan="2">Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$sqr="SELECT * FROM `articlecategory`";
				$res=mysqli_query($con,$sqr);
				while($row=mysqli_fetch_array($res)){
				?>
				<tr>
				<td><?php echo $row['category'];?></td>
				<td><?php echo $row['description'];?></td>
				<td><?php echo $row['status'];?></td>
				<td><a href="update_category.php?articlecategoryid=<?php echo $row[0]; ?>" style="color:#fff;"><button type="button" class="btn btn-success" >Update</a></td>
		<td><a href="view_category.php?articlecategory=<?php echo $row[0]; ?>" onclick='return confirmdel()' style="color:#fff;"><button type="button" class="btn btn-danger" >Delete</a></button></td>
				</tr>
				<?php
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