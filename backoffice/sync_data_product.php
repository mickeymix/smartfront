<?
	include 'head.php';
	
	
	$alert = $_GET["alert"];
	
	
	
?>


<script src="js/ckeditor.js"></script>
	<script src="js/sample.js"></script>
 <link rel="stylesheet" href="styles/bootstrap.min.css">
 <div id="wrapper">
        <?php include("top.php");?>   
           <!-- /. NAV TOP  -->
                <?php include("menu.php");?>  
        <!-- /. NAV SIDE  -->
	
		<form  action="sync_product.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="">
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Sync Product</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                  <!-- /. ROW  -->
				  <?php if($alert<>""){ ?>
				  <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo "$alert"; ?>    
                   </div>
					 <?php } ?>		
				  
				  
           
					
					<label>รหัสสินค้า</label>
					<input class="form-control" placeholder="" type="text" name="productCode" value="" />
					<br> 
					
					
				
					<br> <br><br>
					
					 
					<input type="hidden" name="action" value="1" />
					<input type="hidden" name="product_promo_type" value="recommen" />
                     <button type="submit" class="btn btn-success">  Save  </button>
                     <button type="reset" class="btn btn-primary">Reset</button>   
					 <a href="" class="btn btn-default">Back</a>              


    </div>
             <!-- /. PAGE INNER  -->
            </div>
		
         <!-- /. PAGE WRAPPER  -->
        </div>

	</form>

			
			
<?
	include 'footer.php';
?>

 
