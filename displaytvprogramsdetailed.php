<?php 
include("header.php");
$sqltvprogram = "SELECT * FROM tvprogram where tvprogram.status='Active' AND tvprogramid='$_GET[tvprogramid]'";
$qsqltvprogram = mysqli_query($con,$sqltvprogram);
$rstvprogram = mysqli_fetch_array($qsqltvprogram);
if(file_exists("imgtvprogram/".$rstvprogram[img]))
{
	$imgname = "imgtvprogram/".$rstvprogram[img];
}
else
{
	$imgname = "images/noimage.png";
}

if(isset($_POST[submit]))
{
	include "dbconnect.php";
	$sql="INSERT INTO adsprogram(videoadvtid,tvprogramid,no_of_times,status)VALUES('$_POST[videoaddid]','$_GET[tvprogramid]','$_POST[no_of_times]','Pending')";
	$qsql = mysqli_query($con,$sql);
	$insid = mysqli_insert_id($con);
	echo mysqli_error($con);
	echo "<script>window.location='videoadspayment.php?adsprogramid=$insid';</script>";
}
/* */  ?>
 
  

 <!-- Cart view section -->
  <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/49.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>CheckOut</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="" method="post">
            <div class="row">
			
	
			
              <div class="col-md-7">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">

<!-- Billing Details -->
<div class="panel panel-default aa-checkout-billaddress">
  <div class="panel-heading">
	<h4 class="panel-title">
	  <a  data-parent="#accordion" >
		Advertisement:
	  </a>
	</h4>
  </div>
  <div id="collapseThree">
	<div class="panel-body">
	 
	 
	 			<!-- Main -->
			<div  class="container">
				<div class="row">

<div class="col-md-7">
	<section>
		<header>
			<h2><?php echo $rstvprogram[title]; /* */  ?></h2>
			<span class="byline"><?php echo $rstvprogram[programtype]; /* */  ?></span>
			<span class="byline"><b>Advertisement Cost:</b> <?php echo "Rs.".$rstvprogram[videoadvtcost]; /* */  ?> / Sec</span>
		</header>
		<header>
			<span class="byline">
			<?php 
			if($rstvprogram[programtype] == "LiveProgram")
			{
echo "Scheduled on " . $rstvprogram[programday] . " @ " . date("h:i A",strtotime($rstvprogram[ftime])) . " - " .  date("h:i A",strtotime($rstvprogram[ttime]));
			}
			if($rstvprogram[programtype] == "TVprogram")
			{
			echo $rstvprogram[programtype]; 
			}
			/* */  ?>
			</span>
		</header>
		<p>
		<img src="<?php echo $imgname; /* */  ?>" style="width:100%;height:300px;">
		<?php echo $rstvprogram[description]; /* */  ?></p>
	</section>
</div>	
			
<div class="col-md-5">
	<section>
		<header>
			<h2>Select advertisement</h2>
		</header>
		<p>
		<form method="post" action="">
			<select name="videoaddid" onchange="loadvideo(this.value)" class="form-control">
				<option value=''>Select</option>
	<?php
	$sql = "SELECT * FROM videoads LEFT JOIN advertiser ON videoads.advertiserid = advertiser.advertiserid WHERE videoads.videoaddid != '0' ";
	if(isset($_SESSION[advertiserid]))
	{
		$sql = $sql . " AND videoads.advertiserid='$_SESSION[advertiserid]'";
	}
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<option value='$rs[videoaddid]'>$rs[Advttitle]</option>";
	}
	/* */  ?>
			</select>
			<div id="idadvertisement"></div>
		</form>
		</p>
	</section>
</div>
					
				</div>
			</div>
			<!-- Main -->
	
	</div>
  </div>
</div>
                   
				   </div>
                </div>
              </div>
             </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 
 <!-- / Cart view section -->

 <?php
 include("footer.php");
 ?>
<script>
function loadvideo(advtid)
{
    if (advtid == "") 
	{
        document.getElementById("idadvertisement").innerHTML = "";
        return;
    } 
	else 
	{ 
        if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("idadvertisement").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxadvertisement.php?advtid="+advtid+"&advtcost=<?php echo $rstvprogram[videoadvtcost]; /* */  ?>",true);
        xmlhttp.send();
    }
}

function calculatetotal()
{
	document.getElementById("videoadvtcost").value = (document.getElementById("totaltime").value * document.getElementById("no_of_times").value) * (document.getElementById("advtcost").value) ;
}

</script>