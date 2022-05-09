<?php
include "header.php";
if(isset($_GET[delid]))
{
	$sql="DELETE FROM payment WHERE paymentid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('payment record deleted successfully...');</script>";
		echo "<script>window.location='viewpayment.php';</script>";
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
                            <li class="breadcrumb-item active" aria-current="page"> WEB ADS PAYMENT REPORT</li>
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
                            <h5>VIEW WEB ADS PAYMENT REPORT</h5>
                        </div>
				<table id="myTable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			
		</tr>
	</thead>
	<tbody>
	<tr>
	<th>Paid Amount.</th>
	<td>
	<?php
	$sql= "SELECT sum(payment.paidamt) FROM payment LEFT JOIN advertiser ON advertiser.advertiserid=payment.advertiserid WHERE payment.transaction_type='WebAds'";
	if(isset($_SESSION[advertiserid]))
	{
		$sql = $sql . " AND payment.advertiserid='$_SESSION[advertiserid]'";
	}
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	
	  "₹". $totamt = $rs[0];
?>	
₹<?php echo  $totamt ?> </td>	
</td>
			</tr>
			<tr>
				<th>Amount spent for Advertisement</th>
				<td>
<?php
	$sql= "SELECT *,ifnull(sum(payment.paidamt),0) FROM payment LEFT JOIN advertiser ON advertiser.advertiserid=payment.advertiserid LEFT JOIN webads ON  webads.advertiserid=payment.advertiserid";
	if(isset($_SESSION[advertiserid]))
	{
		$sql = $sql . " AND payment.advertiserid='$_SESSION[advertiserid]'";
	}
	
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	//echo $spentamt;
	//echo "₹". $spentamt = $rs[0];
	$csgst=$rs['cgst']+$rs['sgst'];
	echo "₹". $subtotal= $totamt +$csgst;
?>
				</td>
				</tr>
			<tr>
				<th>Balance Amount</th>
				<td>₹<?php echo  $totamt -$subtotal; ?> </td>
			</tr>
	</tbody>
	
</table>
<hr>
<div class="panel-heading">
	<h4 class="panel-title">
	  <a  data-parent="#accordion" >
		VIEW TRANSACTION REPORT
	  </a>
	</h4>
  </div>
  <table id="myTable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Advertiser</th>
			<th>Payment Date</th>
			<th>Paid Amount</th>
			<th>Note</th>
<?php
			if(isset($_SESSION[employeeid]))
			{
?>				
			<th>Action</th>
<?php
			}
?>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT payment.*,advertiser.advertisername FROM payment LEFT JOIN advertiser ON advertiser.advertiserid=payment.advertiserid WHERE payment.transaction_type='WebAds' ";
	if(isset($_SESSION[advertiserid]))
	{
		$sql = $sql . " AND payment.advertiserid='$_SESSION[advertiserid]'";
	}
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[paymentid]</td>
			<td>$rs[advertisername]</td>
			<td> " . date("d-M-Y",strtotime($rs[paymentdate])) . "</td>
			<td><b>Paid:</b> ₹$rs[paidamt]<br><b>CGST:</b> ₹$rs[cgst](5%)<br><b>SGST:</b> ₹$rs[sgst](5%)<br>";
			$total = $rs[paidamt]+ $rs[cgst] +$rs[sgst];
		echo "<label style='color:green;'><b>Total -</b> ₹" . $total . "</label>";
		echo "</td>
			<td>$rs[note]</td>";
			if(isset($_SESSION[employeeid]))
			{
		echo "<td><a href='viewpayment.php?delid=$rs[0]' onclick='return confirmdelete()' class='btn btn-danger'>Delete</a></td>";
			}
		echo "</tr>";
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