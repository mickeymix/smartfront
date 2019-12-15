<?php ob_start(); ?>
<?php session_start(); ?>
<?php
include 'backoffice/conn.php';

if(!empty($_GET)) { 
	if ($_GET["action"] == "logout") {
		session_destroy();
		header("Location: index.php");
 	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">

	<title>ร้านไทยจราจร ผู้นำด้านอุปกรณ์จราจร ที่ทันสมัย หลากหลาย และครบเครื่องมากที่สุดในประเทศไทย</title>
	<meta name="Keywords" content="จราจร กรวยจราจร แผงกั้นจราจร กระจกโค้ง ยางชะลอความเร็ว หมุดถนน" />
	<meta name="description" content="อุปกรณ์จราจร ที่มีให้เลือกเยอะที่สุดในประเทศไทย เราคือผู้นำเข้าและผู้ผลิต อุปกรณ์จราจร เช่น กรวยจราจร แผงกั้นจราจร กระจกโค้ง ยางชะลอความเร็ว หมุดถนน และอื่นๆ" />

	<?php

	include 'header.php';
	$conn = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_set_charset($conn, "utf8");
    
    ?>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="css/application.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
</head>

<body>

	<script src="js/slider.js"></script>
	<script src="js/filp.js"></script>

	<script>
		function messlide() {
		}
	</script>

	<div class="content-wrapper row">
		<main class="main container" role="main">
			<div id="ads_topMain">
                <?php

					$sql = "SELECT * FROM cover_image_title";
					$query = mysqli_query($conn, $sql);
					$i = 0;
					while ($result = mysqli_fetch_assoc($query)) {?>
                        <a href="<?php echo $result['coverlink'] ?>"> <img style="width: 100%;  height: auto;" data-lazy="backoffice/<?php echo $result['coverImage'] ?>" alt="<?php echo $result['coveralt'] ?>"> </a>

                <?php } ?>
            </div>
			<?php if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {   ?>


			<?php } else { ?>
				<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="https://img.lovepik.com/element/40087/8190.png_1200.png" width="40px" />
					ยินดีด้วยคุณได้รับคูปองส่วนลด <span style="text-decoration: underline;"> <a href="javascript:void(0)" onclick="messlide();">คลิกเลย </a></span>
				</div>

			<?php } ?>
			<div class="row">
				<div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
					<h2><span>สินค้าโปรโมชั่นด่วน</span></h2>
				</div>
			</div>
			<div class="row popular-products">

                <div id="promotion_products_main">
                    <?php

                    $sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  FROM product_main a  ,  product_promotion b  WHERE  a.product_code = b.product_code AND b.product_promo_type = 'promo' AND a.sell_with_web = '1'  ORDER BY a.INSERT_DATE";
                    $query = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($query)) {
                        ?>

                        <div class="col-sm-6 col-md-3 popular-item">
                            <a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>">
                                <img  data-lazy="backoffice/<? echo ($result['image_product'] == '') ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>">
                            </a>
                            <div style="height:20px;">
                                <h5><a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code']; ?></a></h5>
                            </div>
                            <p class="popular-item-desc"><?php echo $result['product_title_th']; ?></p>
                            <a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>

                        <?php
                    }
                    ?>
                </div>

				<div class="row">
					<div id="index-popular-heading" class="col-sm-12 text-right ">
						<span style="color:red;"><a target="_blank" href="product_allpromo.php?product_promo_type=promo&product_type_promo_head=สินค้าโปรโมชั่นด่วนทั้งหมด">สินค้าโปรโมชั่นด่วนทั้งหมด >>></a></span>

					</div>
				</div>
				<br />
				<div class="row">
					<div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
						<h2><span>สินค้าระดับโลกมีรับประกัน</span></h2>
					</div>
				</div>

			</div>
			<div class="row">

                <div id="popular_products_main">
                    <?php

                    $sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  FROM product_main a  ,  product_promotion b  WHERE  a.product_code = b.product_code AND b.product_promo_type = 'recommen' AND a.sell_with_web = '1'  ORDER BY a.INSERT_DATE";
                    $query = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($query)) {
                        ?>

                        <div class="col-sm-6 col-md-3 popular-item"><a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"> <img data-lazy="backoffice/<?php echo ($result['image_product'] == "") ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>"> </a>
                            <div style="height:20px;">
                                <h5><a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code']; ?></a></h5>
                            </div>
                            <p class="popular-item-desc"><?php echo $result['product_title_th']; ?></p>
                            <a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>

                        <?php
                    }
                    ?>
                </div>

				<div class="row">
					<div id="index-popular-heading" class="col-sm-12 text-right ">
						<span style="color:red;"><a target="_blank" href="product_allpromo.php?product_promo_type=recommen&product_type_promo_head=สินค้าระดับโลกมีรับประกันทั้งหมด">สินค้าระดับโลกมีรับประกันทั้งหมด >>></a></span>
					</div>
				</div>

			</div>

			<div class="row">
				<div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
					<h2><span>สินค้าทั้งหมด</span></h2>
				</div>
			</div>

			<div class="row">
                <div id="all_product">
                    <?php
