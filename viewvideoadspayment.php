<?php
include "header.php";

?>
  <div class="mag-breadcrumb py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">VIDEO ADS PAYMENT REPORT</li>
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
				<table  class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
	<thead>
		<tr>
			<th><b>Total Video Ads published</b></th>
			<td>
			<?php 
			$sql = "SELECT * FROM payment WHERE status='Active' and transaction_type='VideoAdvertisement' ";
			if(isset($_SESSION[advertiserid]))
			{
				$sql = $sql . " AND advertiserid='$_SESSION[advertiserid]'";
			}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql);
			?>
			</td>
		</tr>
		<tr>
			<th><b>Total transaction Amount</b></th>
			<td>
			<?php 
			$sql = "SELECT sum(paidamt) FROM payment WHERE status='Active' and transaction_type='VideoAdvertisement' ";
			if(isset($_SESSION[advertiserid]))
			{
				$sql = $sql . " AND advertiserid='$_SESSION[advertiserid]'";
			}
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	echo "₹".$rs[0];
	$vartotaltransaction= $rs[0];
			?>
			</td>
		</tr>
	</thead>
</table>
<hr>
	<h4 style="color:#d32f2f;">VIEW VIDEO ADS PAYMENT REPORT</h4>
	<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Advertiser</th>
			<th>Video Advertisement</th>
			<th>Payment Date</th>
			<th>Payment Type</th>
			<th>Paid Amount</th>
			<th>CGST</th>
			<th>SGST</th>
			<th>Total Amount</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
		$sql = "SELECT * FROM payment LEFT JOIN advtorder on payment.paymentid=advtorder.paymentid LEFT JOIN videoads ON videoads.videoaddid=advtorder.videoadid   LEFT JOIN advertiser on payment.advertiserid=advertiser.advertiserid   WHERE payment.status='Active' AND  payment.transaction_type='VideoAdvertisement' ";
	if(isset($_SESSION[advertiserid]))
	{
		$sql = $sql . " AND payment.advertiserid='$_SESSION[advertiserid]'";
	}
	$sql  = $sql . " ORDER BY payment.paymentid DESC";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$cgstamt = $rs[cgst]*$rs[paidamt]/100;
		$sgstamt = $rs[cgst]*$rs[paidamt]/100;
		$totalamt = $rs[paidamt]+$cgstamt+$sgstamt;
		echo "<tr>
			<td>$rs[0]</td>
			<td>$rs[advertisername]</td>
			<td>$rs[advttitle]</td>
			<td>" . date("d-M-Y",strtotime($rs[paymentdate])) . " </td>
			<td>$rs[paymenttype]</td>
			<td>₹$rs[paidamt]</td>
			<td>₹$cgstamt<br>($rs[cgst]%)</td>
			<td>₹$sgstamt<br>($rs[sgst]%)</td>
			<td>₹$totalamt  </td>
			<td><A href='bill.php?billid=$rs[paymentid]'>View</a></td>
		</tr>";
	}
	?>		
	</tbody>
</table>
<?php 
	include("datatable.php");
	
	?>

				</div>
				</div>
				</div>
				</div>
				<?php
				include("footer.php");
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