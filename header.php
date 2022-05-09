<?php
session_start();
error_reporting(0);
include("dbconnect.php");
$dt = date("Y-m-d");

if(isset($_SESSION[advertiserid]))
{
	//echo $_SESSION[user_id];
	$sqlenrollerprofile ="SELECT * FROM advertiser WHERE advertiserid='$_SESSION[advertiserid]'";
	$qsqlenrollerprofile = mysqli_query($con,$sqlenrollerprofile);
	$rsenrollerprofile = mysqli_fetch_array($qsqlenrollerprofile);
	
}
include "dbconnect.php";
if(isset($_POST['emplogin'])){
	
	$loginid=$_POST['loginid'];
	$password=$_POST['password'];
	$sql="SELECT * FROM employee WHERE loginid='$loginid' AND password='$password'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		$rs= mysqli_fetch_array($qsql);
		$_SESSION["employeeid"] = $rs[0];
		$_SESSION["emptype"] = $rs['emptype'];
		echo "<script>alert('Logged in successfully..');</script>";
		echo "<script>window.location='employeehome.php';</script>";
	}
	else
	{
		echo "<script>alert('Failed to Login.');</script>";	
	}
}
function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>ADVERTIFY</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Navbar Area -->
        <div class="mag-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="magNav">

                    <!-- Nav brand -->
                    <a href="" class="nav-brand"><p style="font-size: 22px;margin-top: 2px;"><span style="color:#000;font-size: 32px;"><b>AD</b></span><i><span style="color:#D2691E;">vertify</span>
					</i></p><p style="margin-top: -31px;font-size: 11px;">Online TvAdveristment Streaming Website</p></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Nav Content -->
                    <div class="nav-content d-flex align-items-center">
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
<div class="aa-header-top-right">
			  
                <ul class="aa-head-top-nav-right">
				
				  <?php
				  if(isset($_SESSION["advertiserid"]))
				  {
					?>
                 <!-- <li><a href="account.php">My Account</a></li>-->
                 
                <!--  <li class="hidden-xs"><a href="viewwebads.php">Web Ads</a></li>
                  <li class="hidden-xs"><a href="viewscrolleradvt.php">Scroller Ads</a></li>
                  <li class="hidden-xs"><a href="videoads.php">Video Ads</a></li>
                  <li class="hidden-xs"><a href="viewvideoads.php">View Video Ads</a></li>
                  <li class="hidden-xs"><a href="promotevideoads.php">Promote Video Ads</a></li>
                  <li class="hidden-xs"><a href="viewvideoadspayment.php">View Promoted Video Ads</a></li>-->
      
	  <?php
	  /*
	  <li class="hidden-xs"><a href="scrolleradvt.php">Post Scroller Template</a></li>
	  <li class="hidden-xs"><a href="viewscrolleradvt.php">View Scroller Template</a></li>
	  <li class="hidden-xs"><a href="displaytvprogramscroller.php">Post Scroller Advertisement</a></li>
	  <li class="hidden-xs"><a href="viewpayment.php">View Scroller Ads Payment</a></li>
	  */
	  ?>
	  
                <!--  <li class="hidden-xs"><a href="viewpayment.php">Payment Report</a></li>-->
                
					<?php
				  }
				  else if(isset($_SESSION["employeeid"]))
				  {
				?>					 
                 
				<?php
				  }
				  else
				  {
					 ?>
                  
                
				 <li><a href="login.php" class="login-btn"><i class="fa fa-sign-in" aria-hidden="true"></i></a><a href="register.php" class="login-btn"><img src="img/reg.png" style="width:17px;height: 21px;"></a><a href="contact.php" class="login-btn">Contact</a></li>
				 <li> </li>  
				  <?php
				  }
				  ?>
                </ul>
              </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
								<?php
	if(isset($_SESSION["advertiserid"]))
	{
	?>
                                    <li class="active<?php
	  if(basename($_SERVER['PHP_SELF']) =="home.php")
	  {
		  echo " active ";
	  }
		?> "><a href="home.php">Home</a></li>
                                    
		
		
			
		  <li><a href="#">WebAds</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                            <li><a href="add_webads.php">Add WebAds</a></li>
                                            <li><a href="view_webads.php">View WebAds</a></li>
                                            <li><a href="webadspayment.php">Do WebAds payment</a></li>
											
                                            <li><a href="viewwebadspaymentreport.php">WebAds Payment Report</a></li>
                                            
                                        </ul>
                                    </li>
									 <li><a href="#">VideoAds</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                            <li><a href="add_videoads.php">Add VideoAds</a></li>
                                            <li><a href="view_videoads.php">View VideoAds</a></li>
                                            <li><a href="promotevideoads.php">Promote VideoAds </a></li>
											
                                          <li><a href="viewvideoadspayment.php">View Promoted VideoAds</a></li>
                                            
                                        </ul>
                                    </li>
									<li><a href="#">Scroller Ads</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                           <li><a href="add_scrollerads.php">Add Scroller Ads</a></li>
                                            <li><a href="viewscrolleradvt.php">View Scroller Ads</a></li>
                                            <li><a href="displaytvprogramscroller.php" style="width: 217px;">Payment For Scroller-Ads</a></li> 
											<li><a href="viewpayment.php" style="width: 400px;">Scroller Ads Payment Report</a></li>  
                                        </ul>
                                    </li>
								<li><a href="#">Profile</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                           <li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="profile.php")
	  {
		  echo " active ";
	  }
		?>"><a href="profile.php">Profile</a></li>
                                         
		                                <li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="changepass.php")
	  {
		  echo " active ";
	  }
		?>"><a href="changepass.php"></i>Change Password</a></li>
                <li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="logout.php")
	  {
		  echo " active ";
	  }
		?>"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>                               
                                            
                                        </ul>
                                    </li>
									
		 <?php
	}
	?>
   <?php