//                    $sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product FROM product_main a WHERE a.sell_with_web = '1'  ORDER BY INSERT_DATE DESC limit 0 , 24";
                    $sql = "SELECT * FROM menu";
                    $query = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($query)) {
                        ?>

                        <div class="slider_item" style="padding-left: 15px; padding-right: 15px">
                            &nbsp;
                            <a target="_blank" href="menu_main.php?id_menu=<?php echo $result['id_menu']; ?>&menu_keyword=<?php echo $result['menu_keyword']; ?>">
                                <img data-lazy="backoffice/<?php echo $result['menu_img']; ?>" alt="<?php echo $result['menu_name']; ?>">
                            </a>
                            &nbsp;<div style="height:20px; padding-left: 10px">
                                <h5><?php echo $result['menu_name']; ?></h5>
                            </div>
                            <a target="_blank" href="menu_main.php?id_menu=<?php echo $result['id_menu']; ?>&menu_keyword=<?php echo $result['menu_keyword']; ?>" class="btn btn-primary">ดูรายละเอียด</a>

                        </div>

                        <?php
                    }
                    ?>

                </div>

                <br><br>
				<div class="row">
					<div id="index-popular-heading" class="col-sm-12 text-right ">
						<span style="color:red;"><a target="_blank" href="product_all.php">สินค้าทั้งหมด >>></a></span>
					</div>
				</div>
			</div>

            <?php
            
            $sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_assoc($query)) {
            
            ?>
			<div class="row">
				<div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
					<h2><span><?php echo  $result['service_top_title']?></span></h2>
				</div>
			</div>

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

            <?php  
            } 
        ?>

			<div class="row index-popular-products" style=" background-color: #c93334;">
				<div class="col-sm-12 text-center index-popular-products">
					<img class="lazy" data-src="images/youtube_logo.png">
					<h2><span style="color: #ffffff;">วีดีโอตัวอย่างสินค้า ของร้านไทยจราจร</span></h2>
				</div>
			</div>

			<div class="row">

                <div id="vdo_prodorduct">

                    <div class="slider_item">
                        &nbsp;
                        <iframe width="300" height="300" src="https://www.youtube.com/embed/KiTgbqhdzcg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        &nbsp;
                    </div>

                    <div class="slider_item">
                        &nbsp;
                        <iframe width="300" height="300" src="https://www.youtube.com/embed/ufSTxR559Tc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        &nbsp;
                    </div>

                    <div class="slider_item">
                        &nbsp;
                        <iframe width="300" height="300" src="https://www.youtube.com/embed/Q6QdDntr8rY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        &nbsp;
                    </div>

                    <div class="slider_item">
                        &nbsp;
                        <iframe width="300" height="300" src="https://www.youtube.com/embed/YhY2r86bQEY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        &nbsp;
                    </div>

                </div>

				<div class="row">
					<div id="index-popular-heading" class="col-sm-12 text-right ">
						<span style="color:red;"><a href="#">วีดีโอตัวอย่างสินค้าเพิ่มเติม >>></a></span>
					</div>
				</div>

			</div>

			<div class="row index-popular-products" style=" background-color: #c93334;">
				<div class="col-sm-12 text-center index-popular-products">
					<h2><span style="color: #ffffff;">ลูกค้ากว่า 300,000 ราย ทั่วประเทศไทย ให้ความไว้วางใจ ร้านไทยจราจร !! </span></h2>
				</div>
			</div>

			<div class="row">
					<?php 
					$sql = "SELECT * FROM customer_logo_page";
					$query = mysqli_query($conn, $sql);
					while ($result = mysqli_fetch_assoc($query)) {
						?>

                <ul id="rig">
                    <li>
                        <a class="rig-cell" href="<?php  echo $result['linktestimo'] ?>">
                            <img class="rig-img" src="<?php  echo 'backoffice/' . $result['image_logo'] . '' ?>">
                            <span class="rig-overlay"></span>
                            <span class="rig-text">Lorem Ipsum Dolor</span>
                        </a>
                    </li>
                </ul>
				<?php } ?>
            </div>

			<div class="row ">
				<div class="col-sm-12 ">
					<div class="index_customer">
						<div class="img_customer">
							<img class="lazy" data-src="images/circled-user-male-skin-type-1-2.png" width="50px" />
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 text-center index-popular-products">
					<h2><span style="text-decoration: underline;  text-decoration-color: red;"><a target="_blank" href="testtimo.php">ตัวอย่างผลงาน ที่ลูกค้าชั้นนำ ในประเทศไทย เลือกใช้!!</a></span></h2>
				</div>
			</div>
            
			<div class="row">
                <div id="testimo_smart">
                    <?php
                    $sql = "SELECT * FROM testimo WHERE  start_art <= ADDTIME(SYSDATE(),'7:00:00') ORDER BY INSERT_DATE DESC ";
                    $query = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($query)) {
                        ?>

                        <div class="slider_item">
                            <div align="center">
                                <div class="card" style="width:300px; height:300px;">
                                    <div class="front">
                                        <img class="lazy" data-src="backoffice/<?php echo $result['img_testimo']; ?>" style="width:300px; height:300px;" />
                                    </div>
                                    <div class="back" align="center">
                                        <div class="box-back-filp">
                                            <div class="img-back-filp">
                                                <a href="testimo_detail.php?id_testimo=<?php echo $result['id_testimo']; ?>" target="_blank">
                                                    <!-- <img src="images/link_icon1.png"> -->
                                                    <img class="lazy" data-src="backoffice/<?php echo $result['img_testimo']; ?>" style="width:222px; height:222px;" />

                                                </a>
                                                <p style="color:#fff; padding-top:20px; width text-align:center; height:78px;"><?php echo $result['head_testimo']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                </div>
			</div>

			<div class="row">
				<div class="col-sm-12 text-center">

					<div style="background-image:url('images/tc-info-bg.jpg'); width:100%; height:500px; ">
						<div class="col-sm-6 text-center" style="top:40%;">
							<div align="center">
								<h2 style="color:#fff; padding-top:20px; width text-align:center;">Building Inspiring Spaces</h2>
								<hr />
								<p style="color:#fff; padding-top:20px; width text-align:center;">Building Inspiring Spaces</p>
							</div>
						</div>
						<div class="col-sm-6 text-center" style="top:40%;">
							<div align="center">

								<img class="lazy" data-src="images/getafreequote.png">
								<p style="color:#fff; padding-top:20px; width text-align:center;">Goto Get A Free Quote</p>
							</div>
						</div>
					</div>

				</div>

			</div>
			<?php
			  include 'listblogpage.php';
			?>

		</main>
	</div>
	<br />
    <br />

    <?php 
        mysqli_close($conn);
        include 'footer.php';
    ?>
</body>
</html>