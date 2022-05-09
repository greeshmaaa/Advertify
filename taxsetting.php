<?php
include "header.php";
?>

<?php
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM `tax` WHERE taxid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Tax record deleted successfully');</script>";
		echo "<script>window.location='taxsetting.php';</script>";
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
                            <li class="breadcrumb-item active" aria-current="page">VIEW TAX SETTINGS DETAIL</li>
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
                            <h5>View Tax Settings Detail</h5>
                        </div>
				<table class="table table-bordered">
				<thead>
				<tr>
				<th>Tax Type</th>
			<th>Tax Amount</th>
			<th>Description</th>
			<th colspan="2">Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
				include "dbconnect.php";
	$sql= "SELECT * FROM tax";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[taxtype]</td>
			<td>$rs[taxamt]%</td>
			<td>$rs[description]</td>
			<td><a href='tax.php?editid=$rs[0]' class='btn  btn-info' >Edit</a> </td>
			<td><a href='taxsetting.php?delid=$rs[0]' class='btn  btn-danger' onclick='return confirmdel()'>Delete</a> </td>
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