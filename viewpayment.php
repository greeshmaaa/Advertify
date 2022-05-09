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
                            <li class="breadcrumb-item active" aria-current="page">PAYMENT</li>
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
                            <h5>VIEW PAYMENT</h5>
                        </div>
				<table id="myTable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Advertiser</th>
			<th>Payment Date</th>
			<th>Particulars</th>
			<th>Paid Amount</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT payment.*,advertiser.*  FROM payment LEFT JOIN advertiser ON payment.advertiserid=advertiser.advertiserid WHERE payment.status!=''";
	if(isset($_GET[paidfor]))
	{
		$sql = $sql . " AND payment.paymenttype='$_GET[paidfor]'";
	}
	if(isset($_SESSION[advertiserid]))
	{
		$sql = $sql . " AND payment.advertiserid='" . $_SESSION[advertiserid] . "' ";
	}
	//echo $sql;
	//paymenttype
	$totcollection = 0;
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		
		$cgst = $rs[cgst];
		$sgst = $rs[sgst];
		$gtotal = $rs[paidamt] + ($cgst + $sgst);
		 $totcollection = $totcollection +  $gtotal ;
		echo "	<tr>
			<td>$rs[advertisername]</td>
			<td>$rs[paymentdate]</td>";
			
			if($rs[transaction_type]==''){ ?> 
				<td>WebAdvertisement</td>
			<?php }else{ ?>				
				<td><?php echo $rs[transaction_type];?></td>
		<?php	} 
		echo"	<td>Total  - ₹$rs[paidamt]<br>CGST - ₹$cgst<br>SGST - ₹$sgst <br><b>Grand Total - ₹$gtotal</b></td>
		</tr>";
	}
	?> 
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th></th>
			<th>Grand Total</th>
			<th> ₹<?php echo $totcollection; ?></th>
		</tr>
	</tfoot>
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