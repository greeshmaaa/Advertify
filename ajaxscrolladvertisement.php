<?php
include("dbconnect.php");
$sql=  "SELECT * FROM scrolleradvt where scrolleradvtid='$_GET[advtid]'";
$qsql = mysqli_query($con,$sql);
$rs  = mysqli_fetch_array($qsql)
?>
<br>
<form method="post" action="">
<input type="hidden" name="advtid" value="<?php echo $_GET['advtid']; ?>" readonly>
<input type="hidden" name="advtduration" value="15" readonly>
Advertisement title
<input type="text" class="form-control" name="advttitle" value="<?php echo $rs['advttitle']; ?>" readonly>
<br>
<section class="sidebar">
	<div style="background-color:#ece9e9; padding:5px;">		
		Advertisement text <textarea name="advtdescription" class="form-control" onchange="loadscrollpreview(this.value)" onkeyup="countwords(this.value)" readonly ><?php echo $rs['advtdescription']; ?></textarea>
		Number of words: <span id="divcountwords"><?php echo str_word_count($rs['advtdescription']); ?></span>
	</div>
</section>
Advertisement cost / word
<input type="text" name="advtcost" id="advtcost" class="form-control" value="<?php echo $_GET['advtcost']; ?>" readonly>
<?php
$totaltime = 15;
?>

No. of words
<input type="number" min="1" max="100" name="no_of_words" id="no_of_words" value="<?php echo str_word_count($rs['advtdescription']); ?>" class="form-control" onkeyup="calculatetotal()" onchange="calculatetotal()" readonly  >

Total cost
<input type="text" name="tvideoadvtcost" id="tvideoadvtcost" class="form-control" value="<?php echo str_word_count($rs['advtdescription'])*$_GET['advtcost']; ?>"  readonly>

No. of Times
<input type="number" min="1" name="no_of_times" id="no_of_times" value="1" class="form-control" onchange="changetotalcost(tvideoadvtcost.value,no_of_times.value)" onkeyup="changetotalcost(tvideoadvtcost.value,no_of_times.value)">

Total cost
<input type="text" name="videoadvtcost" id="videoadvtcost" class="form-control" value="<?php echo str_word_count($rs['advtdescription'])*$_GET['advtcost']; ?>" readonly>

<br>

<input type="submit" name="submit" value="Submit This advertisement" class="btn mag-btn mt-30" >
</form>
<br>