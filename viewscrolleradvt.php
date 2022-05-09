<?php
include "header.php";
if(isset($_GET[delid]))
{
	$sql="DELETE FROM scrolleradvt WHERE scrolleradvtid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('scrolleradvt record deleted successfully...');</script>";
		echo "<script>window.location='viewscrolleradvt.php';</script>";
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
				<table id="myTable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Advertiser Title</th>
			<th>Advertisement Discription</th>
			<th>Status</th>
			<th>Action</th
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT * FROM scrolleradvt";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[advttitle]</td>
			<td>$rs[advtdescription]</td>
			<td>$rs[status]</td>
			<td><a href='add_scrollerads.php?editid=$rs[0]' class='btn  btn-info' >Edit</a> | <a href='viewscrolleradvt.php?delid=$rs[0]' onclick='return confirmdelete()' class='btn btn-danger'>Delete</a></td>
		</tr>";
	}
	?> 
	</tbody>
</table>
				</div>
				</div>
				</div>
				</div>
<?php
include "footer.php";
?>
<script>
 function confirmdelete()
 {
	 if(confirm('Are you sure want to delete this record?') == true)
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
 }
 </script>