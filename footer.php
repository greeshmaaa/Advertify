 
 <!-- ##### Footer Area Start ##### -->
 
    <footer class="footer-area" style="background-color: #f2f4f5 !important;">
       

        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <!-- Copywrite Text -->
                    <div class="col-12 col-sm-6">
                        <p class="copywrite-text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
                    </div>
                    <div class="col-12 col-sm-6">
                        <nav class="footer-nav">
						<?php
	if(!isset($_SESSION["employeeid"]))
	{
			if(!isset($_SESSION["advertiserid"]))
			{
	?>
                            <ul>
							
                                <li><a href="#" data-toggle="modal" data-target="#myModal">Admin Panel</a></li>
                               
                            </ul>
							<?php
			}
	}
	?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <form action="" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <h2>Employee Login</h2>
	    <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
     
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Login ID" name="loginid">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                            </div>
                            
                         
                       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn mag-btn mt-30" name="emplogin">Login</button>
      </div>
    </div>
 </form>
  </div>
</div>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>
