<?php
session_start();
error_reporting(0);
include("dbconnect.php");
$sql=  "SELECT * FROM videoads where videoaddid='$_GET[advtid]'";
$qsql = mysqli_query($con,$sql);
$rs  = mysqli_fetch_array($qsql);

include_once('getID3-1.9.15/getid3/getid3.php');
$getID3 = new getID3;
$filename = "videoads/$rs[Videoadvt]";
$file = $getID3->analyze($filename);
$videoduration ="00:".$file['playtime_string'];
$min = date("i",strtotime($videoduration));
$sec = date("s",strtotime($videoduration));
$sec = ($min * 60) + $sec;
$totalsec = $sec;
//$videoduration = ("Duration: ".$file['playtime_string']." / Dimensions: ".$file['video']['resolution_x']." wide by ".$file['video']['resolution_y']." tall"." / Filesize: ".$file['filesize']." bytes<br />");
?>
<br>
<form method="post" action="">
<input type="hidden" name="advtid" value="<?php echo $_GET[advtid]; ?>" readonly>
<input type="hidden" name="advtduration" value="15" readonly>
Advertisement title
<input type="text" class="form-control" name="advttitle" value="<?php echo $rs[Advttitle]; ?>" readonly>
<br>
Advertisement Preview
<video controls="" autoplay="" name="media" style="width:100%;"><source src="videoads/<?php echo $rs[Videoadvt]; ?>" type="video/mp4"></video>
<br>
Advertisement cost/sec
<input type="text" name="advtcost" id="advtcost" class="form-control" value="<?php echo $_GET[advtcost]; ?>" readonly>
<?php
$totaltime = 15;
?>
Advertisement Duration
<input type="hidden" name="totaltime" id="totaltime" class="form-control" value="<?php echo $totalsec; ?>" readonly>
<input type="text" class="form-control" value="<?php echo $videoduration; ?> seconds" readonly>
<br>

No. of Times
<input type="number" min="1" max="100" name="no_of_times" id="no_of_times" value="1" class="form-control" onkeyup="calculatetotal()" onchange="calculatetotal()" >

Total cost
<input type="text" name="videoadvtcost" id="videoadvtcost" class="form-control" value="<?php echo $totalsec*$_GET[advtcost]; ?>" readonly>
<br>
<input type="submit" name="submit" value="Submit This advertisement" class="form-control btn mag-btn mt-30" >
</form>
<br>