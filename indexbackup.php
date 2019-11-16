<? ob_start(); ?>
<? session_start(); ?>

<?php
include 'backoffice/conn.php';



if ($_GET["action"] == "logout") {
	session_destroy();
	header("Location: index.php");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">

	<title>ร้านไทยจราจร ผู้นำด้านอุปกรณ์จราจร ที่ทันสมัย หลากหลาย และครบเครื่องมากที่สุดในประเทศไทย</title>
	<meta name="Keywords" content="จราจร กรวยจราจร แผงกั้นจราจร กระจกโค้ง ยางชะลอความเร็ว หมุดถนน" />
	<meta name="description" content="อุปกรณ์จราจร ที่มีให้เลือกเยอะที่สุดในประเทศไทย เราคือผู้นำเข้าและผู้ผลิต อุปกรณ์จราจร เช่น กรวยจราจร แผงกั้นจราจร กระจกโค้ง ยางชะลอความเร็ว หมุดถนน และอื่นๆ" />


	<?
	include 'header.php';



	$conn = mysqli_connect($host, $user, $pass, $dbname);

	mysqli_set_charset($conn, "utf8");
	?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="css/application.css" rel="stylesheet" />


    <style>
        .col-centered {
            float: none;
            margin: 0 auto;
        }

        .carousel-control {
            width: 8%;
            width: 0px;
        }
        .carousel-control.left,
        .carousel-control.right {
            margin-right: 40px;
            margin-left: 32px;
            margin-bottom: 70px;
            background-image: none;
            opacity: 1;
        }
        .carousel-control > a > span {
            color: white;
            font-size: 29px !important;
        }

        .carousel-col {
            position: relative;
            min-height: 1px;
            padding: 5px;
            float: left;
        }

        .active > div { display:none; }
        .active > div:first-child { display:block; }

        /*xs*/
        @media (max-width: 767px) {
            .carousel-inner .active.left { left: -50%; }
            .carousel-inner .active.right { left: 50%; }
            .carousel-inner .next        { left:  50%; }
            .carousel-inner .prev		     { left: -50%; }
            .carousel-col                { width: 50%; }
            .active > div:first-child + div { display:block; }
        }

        /*sm*/
        @media (min-width: 768px) and (max-width: 991px) {
            .carousel-inner .active.left { left: -50%; }
            .carousel-inner .active.right { left: 50%; }
            .carousel-inner .next        { left:  50%; }
            .carousel-inner .prev		     { left: -50%; }
            .carousel-col                { width: 50%; }
            .active > div:first-child + div { display:block; }
        }

        /*md*/
        @media (min-width: 992px) and (max-width: 1199px) {
            .carousel-inner .active.left { left: -33%; }
            .carousel-inner .active.right { left: 33%; }
            .carousel-inner .next        { left:  33%; }
            .carousel-inner .prev		     { left: -33%; }
            .carousel-col                { width: 33%; }
            .active > div:first-child + div { display:block; }
            .active > div:first-child + div + div { display:block; }
        }

        /*lg*/
        @media (min-width: 1200px) {
            .carousel-inner .active.left { left: -25%; }
            .carousel-inner .active.right{ left:  25%; }
            .carousel-inner .next        { left:  25%; }
            .carousel-inner .prev		     { left: -25%; }
            .carousel-col                { width: 25%; }
            .active > div:first-child + div { display:block; }
            .active > div:first-child + div + div { display:block; }
            .active > div:first-child + div + div + div { display:block; }
        }

        .block {
            width: 306px;
            height: 230px;
        }

        .red {background: red;}

        .blue {background: blue;}

        .green {background: green;}

        .yellow {background: yellow;}
    </style>
</head>

<body>



	<div class="content-wrapper row">

		<main class="main container" role="main">


			<div id="myCarousel" class="carousel slide">
				<!-- Indicators -->
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?php

					$sql = "SELECT * FROM cover_image_title";
					$query = mysqli_query($conn, $sql);
					$i = 0;
					while ($result = mysqli_fetch_assoc($query)) {
						if ($i == 0) {
							?>
							<div class="item active" style="width: 100%; height: auto;">
								<div class="row"><a href="<? echo $result['coverlink'] ?>"> <img style="width: 100%; height: auto;" src="backoffice/<? echo $result['coverImage'] ?>" alt="<? echo $result['coveralt'] ?>"> </a></div>
							</div>
						<? } else { ?>
							<div class="item" style="width: 100%; height: auto;">
								<div class="row"><a href="<? echo $result['coverlink'] ?>"> <img style="width: 100%; height: auto;" src="backoffice/<? echo $result['coverImage'] ?>" alt="<? echo $result['coveralt'] ?>"> </a></div>
							</div>
						<? } ?>
						<?
						$i++;
					} ?>

					<!-- <div class="item active" style="width: 100%; height: auto;">
						<div class="row"><a href="#"> <img style="width: 100%; height: auto;" src="images/silde_image.png" alt="customcones"> </a></div>
					</div>
					<div class="item" style="width: 100%; height: auto;">
						<div class="row"><a href="#"> <img style="width: 100%; height: auto;" src="images/silde_image2.png" alt="customcones"> </a></div>
					</div> -->

				</div>
				<p><a href="#myCarousel" class="left carousel-control" data-slide="prev"><span class="icon-prev"></span><span class="sr-only">Previous</span></a><a href="#myCarousel" class="right carousel-control" data-slide="next"><span class="icon-next"></span><span class="sr-only">Next</span></a></p>


			</div>
			<?php if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {   ?>


			<? } else { ?>
				<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="https://img.lovepik.com/element/40087/8190.png_1200.png" width="40px" />
					ยินดีด้วยคุณได้รับคูปองส่วนลด <U> <a href="javascript:void(0)" onclick="messlide();">คลิกเลย </a></U>
				</div>

			<? } ?>
			<div class="row">
				<div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
					<h2><span>สินค้าโปรโมชั่นด่วน</span></h2>
				</div>
			</div>
			<div class="row popular-products">

				<?php

				$sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  FROM product_main a  ,  product_promotion b  WHERE  a.product_code = b.product_code AND b.product_promo_type = 'promo' AND a.sell_with_web = '1'  ORDER BY a.INSERT_DATE DESC limit 0 , 4";
				$query = mysqli_query($conn, $sql);

				while ($result = mysqli_fetch_assoc($query)) {
					?>

					<div class="col-sm-6 col-md-3 popular-item"><a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"> <img class="cld-responsive img-responsive center-block" src="backoffice/<? echo ($result['image_product'] == "") ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>"> </a>
						<div style="height:20px;">
							<h5><a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code']; ?></a></h5>
						</div>
						<p class="popular-item-desc"><?php echo $result['product_title_th']; ?></p>
						<a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>" class="btn btn-primary">BUY NOW</a>
					</div>

				<?php
				}
				?>
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
			<div class="row popular-products">

				<?php

				$sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product  FROM product_main a  ,  product_promotion b  WHERE  a.product_code = b.product_code AND b.product_promo_type = 'recommen' AND a.sell_with_web = '1'  ORDER BY a.INSERT_DATE DESC limit 0 , 4";
				$query = mysqli_query($conn, $sql);

				while ($result = mysqli_fetch_assoc($query)) {
					?>

					<div class="col-sm-6 col-md-3 popular-item"><a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"> <img class="cld-responsive img-responsive center-block" src="backoffice/<? echo ($result['image_product'] == "") ? 'images/noimage.jpg' : $result['image_product']; ?>" alt="<?php echo $result['product_title_th']; ?>"> </a>
						<div style="height:20px;">
							<h5><a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code']; ?></a></h5>
						</div>
						<p class="popular-item-desc"><?php echo $result['product_title_th']; ?></p>
						<a target="_blank" href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
											&product_category_title_th=<?php echo $result['product_category_title_th']; ?>" class="btn btn-primary">BUY NOW</a>
					</div>

				<?php
				}
				?>
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

                <div class="container">
                    <div class="row">
                        <div class="col-xs-11 col-md-10 col-centered">

                            <div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2500">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="carousel-col">
                                            <div class="block red img-responsive"></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="carousel-col">
                                            <div class="block green img-responsive"></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="carousel-col">
                                            <div class="block blue img-responsive"></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="carousel-col">
                                            <div class="block yellow img-responsive"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Controls -->
                                <div class="left carousel-control">
                                    <a href="#carousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </div>
                                <div class="right carousel-control">
                                    <a href="#carousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
<!--				<div class="col-sm-12 ">-->
<!--					<div class="col-xs-12 ">-->
<!---->
<!--						<div class="container_row">-->
<!--							<div id="carousel" class="slider slider_second">-->
<!--								<div class="slider_viewport">-->
<!--									<div class="slider_list">-->
<!--										--><?php
//
//
//
//
//										$sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) AS image_product FROM product_main a WHERE a.sell_with_web = '1'  ORDER BY INSERT_DATE DESC limit 0 , 24";
//										$query = mysqli_query($conn, $sql);
//
//										while ($result = mysqli_fetch_assoc($query)) {
//											?>
<!---->
<!--											<div class="slider_item">-->
<!--												&nbsp;-->
<!--												<a target="_blank" href="product_detail.php?product_code=--><?php //echo $result['product_code']; ?><!--&product_type_title_th=--><?php //echo $result['product_type_title_th']; ?>
<!--											&product_category_title_th=--><?php //echo $result['product_category_title_th']; ?><!--">-->
<!--													<img src="backoffice/--><?// echo ($result['image_product'] == "") ? 'images/noimage.jpg' : $result['image_product']; ?><!--">-->
<!--												</a>-->
<!--												&nbsp;-->
<!--											</div>-->
<!---->
<!--										--><?php
//										}
//										?>
<!---->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="slider_nav">-->
<!--									<div class="slider_arrow slider_arrow__left"></div>-->
<!--									<div class="slider_arrow slider_arrow__right"></div>-->
<!--								</div>-->
<!---->
<!--								<div class="slider_control-nav" style="display:none;">-->
<!--									All this selectors must be created dynamically. They are here just for example-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!---->
<!---->
<!--					</div>-->
<!--				</div>-->

				<div class="row">
					<div id="index-popular-heading" class="col-sm-12 text-right ">
						<span style="color:red;"><a target="_blank" href="product_all.php">สินค้าทั้งหมด >>></a></span>

					</div>
				</div>
			</div>

			<div class="row">
				<div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
					<h2><span>สุดยอดบริการ ร้านไทยจราจร</span></h2>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4 ">
					<div class="col-xs-12 col-md-12"><img class="cld-responsive img-responsive center-block" src="images/line_circle.png" height="250" width="250" alt="shipping truck icon"></div>
					<div class="col-xs-12 col-md-12 text-center">
						<h2>ขอใบเสนอราคาด่วน! (ไม่เกิน30นาที)</h2>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-xs-12 col-md-12"><img class="cld-responsive img-responsive center-block" src="images/free_delivery.png" height="250" width="250" alt="customer service icon"></div>
					<div class="col-xs-12 col-md-12 text-center">
						<h2>บริการส่งฟรี !! เก็บเงินปลายทาง</h2>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-xs-12 col-md-12"><img class="cld-responsive img-responsive center-block" src="images/free_consult.jpg" height="250" width="250" alt="customer service icon"></div>
					<div class="col-xs-12 col-md-12 text-center">
						<h2>ปรึกษาบริการ ดูหน้างาน วัดหน้างาน ฟรี!!</h2>
					</div>
				</div>
			</div>

			<div class="row index-popular-products" style=" background-color: #c93334;">
				<div class="col-sm-12 text-center index-popular-products">
					<img src="images/youtube_logo.png">
					<h2><span style="color: #ffffff;">วีดีโอตัวอย่างสินค้า ของร้านไทยจราจร</span></h2>
				</div>
			</div>

			<div class="row">

				<div class="container_row">
					<div id="carousel2" class="slider slider_second">
						<div class="slider_viewport">
							<div class="slider_list">

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
						</div>
						<div class="slider_nav">
							<div class="slider_arrow slider_arrow__left"></div>
							<div class="slider_arrow slider_arrow__right"></div>
						</div>
						<div class="slider_control-nav" style="display:none;">
							All this selectors must be created dynamically. They are here just for example
						</div>
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

				<div class="col-sm-6 ">


					<?
					$sql = "SELECT * FROM customer_logo_page";
					$query = mysqli_query($conn, $sql);

					while ($result = mysqli_fetch_assoc($query)) {
						?>
						<div class="col-sm-2 index-popular-products">
							<a href="<? echo $result['linktestimo'] ?>"><img class="cld-responsive img-responsive center-block" src="<? echo 'backoffice/' . $result['image_logo'] . '' ?>"></a>
						</div>

					</div>
				<? } ?>


			</div>

			<style>
				div.index_customer {
					background-image: url('images/bgdivindex.jpg');
					width: 100%;
					/* max-width: 620px; */
					height: 320px;
					text-align: center;
					border-radius: 50px;


				}


				.img_customer {
					display: block;
					margin-left: auto;
					margin-right: auto;

					bottom: 130px;
					left: 47%;
					position: absolute;
				}
			</style>

			<div class="row ">

				<div class="col-sm-12 ">
					<div class="index_customer">

						<div class="img_customer">
							<img src="images/circled-user-male-skin-type-1-2.png" width="50px" />
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

				<div class="container_row">
					<div id="carousel3" class="slider slider_second">
						<div class="slider_viewport">
							<div class="slider_list">

								<?php




								$sql = "SELECT * FROM testimo   ORDER BY INSERT_DATE DESC ";
								$query = mysqli_query($conn, $sql);

								while ($result = mysqli_fetch_assoc($query)) {
									?>

									<div class="slider_item">
										<div align="center">
											<div class="card" style="width:300px; height:300px;">
												<div class="front">
													<img src="backoffice/<?php echo $result['img_testimo']; ?>" style="width:300px; height:300px;" />
												</div>
												<div class="back" align="center">
													<div class="box-back-filp">
														<div class="img-back-filp">
															<a href="testimo_detail.php?id_testimo=<?php echo $result['id_testimo']; ?>" target="_blank">
																<!-- <img src="images/link_icon1.png"> -->
																<img src="backoffice/<?php echo $result['img_testimo']; ?>" style="width:222; height:222px;" />

															</a>
															<p style="color:#fff; padding-top:20px; width text-align:center; height:78px;"><?php echo $result['head_testimo']; ?></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								<?
								}
								?>





							</div>
						</div>

						<div class="slider_nav">
							<div class="slider_arrow slider_arrow__left"></div>
							<div class="slider_arrow slider_arrow__right"></div>
						</div>
						<div class="slider_control-nav" style="display:none;">
							All this selectors must be created dynamically. They are here just for example
						</div>
					</div>
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

								<img src="images/getafreequote.png">
								<p style="color:#fff; padding-top:20px; width text-align:center;">Goto Get A Free Quote</p>
							</div>
						</div>
					</div>

				</div>

			</div>
			<?

			include 'listblogpage.php';
			?>




		</main>
	</div>
	<br /><br />
	<script>
		var w = window.innerWidth;
		var itemNumber = 1;
		if (w > 800) {
			itemNumber = 4;
		}



		var $slider = $('#slider').slider();
		var $carousel = $('#carousel').slider({
			interval: 3000,
			items: itemNumber,
			loop: true,
			imgWidth: 315,
			callback: function(number) {

			}
		});

		var $carousel = $('#carousel2').slider({
			interval: 9000,
			items: itemNumber,
			loop: true,
			imgWidth: 315,
			callback: function(number) {

			}
		});

		var $carousel = $('#carousel3').slider({
			interval: 9000,
			items: itemNumber,
			loop: true,

			callback: function(number) {

			}
		});


		$(".card").flip({
			axis: 'y',
			trigger: 'hover'
		});
	</script>
    <script>
        $('.carousel[data-type="multi"] .item').each(function() {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < 2; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
    <script src="js/slider.js"></script>

    <script src="js/filp.js"></script>
    <script>
        function messlide() {

            //location.href = 'register.php';

        }
    </script>

	<?
	mysqli_close($conn);
	include 'footer.php';
	?> 


	


</body>