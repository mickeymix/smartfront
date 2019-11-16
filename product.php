<?  session_start(); ?>
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

<?
include 'header.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");
?>

	<script>
		$(document).ready(function() {
			$(".product-list-link").addClass("box-overlay");
		});
	</script>
    <div class="content-wrapper row">

        <main class="main container" role="main">

            <div class="row tss-breadcrumbs">
                <div class="col-xs-12"><a href="index.php">Home</a> &nbsp;&nbsp;>&nbsp;&nbsp;<? echo $_GET["product_category_title_th"]; ?> &nbsp;&nbsp;>&nbsp;&nbsp;<? echo $_GET["product_type_title_th"]; ?></div>
            </div>

            <section class="content category-page">
                <header>
                    <h1><? echo $_GET["product_type_title_th"]; ?></h1>
                </header>
                <br>
<!--
                <div id="catDescSlidedown" style="display:none;">

                    <div id="category-blurb" class="category-desc">

                        <img class="categortPageHeadImg cld-responsive" data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_auto,f_auto,q_auto:best,w_250/v1/i/traffic-cones-head-230x230.jpg" src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_auto,f_auto,q_auto:best,w_250/v1/i/traffic-cones-head-230x230.jpg">
                        <br>
                        <p><b>You've reached the largest stock of <span style="font-size:18px;"> MUTCD Compliant </span> traffic cones in the nation.</b>
                            <br>
                            <br>As one of America's largest traffic cone suppliers, all road cones, parking cones, and driving safety products are READY TO SHIP. <a href="traffic-cones\orange-lime.html">Orange traffic cones</a>, <a href="https://www.trafficsafetystore.com/traffic-cones/looper-tubes">looper tubes</a>, and <a href="traffic-cones\collapsible-light-up.html">collapsible traffic cones</a> - <i>Delivered Fast</i>!</p>
                        <p>Choose black-bottom reflective road cones - a great solution for <a href="traffic-cones\construction.html" title="Construction Cones">construction</a> or soccer practice. We also offer valet cones, blue accessibility cones, and pop-up LED cones. Add your logo to any <a href="traffic-cones\custom.html">custom traffic cones</a>.
                    </div>

                </div>
-->
                <ul class="product-list row">
			<?php
			 $perpage = 24;
			 if (isset($_GET['page'])) {
				$page = $_GET['page'];
			 } else {
				$page = 1;
			 }
		 
			$start = ($page - 1) * $perpage;
			 
			 
			 
			 $sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product FROM product_main a WHERE product_type_code = '".$_GET["product_type_code"]."'  ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
			 $query = mysqli_query($conn, $sql);
			 
			 while ($result = mysqli_fetch_assoc($query)) {	
			 ?>	
                    <li class="product-list-item col-xs-6 col-sm-4 col-md-3 col-lg-2">
                        <a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>" class="product-list-link listingSaleNoticeLink">                   
                            <div class="sale-ribbon red">
                                <span class="cornerRibbonText col-xs-12" style="font-size:20px;top:26px;left:-27px">On Sale</span>
                            </div>

                            <img class="product-list-thumbnail cld-responsive"  
							src="backoffice/<?echo ($result['image_product']=="") ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>">
                            <span class="product-list-name"><?php echo $result['product_code']; ?></span>
                        </a>

                        <p class="product-list-desc"><?php echo $result['product_title_th']; ?></p>
                        <a class="btn btn-info btn-sm listingSaleNoticeLink" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>">View Prices</a>
                    </li>
			 <?php
			  }
			 ?> 
                  
					
					
					
					

                </ul>

            </section>
			
			<?php
	 
			 $sql2 = "SELECT * FROM product_main WHERE product_type_code = '".$_GET["product_type_code"]."'";
			 $query2 = mysqli_query($conn, $sql2);
			 $total_record = mysqli_num_rows($query2);
			 $total_page = ceil($total_record / $perpage);
			 ?>
			 <nav>
				 <ul class="pagination">
					 <li>
						 <a href="product.php?page=1&product_type_code=<?php echo $_GET["product_type_code"]; ?>" aria-label="Previous">
							 <span aria-hidden="true">&laquo;</span>
						 </a>
							 </li >
								 <?php for($i=1;$i<=$total_page;$i++){ ?>
								 
								 <?
								 if($i == $page){
								?>	 
									<li class='active'><a  href="product.php?page=<?php echo $i; ?>&product_type_code=<?php echo $_GET["product_type_code"]; ?>"><?php echo $i; ?></a></li>
								<?	
								}else{
								?>
									<li><a href="product.php?page=<?php echo $i; ?>&product_type_code=<?php echo $_GET["product_type_code"]; ?>"><?php echo $i; ?></a></li>
								<?	
								}
								 ?>
									
								 <?php } ?>
							 <li>
						 <a href="product.php?page=<?php echo $total_page;?>&product_type_code=<?php echo $_GET["product_type_code"]; ?>" aria-label="Next">
							 <span aria-hidden="true">&raquo;</span>
						 </a>
					 </li>
				 </ul>
			 </nav> 

        </main>
    </div>
<?
mysqli_close($conn);
include 'footer.php';
?>