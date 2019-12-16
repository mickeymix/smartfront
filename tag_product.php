<?php  session_start(); ?>
<?php
include 'backoffice/conn.php';
if($_GET["action"] == "logout"){
	session_destroy();
	 header( "Location: index.php" );
}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
    <title>ร้านไทยจราจร</title>
<?php 
include 'header.php';
$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn,"utf8");
?>
    <div class="content-wrapper row">
        <main class="main container" role="main">
			<br/><br/>
			<div class="row">
				 <div  class="col-sm-12 ">
					<header>
						<h1><?php echo $_GET["keyword"]; ?></h1>
					</header>
					<br/>
				 </div>	
				 <div  class="col-sm-12 text-center">
					<ul class="product-list row">
				
						<?php
						
						$perpage = 100;
						 if (isset($_GET['page'])) {
							$page = $_GET['page'];
						 } else {
							$page = 1;
						 }					 
						$start = ($page - 1) * $perpage;
						
						$id_menu =  $_GET['menu_keyword'];
						$sql = "SELECT DISTINCT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th 
						 ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  
						 FROM product_main a  , tag_product b  WHERE a.product_code = b.product_code  AND b.keyword = '".$_GET["keyword"]."'  AND a.sell_with_web = '1' ORDER BY a.INSERT_DATE DESC limit {$start} , {$perpage} ";
							 $query = mysqli_query($conn, $sql);	 
							 while ($result = mysqli_fetch_assoc($query)) {	
						
						?>
							<li class="product-list-item col-xs-6 col-sm-4 col-md-3 col-lg-2" style="height: 447px;">
								<a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>" class="product-list-link listingSaleNoticeLink ">
												
												<img class="product-list-thumbnail cld-responsive"  src="backoffice/<?php echo $result['image_product']; ?>" alt="<?php echo $result['image_product']; ?>">
												<span class="product-list-name" style="height: 66px; "><?php echo $result['product_code']; ?></span>
											</a>

								<p class="product-list-desc" style="height: 48px;text-align: left;"><?php echo $result['product_title_th']; ?>
								
								</p>
								<a class="btn btn-info btn-sm listingSaleNoticeLink" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>">Learn More</a>
							</li>
						<?php
							 }
						?>
					</ul>
					
			  <?php
				$sql2 = "SELECT DISTINCT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th 
						 ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  
						 FROM product_main a  , tag_product b  WHERE a.product_code = b.product_code  AND b.keyword = '".$_GET["keyword"]."'  AND a.sell_with_web = '1'  ";

			 $query2 = mysqli_query($conn, $sql2);

			 $total_record = mysqli_num_rows($query2);

			 $total_page = ceil($total_record / $perpage);

			 ?>

			 <nav>
				 <ul class="pagination">
					 <li>
						 <a href="tag_product.php?page=1&keyword=<?php echo $_GET["keyword"]; ?>" aria-label="Previous">
							 <span aria-hidden="true">&laquo;</span>
						 </a>
							 </li >
								 <?php for($i=1;$i<=$total_page;$i++){ ?>
								 <?php
								 if($i == $page){
								?>	 

									<li class='active'><a  href="tag_product.php?page=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>"><?php echo $i; ?></a></li>

								<?php
								}else{
								?>
									<li><a href="tag_product.php?page=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>"><?php echo $i; ?></a></li>

								<?php } ?>
								<?php } ?>
							 <li>
						 <a href="tag_product.php?page=<?php echo $total_page;?>&keyword=<?php echo $_GET["keyword"]; ?>" aria-label="Next">
							 <span aria-hidden="true">&raquo;</span>
						 </a>
					 </li>
				 </ul>
			 </nav> 
                </div>
			</div>

            <div class="row">
                <div id="index-popular-heading" class="col-sm-12 text-center">
                    <h2><span>สินค้าจราจร</span></h2>
                </div>
            </div>

			<?php   
			$sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_assoc($query)) {
                ?>

                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="col-xs-12 col-md-12"><a href="<?php echo $result['service_link_one']?>" target="_blank">
                                <img class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?php echo  $result['service_img_one']?>" height="250" width="250" alt="shipping truck icon">
                            </a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?php echo  $result['service_title_one']?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<?php echo $result['service_link_two']?>" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?php echo  $result['service_img_two']?>" height="250" width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?echo  $result['service_title_two']?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<?php echo $result['service_link_three']?>" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?php echo  $result['service_img_three']?>" height="250" width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?php echo  $result['service_title_three']?></h2>
                        </div>
                    </div>
                </div>
            <?php }?>
        </main>
    </div>
<?php 
mysqli_close($conn);
include 'footer.php';
?>
