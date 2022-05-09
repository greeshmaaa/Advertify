<?php
error_reporting(0);

?>
<section class="sidebar">
			<header>
			<h2>Scroll advertisement Preview</h2>
			</header>
<div class="outer-container">
    <div class="inner-container">
        <div class="video-overlay"><marquee><?php
		if(isset($_GET[scrollmsg]))
		{
			echo $_GET[scrollmsg];
		}
		else
		{
			if(isset($_GET[editid]))
			{
				echo $rsedit[advtdescription];
			}
			else
			{
			echo "Scroll Advertisement loads here";
			}
		}
		?>
		</marquee></div>
        <video autoplay="" name="media" style="width:100%;"><source src="img/videopreview.mp4" type="video/mp4"></video>
		
    </div>
</div>
		</section>
		
<style>
	.outer-container {
    border: 1px dotted black;
    width: 100%;
    height: 100%;
    text-align: center;
}
.inner-container {
    border: 1px solid black;
    display: inline-block;
    position: relative;
}
.video-overlay {
    position: absolute;
    left: 0px;
    bottom: 0px;
    margin: 0px;
	width: 100%;
    padding: 0px 0px;
    font-size: 20px;
    font-family: Helvetica;
    color: #FFF;
    background-color: #090946;//rgba(50, 50, 50, 0.3);
}
video {
    width: 100%;
    height: 100%;
}
</style>