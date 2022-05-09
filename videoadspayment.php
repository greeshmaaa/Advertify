<?php 
include("header.php");
$sqladsprogram=  "SELECT * FROM adsprogram where adsprogramid='$_GET[adsprogramid]'";
$qsqladsprogram = mysqli_query($con,$sqladsprogram);
$rsadsprogram  = mysqli_fetch_array($qsqladsprogram);

$sqlvideoads=  "SELECT * FROM videoads where videoaddid='$rsadsprogram[videoadvtid]'";
$qsqlvideoads = mysqli_query($con,$sqlvideoads);
$rsvideoads  = mysqli_fetch_array($qsqlvideoads);

$sqltvprogram = "SELECT * FROM tvprogram where tvprogramid='$rsadsprogram[tvprogramid]'";
$qsqltvprogram = mysqli_query($con,$sqltvprogram);
$rstvprogram  = mysqli_fetch_array($qsqltvprogram);

$sqledit = "SELECT * FROM payment WHERE paymentid='$_GET[editid]'";
$qsqledit = mysqli_query($con,$sqledit);
echo mysqli_error($con);
$rsedit = mysqli_fetch_array($qsqledit);

include_once('getID3-1.9.15/getid3/getid3.php');
$getID3 = new getID3;
$filename = "videoads/$rsvideoads[Videoadvt]";
$file = $getID3->analyze($filename);
$videoduration ="00:".$file['playtime_string'];
$min = date("i",strtotime($videoduration));
$sec = date("s",strtotime($videoduration));
$sec = ($min * 60) + $sec;
$totalsec = $sec;
//$videoduration = ("Duration: ".$file['playtime_string']." / Dimensions: ".$file['video']['resolution_x']." wide by ".$file['video']['resolution_y']." tall"." / Filesize: ".$file['filesize']." bytes<br />");

if(isset($_POST[submit]))
{
	$sqladsprogram= "UPDATE adsprogram SET status='Active' WHERE adsprogramid='$_GET[adsprogramid]'";
	 mysqli_query($con,$sqladsprogram);

	 
	$sql="INSERT INTO `payment`(`advertiserid`, `paymenttype`, `paidamt`, `cgst`, `sgst`, `paymentdate`, `note`, `status`, `transaction_type`) VALUES ('$_SESSION[advertiserid]','$_POST[paymenttype]','$_POST[videoadvtcost]','$_POST[cgst]','$_POST[sgst]','$dt','Card holder - $_POST[cardholder] | Card No. -  $_POST[cardno] | Expiry date - $_POST[expdate] | CVV No. $_POST[cvvno]','Active','VideoAdvertisement')";	
	$qsql = mysqli_query($con,$sql);
	echo mysqli_Error($con);
	if(mysqli_affected_rows($con) == 1)
	{			
		echo "<SCRIPT>alert('Payment done successfully...');</SCRIPT>";
		$insid = mysqli_insert_id($con); 
		
		echo $sqladvtorder = "INSERT INTO advtorder(paymentid, tvprogramid, advertiserid,  videoadid,  fdate,  cost, costperclick, note, status) VALUES ('$insid','$rsadsprogram[tvprogramid]','$_SESSION[advertiserid]','$rsadsprogram[videoadvtid]','$dt','$_POST[videoadvtcost]','0','$_POST[note]','Active')";
		$qsql = mysqli_query($con,$sqladvtorder);
		echo mysqli_error($con);
	
		echo "<script>window.location='bill.php?billid=$insid';</script>";
	}
}
//Step 2 - Update : Select record from database 
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM payment WHERE paymentid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	echo mysqli_error($con);
	echo $rsedit[title];
}
//Step 2 - Update : Select record from database ends here

?>

	<!-- Main -->
		<div id="page">
				
			<!-- Main -->
			<div class="container">
				<div class="row">
<div class="col-md-12 skel-cell-important">
	<header>
		<h3>Make payment for VIDEO ADS	</h3>
	</header>
	<form method="post" action="" name="frmwebadspayment" onsubmit="return validateform()">
</div>
				<div class="col-md-5 skel-cell-important">
				<?php
$totaltime = $totalsec;
?>
<input type="hidden" name="advtduration" value="<?php echo $totalsec; ?>" readonly>
Advertisement title
<input type="text" class="form-control" name="advttitle" value="<?php echo $rsvideoads[Advttitle]; ?>" readonly>

Advertisement cost
<input type="text" name="advtcost" id="advtcost" class="form-control" value="<?php echo $rstvprogram[videoadvtcost]; ?>" readonly>

Advertisement Duration
<input type="hidden" name="totaltime" id="totaltime" class="form-control" value="<?php echo $totaltime; ?>" readonly>
<input type="text" class="form-control" value="<?php echo $videoduration; ?> seconds" readonly>

No. of Times
<input type="number" min="1" max="100" name="no_of_times" id="no_of_times" value="<?php echo $rsadsprogram[no_of_times]; ?>" class="form-control" readonly >