if(isset($_SESSION[employeeid]))
{
	
?>	    
<li class="active<?php
	  if(basename($_SERVER['PHP_SELF']) =="employeehome.php")
	  {
		  echo " active ";
	  }
		?> "><a href="employeehome.php">Home</a></li>
                              
		
	 <li><a href="#">Article</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                            <li><a href="add_post.php">New Post</a></li>
                                            <li><a href="view_post.php?articletype=News">View News/Article</a></li>
                                           <?php
if($_SESSION["emptype"] == "Admin")					
{
?>
<li><a href="add_category.php">Add Article Category</a></li>
					<li><a href="view_category.php">View Article category</a></li>          
<?php
}
?>
                                            
                                        </ul>
                                    </li>
	
									<li><a href="#">TV Program</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                            <li><a href="add_tvprogram.php">Add Tv Program</a></li>
                                            <li><a href="viewtvprogram.php">View Tv Program</a></li>
                                           
                                            
                                        </ul>
                                    </li>
									<li><a href="#">Reports</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                            <li><a href="viewwebads.php">Web Ads Report</a></li>
                                            <li><a href="viewvideoads.php">Video Ads Report</a></li>
											   <li><a href="viewscrolleradvt.php">Scroller Ads Report</a></li>
                                           
                                            
                                        </ul>
                                    </li>
									
										<li><a href="#">Payment</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                            <li><a href="viewpayment.php">Payment Report</a></li> 
<?php
									if($_SESSION["emptype"]=="Admin")
				{
					
					?>	
<li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="tax.php")
	  {
		  echo " active ";
	  }
		?>"><a href="tax.php"></i>Add Tax</a></li> 					
											<li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="taxsetting.php")
	  {
		  echo " active ";
	  }
		?>"><a href="taxsetting.php"></i>Tax Settings</a></li> 
                                           
                                   <?php
				
				}
				
?>			         
</ul>
</li>
	<li><a href="#">Profile</a>
                                        <ul class="dropdown" style="width: 217px !important;">
                                           <li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="employeeprofile.php")
	  {
		  echo " active ";
	  }
		?>"><a href="employeeprofile.php">Profile</a></li>
                                         
		                                <li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="employeepass.php")
	  {
		  echo " active ";
	  }
		?>"><a href="employeepass.php"></i>Change Password</a></li>
                <li class="abc<?php
	  if(basename($_SERVER['PHP_SELF']) =="logout.php")
	  {
		  echo " active ";
	  }
		?>"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>                               
                                            
                                        </ul>
                                    </li>
                                 <?php
				}
				
?>				
                                        </ul>
                                                              
                                    
                                
                            </div>
                            <!-- Nav End -->
                        </div>

                        <div class="top-meta-data d-flex align-items-center">
                            <!-- Top Search Area -->
                            <div class="top-search-area">
                                <form action="index.html" method="post">
                                    <input type="search" name="top-search" id="topSearch" placeholder="Search and hit enter...">
                                    <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <!-- Login -->
                         

							
							         <!-- Submit Video -->
                           
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>