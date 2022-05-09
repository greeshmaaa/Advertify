<?php
include "header.php";
?>
<?php
	
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		//Update statement starts here
		$sql = "UPDATE payment SET advertiserid='$_POST[advertiserid]',paymenttype='$_POST[paymenttype]',paidamt='$_POST[paidamt]',cgst='$_POST[cgst]',sgst='$_POST[sgst]',igst='$_POST[igst]',paymentdate='$_POST[paymentdate]',note='$_POST[note]',status='$_POST[status]' WHERE paymentid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('payment record updated successfully..');</script>";
			echo "<script>window.location='viewpayment.php';</script>";
		}
		//Update statement ends here
	}
	else
	{	
 	     
		$sql = "INSERT INTO `payment`(`advertiserid`, `paymenttype`, `paidamt`, `cgst`, `sgst`,`paymentdate`, `note`, `status`,`transaction_type`) VALUES ('$_SESSION[advertiserid]','$_POST[paymenttype]','$_POST[paidamt]','$_POST[cgst]','$_POST[sgst]','$dt','Paymment Type - $_POST[paymenttype] <br>Card holder - $_POST[cardholder] <br> Card Number - $_POST[cardno] <br> CVV No. - $_POST[cvvno] <br>Expiry Date $_POST[cardexpires]','Active','WebAds')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Payment done successfully..');</script>";
			echo "<script>window.location='webadspayment.php';</script>";
		}
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM  payment WHERE paymentid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<style>
.errmsg{
	color:Tomato;
}
</style>
<section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/40.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Web Ads</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    <!-- Video Submit Content -->
                    <div class="video-submit-content mb-50 p-30 bg-white box-shadow">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h5>Submit your Web Ads</h5>
                        </div>

                        <div class="video-info mt-30">
                            <form action="#" method="post" name="frmform" enctype="multipart/form-data" onsubmit="return validateform()">
							<div class="form-group">
							
                                    <label for="upload-file">How much amount Do you Pay?</label><span id="idpaidamt" class="errmsg"></span>
<input type="text" value="<?php echo $rsedit[paidamt]; ?>" name="paidamt" id="paidamt" placeholder="Payable Amount" onkeyup="calculatetax(this.value)" class="form-control">
                                </div>
                                <div class="form-group">
							
                                    <label for="upload-file">CGST (5%):</label>	<span class="errmsg" id="idadvtimg"></span>
                                    <input type="text" value="<?php echo $rsedit[cgst]; ?>" name="cgst" id="cgst" placeholder="CGST" readonly style="background-color:#fff;" class="form-control">
                                </div>
                                
                                <div class="form-group">
								
                                    <label for="upload-file">SGST (5%):</label><span class="errmsg" id="idadvtdescription"></span>
                   <input type="text" value="<?php echo $rsedit[sgst]; ?>" name="sgst" id="sgst" placeholder="SGST" readonly style="background-color:#fff;" class="form-control">  </div>
                                <div class="form-group">
								
                                    <label for="upload-file">Total Amount:</label><span class="errmsg" id="idadvtemail"></span>
<input type="text" name="totamt" id="totamt" placeholder="Total Amount" readonly style="background-color:#fff;" class="form-control">
		 
                                </div>
								<hr>	
<b>Payment Detail:	</b>
								  <div class="form-group">
								  
                                    <label for="upload-file">Payment type:</label>
<span id="idpaymenttype" class="errmsg"></span>
			<select  name="paymenttype" class="form-control" >
				<option value="">Select Payment type:</option>
				<?php
				$arr = array("Credit card","Debit Card","Digital wallet");
				foreach($arr as $val)
				{
				if($val == $rsedit[note])
				{
					echo "<option selected value='$val'>$val</option>";
				}
				else
				{
					echo "<option value='$val'>$val</option>";
				}
				}
			  ?>
			</select>
                                </div>
								 <div class="form-group">
								
                                    <label for="upload-file">Card Holder:</label><span id="idcardholder" class="errmsg"></span>
                                   <input type="text" name="cardholder" placeholder="Card Holder" class="form-control">
                                </div>
                                <div class="form-group">
								
                                    <label for="upload-file">Card No:</label><span id="idcardno" class="errmsg"></span>
                                   	<input type="text"  name="cardno" placeholder="Card No" class="form-control">
                                </div>
                               <div class="form-group">
							   
                                    <label for="upload-file">CVV No:</label><span id="idcvvno" class="errmsg"></span>
                                    <input type="text"  name="cvvno" placeholder="CVV No" class="form-control" pattern="^[0-9]{3}" required="">
                                </div>
								<div class="form-group">

                                    <label for="upload-file">Card Expires on:</label><span id="idcardexpires" class="errmsg"></span>
                                   <input type="month" name="cardexpires" placeholder="Expiry Date" class="form-control"></div>
                                <input type="submit" name="submit" value="Make payment" class="btn mag-btn mt-30">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>
 <script>
 function calculatetax(totalpayable)
 {
	 //sgst cgst paidamt totamt
	 document.getElementById("sgst").value =(parseFloat(totalpayable) * 5) / 100;
	 document.getElementById("cgst").value =(parseFloat(totalpayable) * 5) / 100;
	 document.getElementById("totamt").value =((parseFloat(totalpayable) * 5) / 100) + ((parseFloat(totalpayable) * 5) / 100) + parseFloat(totalpayable);
	 
 }
 </script>
<script>
 function validateform()
 {	
	//validation part
	
	 var checkcondition = "true";
	 if(document.frmform.paidamt.value=="")
	 {
		 document.getElementById("idpaidamt").innerHTML = "Amount should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmform.paymenttype.value=="")
	 {
		 document.getElementById("idpaymenttype").innerHTML = "Payment type should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmform.cardholder.value=="")
	 {
		 document.getElementById("idcardholder").innerHTML = "Card holder name should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmform.cardno.value=="")
	 {
		 document.getElementById("idcardno").innerHTML = "Card number should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmform.cvvno.value=="")
	 {
		 document.getElementById("idcvvno").innerHTML = "CVV Number should not be empty..";
		 checkcondition = "false";
	 }
	 if(document.frmform.cardexpires.value=="")
	 {
		 document.getElementById("idcardexpires").innerHTML = "Mension the Expiry date";
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