Total cost
<input type="text" name="videoadvtcost" id="videoadvtcost" class="form-control" value="<?php echo $totvideoadvtcost = $totaltime* $rsadsprogram[no_of_times]*$rstvprogram[videoadvtcost]; ?>" readonly>
<br>				
		CGST
		(<?php
		 $sqltax = "SELECT * FROM tax WHERE taxtype='CGST'";
		$qsqltax = mysqli_query($con,$sqltax);
		$rstax = mysqli_fetch_array($qsqltax);
		echo $cgst = $rstax[taxamt];
	?>%)
		<input type='hidden' name='cgst' id='cgst' value='<?php echo $cgst; ?>' >
		<input type="text" class="form-control" name="cgstamt"  value="<?php echo $totcgst = $totvideoadvtcost*$cgst/100; ?>" id="cgstamt" readonly >
		SGST
		(<?php
		 $sqltax = "SELECT * FROM tax WHERE taxtype='SGST'";
		$qsqltax = mysqli_query($con,$sqltax);
		$rstax = mysqli_fetch_array($qsqltax);
		echo $sgst = $rstax[taxamt];
	?>%)
		<input type='hidden' name='sgst' id='sgst' value='<?php echo $sgst; ?>' >
		
		<input type="text" class="form-control" name="sgstamt" value="<?php echo  $totsgst = $totvideoadvtcost*$sgst/100; ?>" id="sgstamt" readonly >
				
		Total Tax amount<input type="text" class="form-control" name="tottaxamt" id="tottaxamt" readonly value="<?php echo $tottaxamt = $totcgst + $totsgst; ?>" >		
		<hr>



				</div>
					<div class="col-md-5 skel-cell-important">
						<section>
	
		Grand Total<input type="text" class="form-control" name="grandtotal" id="grandtotal" readonly value="<?php echo $tottaxamt + $totvideoadvtcost; ?>" >	<br>
		Payment type 
		<select name="paymenttype" id="paymenttype" class="form-control">
			<option value=''>Select</option>
			<?php
				$arr = array("Debit card","Credit card");
				foreach($arr as $val)
				{
					if($val == $rsedit[paymenttype])
					{
					echo "<option value='$val' selected>$val</option>";
					}
					else
					{
					echo "<option value='$val'>$val</option>";
					}
				}
			?>
		</select>
		Card Holder<input type="text" class="form-control" name="cardholder" id="cardholder" value="<?php echo $rsedit[cardholder]; ?>"  >
		
		Card Number<input type="text" class="form-control" name="cardno" id="cardno" value="<?php echo $rsedit[cardno]; ?>"  >
		
		Expiry Date <input type="month" class="form-control" name="expdate" id="expdate" value="<?php echo $rsedit[expdate]; ?>" min="<?php echo date("Y-m"); ?>"  >
		
		CVV Number<input type="text" class="form-control" name="cvvno" id="cvvno"  value="<?php echo $rsedit[cvvno]; ?>"  >
		
		
		Any Note or Request
		<textarea name="note" class="form-control" ></textarea>
<br>
		<input type="submit" value="Make payment" name="submit" class="btn mag-btn mt-30" >
							</form>
						</section>
					</div>
					
				<div class="col-md-1 skel-cell-important">
				</div>
				</div>
			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

	<?php include("footer.php");
	?>
	<script>
	function calculatetax(paidamt,cgst,sgst,igst)
	{
		document.getElementById("cgstamt").value = paidamt * cgst / 100;
		document.getElementById("sgstamt").value = paidamt * sgst / 100;
		
		document.getElementById("tottaxamt").value = paidamt * cgst / 100 + paidamt * sgst / 100;
		
		document.getElementById("grandtotal").value = parseFloat(paidamt) + paidamt * cgst / 100 + paidamt *sgst / 100 ;
		
	}
	</script>
	<script >
function validateform()
{
	if(document.getElementById("paymenttype").value=="")
	{
		alert('Payment Type  should not be empty...');
		return false;
	}
	else if(document.getElementById("cardholder").value=="")
	{
		alert('Card Holder should not be empty...');
		return false;
	}
	else if(document.getElementById("cardno").value=="")
	{
		alert('Card Number should not be empty...');
		return false;
	}
	else if(document.getElementById("cardno").value.length!=16)
	{
		alert('Card Number should contain 16 digits...');
		return false;
	}
	else if(document.getElementById("expdate").value=="")
	{
		alert('Expiry Date should not be empty...');
		return false;
	}
	else if(document.getElementById("cvvno").value=="")
	{
		alert('Card Vertification Value Number should not be empty...');
		return false;
	}
	else if(document.getElementById("cvvno").value.length!=3)
	{
		alert('Card Vertification Value Number(ccv) should contain 3 digits...');
		return false;
	}
	else if(document.getElementById("paidamt").value=="")
	{
		alert('Paid Amount should not be empty...');
		return false;
	}
	else
	{
		return true;
	}
}
</script>