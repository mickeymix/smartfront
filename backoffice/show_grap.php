<?
	include 'head.php';
	
	
	if($_GET["action"] == "2"){
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
		
		$orderid = $_GET["orderid"];
		$sql ="DELETE FROM order_magic WHERE ORDER_ID='".$orderid."'";
			
				if ($conn->query($sql) === TRUE) {
					$alert="DELETE successfully";
				} else {
					$alert="Error: " . $sql . "<br>" . $conn->error;
				}
				
		$conn->close();		
	}
?>
 <div id="wrapper">
        <?php include("top.php");?>   
           <!-- /. NAV TOP  -->
                <?php include("menu.php");?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Sales For Year</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
				  
				<form action="grap.php" >
				 <select name="dateStart"  >
				<?
				$xYear=date('Y'); // เก็บค่าปีปัจจุบันไว้ในตัวแปร
					
						echo '<option value="'.$xYear.'">'.$xYear.'</option>'; // ปีปัจจุบัน
					for($i=1;$i<=30;$i++){
						echo '<option value="'.($xYear-$i).'">'.($xYear-$i).'</option>';
					}
				?>
				 </select>
				  <input type="hidden" name="dt"  value="1" >
				  <input type="submit" value="GO">
				  
				 </form>
                  <!-- /. ROW  -->
				   <?php if($alert<>""){ ?>
				  <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo "$alert"; ?>    
                   </div>
					 <?php } ?>		
		
				  <div style="height:10px;"></div>
        <div class="table-responsive">
                 <img src="grap.php" />             
                            </div>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>			
	
	
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
   <script>
	 $( function() {
		$('#datepicker').datepicker({
			  dateFormat: 'yy-mm-dd',
			   showOn: "button",
    buttonImage: "http://static.wixstatic.com/media/11fa24_6b991198d86b4b68865fb1d084eee7d7.png_srz_303_303_85_22_0.50_1.20_0.00_png_srz",
    buttonImageOnly: true
			
		});
	 	  $(".ui-datepicker-trigger").css("margin", "0px");
            $(".ui-datepicker-trigger").css("padding", "2px 2px 2px 2px");
            $(".ui-datepicker-trigger").css("height", "26px");
	  } );
	
	$( function() {
		$('#datepicker2').datepicker({
			  dateFormat: 'yy-mm-dd',
			   showOn: "button",
    buttonImage: "http://static.wixstatic.com/media/11fa24_6b991198d86b4b68865fb1d084eee7d7.png_srz_303_303_85_22_0.50_1.20_0.00_png_srz",
    buttonImageOnly: true
			
		});
	 	  $(".ui-datepicker-trigger").css("margin", "0px");
            $(".ui-datepicker-trigger").css("padding", "2px 2px 2px 2px");
            $(".ui-datepicker-trigger").css("height", "26px");
	  } );
	  
   </script>
   
   
   
  <footer class="site-footer push">This is a footer</footer>
     <script src="js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->

      <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>
      </body>
</html>