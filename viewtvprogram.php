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
if(isset($_GET[tvprogramid]))
{
	$sql ="DELETE FROM `tvprogram` WHERE tvprogramid='$_GET[tvprogramid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Tv record deleted successfully');</script>";
		echo "<script>window.location='viewtvprogram.php';</script>";
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
				<table class="table table-bordered" id="myTable">
				<thead>
				<tr>
				<th>Image</th>
			<th>Program type</th>
			<th>Show name</th>
			<th>Scroll Advertisement cost</th>
			<th>Video Advertisement cost</th>
			<th>Timings</th>
			<th>Note</th>
			<th>Status</th>
			<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
	$sql= "SELECT * FROM tvprogram";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs[img] == "")
		{
			$imgname  = "img/noimage.jpg";
		}
		else if(file_exists("imgtvprogram/$rs[img]"))
		{
			$imgname = "imgtvprogram/$rs[img]";
		}
		else
		
		{
			$imgname  = "img/noimage.jpg";
		}
		?>
		<tr>
			<td><img src="<?php echo $imgname;?>" width='75' height='50' ></td>
		<td><?php echo $rs['programtype'];?></td>
				<td><?php echo $rs['title'];?></td>
				
				<td><?php echo $rs['scrolladvtcost'];?></td>
				<td><?php echo $rs['videoadvtcost'];?></td>
			<td><?php  echo date("d-M-Y h:i A",strtotime($rs[ftime])) . " -  " .  date("d-M-Y h:i A",strtotime($rs[ttime])) ;?></td>
				<td><?php echo $rs['note'];?></td>
				<td><?php echo $rs['status'];?></td>
				<td><a href='add_tvprogram.php?editid=<?php echo $rs[0];?>' class='btn  btn-success' >Edit</a> | <a href='viewtvprogram.php?tvprogramid=<?php echo $rs[0];?>' onclick='return confirmdelete()' class='btn btn-danger'>Delete</a></td>
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
		function confirmdelete()
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
<script>
 $(document).ready( function () {
    $('#myTable').DataTable();
} );
 </script>