<?php
include("header.php");
$sqladsprogram=  "SELECT * FROM adsprogram where adsprogramid='$_GET[adsprogramid]'";
$qsqladsprogram = mysqli_query($con,$sqladsprogram);
$rsadsprogram  = mysqli_fetch_array($qsqladsprogram);

$sqlvideoads=  "SELECT * FROM scrolleradvt where scrolleradvtid='$rsadsprogram[scrolleradvtid]'";
$qsqlvideoads = mysqli_query($con,$sqlvideoads);
$rsvideoads  = mysqli_fetch_array($qsqlvideoads);

$sqltvprogram = "SELECT * FROM tvprogram where tvprogramid='$rsadsprogram[tvprogramid]'";
$qsqltvprogram = mysqli_query($con,$sqltvprogram);
$rstvprogram  = mysqli_fetch_array($qsqltvprogram);

$sqledit = "SELECT * FROM payment WHERE paymentid='$_GET[editid]'";
$qsqledit = mysqli_query($con,$sqledit);
echo mysqli_error($con);
$rsedit = mysqli_fetch_array($qsqledit);
?>
<form method="post" action="" name="frmwebadspayment" onsubmit="return validateform()">
</div>
				<div class="col-md-6 skel-cell-important">
<input type="hidden" name="advtduration" value="15" readonly>
Advertisement title <span id="advttitle" class="errmsg"></span>
<input type="text" class="form-control"  id="advttitle" name="advttitle" value="<?php echo $rsvideoads[advttitle]; /* */  ?>" readonly>

TV Program <span id="programtype" class="errmsg"></span>
<input type="text" class="form-control" name="programtype"  value="<?php echo $rstvprogram[title];  ?> (<?php echo $rstvprogram[programtype];  ?>)" readonly>

Scroll Advertisement cost(Per Word) <span id="advtcost" class="errmsg"></span>
<input type="text" name="advtcost" class="form-control" value="<?php echo $rstvprogram[scrolladvtcost]; /* */  ?>" readonly>
<?php
$totaltime = 15;
/* */  ?>
<?php
/*
Advertisement Duration
<input type="hidden" name="totaltime" id="totaltime" class="form-control" value="<?php echo $totaltime;   ?>" readonly>
<input type="text" class="form-control" value="15 seconds" readonly>
*/
?>

Number of Words <span id="no_of_words" class="errmsg"></span>
<input type="number" min="1" max="100" name="no_of_words"  value="<?php echo str_word_count($rsvideoads[advtdescription]); ?>" class="form-control" readonly  >


Sub Total <span id="subtotal" class="errmsg"></span>
<input type="number" min="1" max="100" name="subtotal"  value="<?php echo str_word_count($rsvideoads[advtdescription])*$rstvprogram[scrolladvtcost]; ?>" class="form-control" readonly  >

No. of times <span id="no_of_times" class="errmsg"></span>
<input type="number" min="1" max="100" name="no_of_times"  value="<?php echo $rsadsprogram[no_of_times]; /* */  ?>" class="form-control" readonly >

