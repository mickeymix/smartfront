<?
include 'header.php';



$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");
?>

    <div class="content-wrapper row">

        <main class="main container" role="main">

 
<div id="myCarousel" class="carousel slide" >
   <!-- Indicators -->
   <!-- Wrapper for slides -->
   <div class="carousel-inner">
      <div class="item active" style="width: 100%; height: auto;">
         <div class="row"><a href="#"> <img style="width: 100%; height: auto;" src="images/silde_image.png" alt="customcones" > </a></div>
      </div>
      <div class="item" style="width: 100%; height: auto;">
         <div class="row"><a href="#"> <img style="width: 100%; height: auto;" src="images/silde_image2.png" alt="customcones" > </a></div>
      </div>
     
   </div>
   <p><a href="#myCarousel" class="left carousel-control" data-slide="prev"><span class="icon-prev"></span><span class="sr-only">Previous</span></a><a href="#myCarousel" class="right carousel-control" data-slide="next"><span class="icon-next"></span><span class="sr-only">Next</span></a></p>
</div>
            <div class="row">
                <div id="index-popular-heading" class="col-sm-12 text-center">
                    <h2><span>Our Most Popular Products</span></h2>
                </div>
            </div>
            <div class="row popular-products">
			
			 <?php
			 $perpage = 12;
			 if (isset($_GET['page'])) {
				$page = $_GET['page'];
			 } else {
				$page = 1;
			 }
		 
			$start = ($page - 1) * $perpage;
			 
			 
			 
			 $sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product FROM product_main a  ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
			 $query = mysqli_query($conn, $sql);
			 
			 while ($result = mysqli_fetch_assoc($query)) {	
			 ?>	
			
                <div class="col-sm-6 col-md-3 popular-item"><a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"> <img class="cld-responsive img-responsive center-block" src="back_end/<?echo ($result['image_product']=="") ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>" > </a>
                   <div style="height:20px;">
					<h5><a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code']; ?></a></h5>
                   </div>
				    <p class="popular-item-desc"><?php echo $result['product_title_th']; ?></p> 
                    <a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>" class="btn btn-primary">BUY NOW</a>
                </div>
              
			 <?php
			  }
			 ?> 
				
				
				<?php
	 
			 $sql2 = "SELECT * FROM product_main ";
			 $query2 = mysqli_query($conn, $sql2);
			 $total_record = mysqli_num_rows($query2);
			 $total_page = ceil($total_record / $perpage);
			 ?>
			 <nav>
				 <ul class="pagination">
					 <li>
						 <a href="index.php?page=1" aria-label="Previous">
							 <span aria-hidden="true">&laquo;</span>
						 </a>
							 </li >
								 <?php for($i=1;$i<=$total_page;$i++){ ?>
								 
								 <?
								 if($i == $page){
								?>	 
									<li class='active'><a  href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?	
								}else{
								?>
									<li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?	
								}
								 ?>
									
								 <?php } ?>
							 <li>
						 <a href="index.php?page=<?php echo $total_page;?>" aria-label="Next">
							 <span aria-hidden="true">&raquo;</span>
						 </a>
					 </li>
				 </ul>
			 </nav> 

		
            </div>
            <?   $sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)) {
                ?>?>

                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="col-xs-12 col-md-12"><a href="<?echo $result['service_link_one']?>" target="_blank">
                                <img class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?echo  $result['service_img_one']?>" height="250" width="250" alt="shipping truck icon">
                            </a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?echo  $result['service_title_one']?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<?echo $result['service_link_two']?>" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?echo  $result['service_img_two']?>" height="250" width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?echo  $result['service_title_two']?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<?echo $result['service_link_three']?>" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?echo  $result['service_img_three']?>" height="250" width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?echo  $result['service_title_three']?></h2>
                        </div>
                    </div>
                </div>
            <?}?>


        </main>
    </div>

<?
mysqli_close($conn);
include 'footer.php';
?>