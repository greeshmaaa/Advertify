<?php
include "header.php";
if(isset($_GET[delidd]))
{
	$sql="DELETE FROM videoads WHERE videoaddid='$_GET[delidd]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('video ad record deleted successfully...');</script>";
		echo "<script>window.location='view_videoads.php';</script>";
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
                            <li class="breadcrumb-item active" aria-current="page"> VIDEO ADVERTISEMENT</li>
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
				<table id="myTable"  class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
	<thead>
		<tr>
		<?php
		if(isset($_SESSION[employeeid]))
		{
			echo "<th>Advertiser</th>";
		}
		?>
			<th>Advertisement Title</th>
			<th>Video Advertisement</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM videoads LEFT JOIN advertiser ON videoads.advertiserid = advertiser.advertiserid WHERE videoads.videoaddid != '0' ";
	if(isset($_SESSION[advertiserid]))
	{
		$sql = $sql . " AND videoads.advertiserid='$_SESSION[advertiserid]'";
	
	}
	
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>";
		if(isset($_SESSION[employeeid]))
		{
		echo "<td>$rs[advertisername]</td>";
		}
		echo "<td>$rs[Advttitle]</td>
			<td>
			<a href='videoads/$rs[Videoadvt]'  download>Download Video</a>
			</td>
			<td>$rs[status]</td>
			<td><a href='add_videoads.php?editid=$rs[videoaddid]' class='btn  btn-info' >Edit</a> | <a href='viewscrolleradvt.php?delid=$rs[0]' onclick='return confirmdelete()' class='btn btn-danger'>Delete</a></td>
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