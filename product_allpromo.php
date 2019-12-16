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

$product_promo_type = $_GET["product_promo_type"];
$product_type_promo_head = $_GET["product_type_promo_head"];
?>

    <div class="content-wrapper row">

        <main class="main container" role="main">
<br/><br/>
 

            <div class="row">
                <div id="index-popular-heading" class="col-sm-12 text-center">
                    <h2><span><?php echo $product_type_promo_head; ?></span></h2>
                </div>
            </div>
            <div class="row popular-products">
			
			 <?php
			 $perpage = 24;
			 if (isset($_GET['page'])) {
				$page = $_GET['page'];
			 } else {
				$page = 1;
			 }
		 
			$start = ($page - 1) * $perpage;
			 
			
			 
			 $sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  FROM product_main a  ,  product_promotion b  WHERE  a.product_code = b.product_code AND b.product_promo_type = '$product_promo_type'  ORDER BY a.INSERT_DATE DESC limit {$start} , {$perpage}";
			 $query = mysqli_query($conn, $sql);
			 
			 while ($result = mysqli_fetch_assoc($query)) {	
			 ?>	
			
                <div class="col-sm-6 col-md-3 popular-item"><a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"> <img class="cld-responsive img-responsive center-block" src="backoffice/<?echo ($result['image_product']=="") ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>" > </a>
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
            </div>
            <?php

            $sql2 = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  FROM product_main a  ,  product_promotion b  WHERE  a.product_code = b.product_code AND b.product_promo_type = '$product_promo_type'  ORDER BY a.INSERT_DATE DESC";
            $query2 = mysqli_query($conn, $sql2);
            $total_record = mysqli_num_rows($query2);
            $total_page = ceil($total_record / $perpage);
            ?>
            <div style="text-align: center;"><nav>
                    <ul class="pagination">
                        <li>
                            <a href="product_allpromo.php?page=1&product_promo_type=<?php echo $product_promo_type; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li >
                        <?php for($i=1;$i<=$total_page;$i++){ ?>

                            <?php
                            if($i == $page){
                                ?>
                                <li class='active'><a  href="product_allpromo.php?page=<?php echo $i; ?>&product_promo_type=<?php echo $product_promo_type; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }else{
                                ?>
                                <li><a href="product_allpromo.php?page=<?php echo $i; ?>&product_promo_type=<?php echo $product_promo_type; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }
                            ?>

                        <?php } ?>
                        <li>
                            <a href="product_allpromo.php?page=<?php echo $total_page;?>&product_promo_type=<?php echo $product_promo_type; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav></div>

            <?php

            $sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)) {
                ?>?>

                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="col-xs-12 col-md-12"><a href="<?php echo $result['service_link_one']?>" target="_blank">
                                <img class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?echo  $result['service_img_one']?>" height="250" width="250" alt="shipping truck icon">
                            </a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?php echo  $result['service_title_one']?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<?php echo $result['service_link_two']?>" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?php echo  $result['service_img_two']?>" height="250" width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?php echo  $result['service_title_two']?></h2>
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