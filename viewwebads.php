<?php
include "header.php";
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
				<th>Adverister</th>
			<th>WebAds Title</th>
			
			<th>WebAds Description</th>
			<th>WebAds Email</th>
			<th>Web-Ads WWW</th>
			<th>Web-Ads Address</th>
			<th>Web-Ads Type</th>
			
				</tr>
				</thead>
				<tbody>
				<?php
	$sql= "SELECT a.*,b.* FROM webads a LEFT JOIN advertiser b ON a.advertiserid=b.advertiserid";
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
		?>
		<tr>
			<td><img src="<?php echo $imgname;?>" width='75' height='50' ></td>
		<td><?php echo $rs['advertisername'];?></td>
				<td><?php echo $rs['advttitle'];?></td>
				
				<td><?php echo $rs['advtdescription'];?></td>
				<td><?php echo $rs['advtemail'];?></td>
			
				<td><?php echo $rs['advtwww'];?></td>
				<td><?php echo $rs['advtaddress'];?></td>
				<td><?php echo $rs['advttype'];?></td>
				
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