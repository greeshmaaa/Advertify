<?php
include("header.php");
?>

  <!-- / catg header banner section -->

 <!-- Cart view section -->
  <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/49.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>TV Programs</h2>
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
			
	
			
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">

<!-- Main -->
	

				
			<!-- Extra -->
			<div id="marketing" class="container">
				<div class="row">
				
<?php
$sqltvprogram = "SELECT * FROM tvprogram where tvprogram.status='Active' AND programtype='Reality show'";
$qsqltvprogram = mysqli_query($con,$sqltvprogram);
while($rstvprogram = mysqli_fetch_array($qsqltvprogram))	
{
		if(file_exists("imgtvprogram/".$rstvprogram[img]))
		{
			$imgname = "imgtvprogram/".$rstvprogram[img];
		}
		else
		{
			$imgname = "images/noimage.png";
		}
/* */  ?>				
	<div class="col-md-3">
		<section>
			<p><a href="displayscrollerprogramdetailed.php?tvprogramid=<?php echo $rstvprogram[0]; /* */  ?>"><img src="<?php echo $imgname; /* */  ?>" style="width:100%;height:150px;" ></a></p>	
			<h6><?php echo $rstvprogram[title]; /* */  ?></h6>			
			<p class="subtitle">Scheduled on <?php echo $rstvprogram[programday]; /* */  ?> @ <?php echo date("h:i A",strtotime($rstvprogram[ftime])); /* */  ?>-<?php echo date("h:i \P\M",strtotime($rstvprogram[ttime])); /* */  ?></p>
			<a href="displayscrollerprogramdetailed.php?tvprogramid=<?php echo $rstvprogram[0]; /* */  ?>" class="button">Select</a>
			<hr>
		</section>
	</div>
<?php
}
/* */  ?>	
				</div>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
				<div class="row">
				
<?php
$sqltvprogram = "SELECT * FROM tvprogram where tvprogram.status='Active' AND programtype<>'Reality show'";
$qsqltvprogram = mysqli_query($con,$sqltvprogram);
while($rstvprogram = mysqli_fetch_array($qsqltvprogram))	
{
		if(file_exists("imgtvprogram/".$rstvprogram[img]))
		{
			$imgname = "imgtvprogram/".$rstvprogram[img];
		}
		else
		{
			$imgname = "images/noimage.png";
		}
/* */  ?>				
	<div class="col-md-3">
		<section>
			<p><a href="displayscrollerprogramdetailed.php?tvprogramid=<?php echo $rstvprogram[0]; /* */  ?>"><img src="<?php echo $imgname; /* */  ?>" style="width:100%;height:150px;" ></a></p>	
			<h6><?php echo $rstvprogram[title]; /* */  ?></h6>			
			<p class="subtitle">Scheduled on <?php echo $rstvprogram[programday]; /* */  ?> @ <?php echo date("h:i A",strtotime($rstvprogram[ftime])); /* */  ?>-<?php echo date("h:i \P\M",strtotime($rstvprogram[ttime])); /* */  ?></p>
			<a href="displayscrollerprogramdetailed.php?tvprogramid=<?php echo $rstvprogram[0]; /* */  ?>" class="button">Select</a>
			<hr>
		</section>
	</div>
<?php
}
/* */  ?>	
				</div>
			</div>
			<!-- /Extra -->

		</div>
	<!-- /Main -->
                   
				   </div>
                </div>
              </div>
             </div>
          </form>
         </div>
       </div>
     </div>


<?php
include "footer.php";
?>