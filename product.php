<?php   session_start(); ?>
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

	<script>
		$(document).ready(function() {
			$(".product-list-link").addClass("box-overlay");
		});
	</script>
    <div class="content-wrapper row">

        <main class="main container" role="main">

            <div class="row tss-breadcrumbs">
                <div class="col-xs-12"><a href="index.php">Home</a> &nbsp;&nbsp;>&nbsp;&nbsp;<?php echo $_GET["product_category_title_th"]; ?> &nbsp;&nbsp;>&nbsp;&nbsp;<?php echo $_GET["product_type_title_th"]; ?></div>
            </div>

            <section class="content category-page">
                <header>
                    <h1><?php echo $_GET["product_type_title_th"]; ?></h1>
                </header>
                <br>
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
							src="backoffice/<?php echo ($result['image_product']=="") ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>">
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
								 
								 <?php 
								 if($i == $page){
								?>	 
									<li class='active'><a  href="product.php?page=<?php echo $i; ?>&product_type_code=<?php echo $_GET["product_type_code"]; ?>"><?php echo $i; ?></a></li>
								<?php 
								}else{
								?>
									<li><a href="product.php?page=<?php echo $i; ?>&product_type_code=<?php echo $_GET["product_type_code"]; ?>"><?php echo $i; ?></a></li>
								<?php 
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
<?php
mysqli_close($conn);
include 'footer.php';
?>