Total cost <span id="videoadvtcost" class="errmsg"></span>
<input type="text" name="videoadvtcost"  class="form-control" value="<?php echo $totvideoadvtcost = (str_word_count($rsvideoads[advtdescription])*$rstvprogram[scrolladvtcost]) * $rsadsprogram[no_of_times];  ?>" readonly>
<br>				
		CGST
		(<?php
		 $sqltax = "SELECT * FROM tax WHERE taxtype='CGST'";
		$qsqltax = mysqli_query($con,$sqltax);
		$rstax = mysqli_fetch_array($qsqltax);
		echo $cgst = $rstax[taxamt];
	/* */  ?>%)
		<input type='hidden' name='cgst' id='cgst' value='<?php echo $cgst; /* */  ?>' >
		<input type="text" class="form-control" name="cgstamt"  value="<?php echo $totcgst = $totvideoadvtcost*$cgst/100; /* */  ?>" id="cgstamt" readonly >
		SGST
		(<?php
		 $sqltax = "SELECT * FROM tax WHERE taxtype='SGST'";
		$qsqltax = mysqli_query($con,$sqltax);
		$rstax = mysqli_fetch_array($qsqltax);
		echo $sgst = $rstax[taxamt];
	/* */  ?>%)
		<input type='hidden' name='sgst' id='sgst' value='<?php echo $sgst; /* */  ?>' >
		
		<input type="text" class="form-control" name="sgstamt" value="<?php echo  $totsgst = $totvideoadvtcost*$sgst/100; /* */  ?>" id="sgstamt" readonly >
				
		Total Tax amount <span id="tottaxamt" class="errmsg"></span><input type="text" class="form-control" name="tottaxamt"  readonly value="<?php echo $tottaxamt = $totcgst + $totsgst; /* */  ?>" >		
		<hr>



				</div>
					<div class="col-md-6 skel-cell-important">
						<section>
	
		Grand Total <span id="grandtotal" class="errmsg"></span><input type="text" class="form-control" name="grandtotal" id="grandtotal" readonly value="<?php echo $tottaxamt + $totvideoadvtcost; /* */  ?>" >	<br>
		Payment type <span id="idpaymenttype" class="errmsg"></span>
		<select name="paymenttype" id="paymenttype" class="form-control">
			<option value=''>Select</option>
			<?php
				$arr = array("Credit card","Debit Card","Digital wallet");
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
			/* */  ?>
		</select>
		Card Holder<span id="idcardholder" class="errmsg"></span><input type="text" class="form-control" name="cardholder" id="cardholder" value="<?php echo $rsedit[cardholder]; /* */  ?>"  >
		
		Card Number <span id="idcardno" class="errmsg"></span><input type="text" class="form-control" name="cardno" id="cardno" value="<?php echo $rsedit[cardno]; /* */  ?>"  >
		
		Expiry Date <span id="idexpdate" class="errmsg"></span><input type="month" class="form-control" name="expdate" id="expdate" value="<?php echo $rsedit[expdate]; /* */  ?>" min="<?php echo date("Y-m"); /* */  ?>"  >
		
		CVV Number <span id="idcvvno" class="errmsg"></span><input type="text" class="form-control" name="cvvno" id="cvvno" value="<?php echo $rsedit[cvvno]; /* */  ?>"  >
		
		
		Any Note or Request<span id="idnote" class="errmsg"></span>
		<textarea name="note" class="form-control" ></textarea>
<br>
		<input type="submit" value="Make payment" name="submit" class="form-control" >
							</form>
							<script >
function validateform()
{
	 var checkcondition = "true";
	 if(document.frmwebadspayment.paymenttype.value=="")
	 {
		 document.getElementById("idpaymenttype").innerHTML = "Payment type should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.cardholder.value=="")
	 {
		 document.getElementById("idcardholder").innerHTML = "Card holder name should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.cardno.value=="")
	 {
		 document.getElementById("idcardno").innerHTML = "Card number should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.cvvno.value=="")
	 {
		 document.getElementById("idcvvno").innerHTML = "CVV Number should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.expdate.value=="")
	 {
		 document.getElementById("idexpdate").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	  if(document.frmwebadspayment.note.value=="")
	 {
		 document.getElementById("idnote").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.advttitle.value=="")
	 {
		 document.getElementById("advttitle").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.programtype.value=="")
	 {
		 document.getElementById("programtype").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.advtcost.value=="")
	 {
		 document.getElementById("advtcost").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.no_of_words.value=="")
	 {
		 document.getElementById("no_of_words").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.subtotal.value=="")
	 {
		 document.getElementById("subtotal").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.no_of_times.value=="")
	 {
		 document.getElementById("no_of_times").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(document.frmwebadspayment.videoadvtcost.value=="")
	 {
		 document.getElementById("videoadvtcost").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	  if(document.frmwebadspayment.tottaxamt.value=="")
	 {
		 document.getElementById("tottaxamt").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	   if(document.frmwebadspayment.grandtotal.value=="")
	 {
		 document.getElementById("grandtotal").innerHTML = "Mension the Expiry date";
		 checkcondition = "false";
	 }
	 if(checkcondition == "true")
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
 
}
</script>
							<?php include("footer.php");?>