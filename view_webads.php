<?php
include "header.php";
if(isset($_GET[delid]))
{
	$sql="DELETE FROM webads WHERE webadid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('webads record deleted successfully...');</script>";
		echo "<script>window.location='view_webads.php';</script>";
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
				<table class="table table-bordered">
				<thead>
				<tr>
				<th>Image</th>
			<?php
			if(isset($_SESSION["employeeid"]))
			{
				echo "<th>Advertiser</th>";
			}
			?>			
			<th>Advertiser Title</th>
			<th>Type</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
				</thead>
				<tbody>
				<?php
	$sql= "SELECT webads.*,advertiser.advertisername FROM webads LEFT JOIN advertiser ON webads.advertiserid=advertiser.advertiserid WHERE webads.webadid!='0' ";
	if(isset($_SESSION[advertiserid]))
	{
		$sql= $sql . " AND webads.advertiserid='$_SESSION[advertiserid]'";
	}
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs[advtimg] == "")
		{
			$imgname  = "img/noimage.jpg";
		}
		else if(file_exists("webads-images/$rs[advtimg]"))
		{
			$imgname = "webads-images/$rs[advtimg]";
		}
		else
		{
			$imgname  = "img/noimage.jpg";
		}
		echo "<tr>
		<td><img src='$imgname' width='75' height='50' ></td>";
		if(isset($_SESSION["employeeid"]))
		{
			echo "<td>$rs[advertisername]</td>";
		}
		echo "<td><b>$rs[advttitle]</b></td>
			<td>$rs[advttype] <br> <b>CPC</b> - ₹$rs[cpc] </td>
			<td>$rs[status]</td>
			<td><a href='add_webads.php?editid=$rs[0]' class='btn  btn-info' style='width: 70px;' >Edit</a> <br> <a href='view_webads.php?delid=$rs[0]' onclick='return confirmdelete()' style='width: 70px;' class='btn btn-danger'>Delete</a></td>
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