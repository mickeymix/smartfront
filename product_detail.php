<?php session_start(); ?>
<?php
include 'backoffice/conn.php';

if(!empty($_GET)) {
    if(!empty($_GET['action'])){
        if ($_GET["action"] == "logout") {
            session_destroy();
            header("Location: index.php");
        }
    }
}

$product_code =  $_GET["product_code"];

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");

$sql = "SELECT * FROM product_main where product_code='" . $_GET["product_code"] . "'";
$query = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($query)) {
    $product_title_th = $result['product_title_th'];
    $product_description_th = $result['product_description_th'];
    $content_prod_th = $result['content_prod_th'];

    $headline = $result['headline'];
    $sub_headline = $result['sub_headline'];
    $id_valiation = $result['valiation_id'];
    $freight = $result["freight"];
    $website_title = $result["website_title"];
    $keyword = $result["keyword"];
    $youtube = $result["youtube"];
    $tag_google = $result["tag_google"];
}

$sql1 = "SELECT * FROM valiation_master where vali_id='$id_valiation'";
$query = mysqli_query($conn, $sql1);
while ($result1 = mysqli_fetch_assoc($query)) {
    $vali_one = $result1["vali_one"];
    $vali_two = $result1["vali_two"];
    $vali_three = $result1["vali_three"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">

    <script>
        <?php 
        echo $tag_google;
        ?>
    </script>

    <title><?php echo $product_title_th; ?><?php echo $headline; ?></title>
    <meta name="Keywords" content="<?php echo $keyword; ?>"/>
    <meta name="description" content="<?php echo $sub_headline; ?>"/>
    <meta charset="utf8">
    <?php 
    include 'header.php';
    ?>
    <link rel="stylesheet" media="screen, projection" href="css/drift-basic.css">
    <link href="css/application.css" rel="stylesheet"/>
    <link href="css/product_detail.css" rel="stylesheet"/>

    <script src="js/jquery.fancybox.js"></script>
    <script src="js/jquery-2.2.4.min.js"></script>

    <div class="content-wrapper row">
        <nav class="sidebar">
            <div class="sideNavElement">
                <img id="acceptGovPOsLogo" src="images/weacceptgop-logo.png"
                     alt="We Accept Government Purchase Orders"/>
            </div>
        </nav>

        <main class="main container" role="main">

            <div class="row tss-breadcrumbs dont-print">
                <div class="col-xs-12"><a href="index.php">Home</a><a
                            href="javascript:void(0)"><?php echo $_GET["product_category_title_th"]; ?></a> &nbsp;&nbsp;>&nbsp;&nbsp;<a
                            href="javascript:void(0)"><?php echo $_GET["product_type_title_th"]; ?></a></div>
            </div>
            <br/>

            <div class="row">
                <div class="col-sm-12">
                    <div class="col-xs-12 head-line-pd">
                        <h1 id="ProductDisplayHeadline"><?php echo ($headline == "") ? "จะดีกว่ามั้ย ? กรวยจราจร ซื้อทีเดียวใช้ได้ยาวถึง 5 ปี!" : $headline; ?></h1>
                    </div>
                </div>
            </div>

            <?php 
            include 'product_sale_up.php';
            ?>

            <article itemscope itemtype="http://schema.org/Product" class="item-details">
                <div class="row" id="productDetailTitleRow">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="hidden" name="SizeOptionChanged" id="SizeOptionChanged" value="false"/>
                                <input type="hidden" name="runSizeSelectionTest" id="runSizeSelectionTest"
                                       value="false"/>
                                <h6 id="ProductDisplayName-get"
                                    itemprop="name itemReviewed"><?php echo $product_title_th; ?></h6>
                                <h5  id="ProductDisplayCode-get">
                                    รหัสสินค้า :<?php echo $_GET["product_code"]; ?>
                                </h5>

                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript" src="js/jquery.mobile.navigate.min.js"></script>
                <script>
                    //Get Product Name for shipping modalYoutube when modalYoutube opens
                    $(document).ready(function () {
                        $('#shipping-modalYoutube').on('shown.bs.modalYoutube', function (e) {
                            var displayName = $("#ProductDisplayName-get").text();
                            $('#ProductDisplayName-set').text(displayName);
                        });
                    });
                </script>
                <div id="addToCartResult"></div>

                <!-- check for video tab, get tab html/name (for videos in image gallery) -->
                <div class="detailsPartial" id="replace_cdf8cffb19004750975e00212a7ca1b3">
                    <!-- The Modal -->
                    <div id="myModal" class="modalYoutube">
                        <!-- Modal content -->
                        <div class="modalYoutube-content">
                            <div class="modalYoutube-header">
                                <span class="close">&times;</span>
                            </div>
                            <div class="modalYoutube-body">
                                <iframe width="100%" height="480"
                                        src="<?php echo str_replace("watch?v=", "embed/", $youtube); ?>" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <div class="modalYoutube-footer">
                            </div>
                        </div>
                    </div>

                    <!-- Modal for "fullscreen" video -->
                    <div class="modalYoutube" id="videoGallery-modalYoutube" tabindex="-1" role="dialog">
                        <div class="modalYoutube-dialog" role="document">
                            <div class="modalYoutube-content">
                                <div class="modalYoutube-body text-center">
                                    <button id="gallery-video-close" type="button" class="close"
                                            data-dismiss="modalYoutube" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="product-detail-page-main">
                        <section class="col-sm-6 prod-detail-gallery">
                            <div class="gallery-main row">
                                <div class="gallery-main-image col-lg-10 col-lg-push-2" style="overflow: hidden;">

                                    <div class="gallery-main-inner full">

                                        <div class="image-overlay">
                                            <div class="image-overlay-center-clickOnly">
                                                <span class="glyphicon glyphicon-zoom-in"></span>
                                            </div>
                                        </div>

                                        <span class="image-helper left-pos right-pos"></span>
                                        <div id="prevImage" class="onImageNav dont-print" onclick="prvimg();"><span
                                                    class="glyphicon glyphicon-chevron-left"></span></div>

                                        <?php
                                        $conn = mysqli_connect($host, $user, $pass, $dbname);

                                        mysqli_set_charset($conn, "utf8");

                                        $sql = "SELECT image FROM product_image WHERE product_code='" . $_GET["product_code"] . "' limit 1";
                                        $query = mysqli_query($conn, $sql);
                                        $chkimg = "";

                                        while ($result = mysqli_fetch_assoc($query)) {
                                            $chkimg = $result['image'];
                                            ?>

                                            <img itemprop="image"
                                                 src="backoffice/<?php echo $result['image']; ?>?w=1200&amp;ch=DPR&amp;dpr=2"
                                                 alt="<?php echo $product_title_th; ?>"
                                                 data-zoom="backoffice/<?php echo $result['image']; ?>"
                                                 class="drift-demo-trigger image-toggle magnified cld-responsive"/>

                                            <?php
                                        }
                                        ?>
                                        <div id="show_youtube"></div>
                                        <?php
                                        if ($chkimg == "") {
                                            ?>
                                            <img itemprop="image" src="backoffice/images/noimage.jpg"
                                                 class="image-toggle magnified cld-responsive"/>
                                            <?php
                                        }
                                        ?>

                                        <?php if ($youtube <> '') { ?>
                                            <span id="gallery-video-controls"
                                                  class="glyphicon glyphicon-play-circle hidden dont-print"></span>
                                            <div style="position:relative;" class="dont-print">
                                            <span id="fs-alt-button" class="glyphicon glyphicon-fullscreen hidden"
                                                  data-toggle="modalYoutube"
                                                  data-target="#videoGallery-modalYoutube"></span>
                                            </div>
                                            <span id="myBtn" style="display:none;"
                                                  class="youtube-play glyphicon glyphicon-play-circle dont-print"></span>
                                        <?php } ?>

                                        <div id="nextImage" class="onImageNav dont-print" onclick="nextimg();"><span
                                                    class="glyphicon glyphicon-chevron-right"></span></div>

                                        <div class="imageText-Container row hidden-xs hidden-sm text-center">
                                            <span class="imageText freeHardware-text"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="imageText-Container col-lg-10 col-lg-push-2 visible-xs visible-sm text-center">
                                    <span class="imageText freeHardware-text"></span>
                                </div>

                                <div id="imageThumbnailWrapper" class="col-md-12 col-lg-2 col-lg-pull-13">

                                    <?php
                                    $sql = "SELECT COUNT(image) AS count_img FROM product_image WHERE product_code='" . $_GET["product_code"] . "'";
                                    $query = mysqli_query($conn, $sql);
                                    $count_img = 0;
                                    while ($result = mysqli_fetch_assoc($query)) {
                                        $count_img = $result['count_img'];
                                    }
                                    ?>

                                    <div id="imageThumbnailMask" class=""
                                         style="min-height: 200px">
                                        <div id="imageThumbnailCarousel" class="gallery-thumbnail previews">
                                            <?php

                                            $sql = "SELECT image FROM product_image WHERE product_code='" . $_GET["product_code"] . "'";
                                            $query = mysqli_query($conn, $sql);
                                            $i = 0;
                                            while ($result = mysqli_fetch_assoc($query)) {
                                                $i++;
                                                ?>
                                                <a id="imageselected" name="imageselected" data-count="<? echo $i; ?>"
                                                   class="<?php if ($i == 1) {
                                                       echo selected;
                                                   } ?> imgprd" data-full="backoffice/<? echo $result['image']; ?>">
                                                    <div class="col-xs-3 col-md-3 col-lg-12">
                                                        <div class="gallery-thumnail-wrapper">
                                                            <img data-src="backoffice/<? echo $result['image']; ?>"
                                                                 src="backoffice/<? echo $result['image']; ?>"
                                                                 class="image-toggler active cld-responsive">
                                                            <div class="imageText-hidden"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if ($youtube <> '') {
                                                $sql = "SELECT image FROM product_image WHERE product_code='" . $_GET["product_code"] . "' limit 1";
                                                $query = mysqli_query($conn, $sql);

                                                while ($result = mysqli_fetch_assoc($query)) {

                                                    ?>
                                                    <a data-count="<?php echo $i + 1; ?>"
                                                       class="imgprd" data
                                                       data-full="backoffice/<?php echo $result['image']; ?>">
                                                        <div class="col-xs-3 col-md-3 col-lg-12">
                                                            <div class="gallery-thumnail-wrapper">
                                                                <img data-src="backoffice/<?php echo $result['image']; ?>"
                                                                     src="images/yt_logo_rgb_light.png"
                                                                     class="image-toggler active cld-responsive">
                                                                <div class="imageText-hidden"></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="col-sm-6 detail">
                            <div>
                                <ul>
                                    <li class="row">
                                        <div id="quickFacts-test" class="col-xs-12 col-md-12 quick-facts"
                                             style="margin-bottom:0px;">
                                            <div class="quick-facts printAtFullWidth">
                                                <h2 id="ProductDisplaySubHeadline"> <?php echo ($sub_headline == "") ? "SUB HEADLINE" : $sub_headline; ?></h2>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="row">
                                        <div id="quickFacts-test" class="col-xs-12 col-md-12 quick-facts"
                                             style="margin-bottom:0px;">
                                            <div class="quick-facts printAtFullWidth" id="ProductDisplayDescription">
                                                <?php echo ($product_description_th == "") ? "NO Description" : $product_description_th; ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product-quantity-actions row dont-print">
                                    </li>
                                </ul>
                            </div>
                            
                            <?php if ($vali_one != '') { ?>
                                <div class="container_row">
                                    <div class="col col-lg-1">
                                        <h5><?php echo $vali_one ?></h5>
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <?php $counterOne = 0 ?>
                                        <?php $sql1 = "SELECT * FROM valiation_answer_master where v_ori_id='$id_valiation' and v_status_active = 'true'";
                                        $query = mysqli_query($conn, $sql1);
                                        while ($result1 = mysqli_fetch_assoc($query)) { ?>
                                            <button class="smartvaliation label <?php if ($counterOne <= 0) { ?>label-danger<?php } else { ?>label-default<?php } ?> label-outlined "><?php echo $result1["v_option_one"] ?></button>
                                            <?php $counterOne++ ?>
                                        <?php } ?>
                                    </div>
                                    <br> <br>
                                    <?php if ($vali_two != '') { ?>
                                        <div class="col col-lg-1">
                                            <div style="text-align: center;"><h5><? echo $vali_two ?></h5></div>
                                        </div>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <?php $counterTwo = 0 ?>
                                            <?php $sql1 = "SELECT * FROM valiation_answer_master where v_ori_id='$id_valiation' and v_status_active = 'true'";
                                            $query = mysqli_query($conn, $sql1);
                                            while ($result1 = mysqli_fetch_assoc($query)) { ?>

                                                <button class="smartvaliation2 label <?php if ($counterTwo <= 0) { ?>label-danger<?php } else { ?>label-default<?php } ?> label-outlined"><?php echo $result1["v_option_two"] ?></button>
                                                <?php $counterTwo++ ?>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                    <br> <br>

                                    <?php if ($vali_three != '') { ?>
                                        <div class="col col-lg-1">
                                            <div style="text-align: center;"><h5><?php echo $vali_three ?></h5></div>
                                        </div>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <?php $counterThree = 0 ?>
                                            <?php $sql1 = "SELECT * FROM valiation_answer_master where v_ori_id='$id_valiation' and v_status_active = 'true'";
                                            $query = mysqli_query($conn, $sql1);
                                            while ($result1 = mysqli_fetch_assoc($query)) { ?>

                                                <button class="smartvaliation3 label <?php if ($counterThree <= 0) { ?>label-danger<?php } else { ?>label-default<?php } ?> label-outlined"><?php echo $result1["v_option_three"] ?></button>
                                                <?php $counterThree++ ?>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <br/>
                            <form action="product_add_order_frm.php" method="get" name="addProductOrderFrm" id="addProductOrderFrm">
                                <div style="display: flex;  justify-content: center;">
                                    <input type="hidden" name="product_code" id="product_code" value="<?php echo $product_code ?>">
                                    <img id="clickOrder" name="clickOrder" src="images/quotation.png"
                                        style="width: 70%;" onclick="addProductOrder()">                       
                                </div>
                                <div style="display: flex;  justify-content: center;">
                                    <img id="clickLine" name="clickLine" src="images/consult_product_detail.png"
                                        style="width: 70%">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tabWrapper reviewReload">
                    <section class="row tabWrapper-inner pageBreakAfter">
                        <div class="col-sm-12">
                            <h2 style="cursor:pointer;">
                                <a class="tab-link tab-link-description" data-toggle="collapse"
                                   data-target="#tab-description">
                                    Description
                                    <span id="glyph-description"
                                          class="glyphicon glyphicon-rotate glyphicon-chevron-down glyphicon-rotate-180"></span>
                                </a>
                            </h2>
                            <hr/>
                            <div id="tab-description" class="collapse in" itemprop="description">
                                <?php echo ($content_prod_th == "") ? "NO Content" : $content_prod_th; ?>
                            </div>
                        </div>
                    </section>

                    <div id="RelatedProductsTabWrapper">
                        <section class="row tabWrapper-inner">
                            <div class="col-sm-12 product-list related-product-list">
                                <h2 style="cursor:pointer;">
                                    <a class="tab-link tab-link-relatedProducts" data-toggle="collapse"
                                       data-target="#tab-relatedProducts">
                                        Related Products <span id="glyph-relatedProducts"
                                                               class="glyphicon glyphicon-chevron-up"></span>
                                    </a>
                                </h2>
                                <div class="col-xs-12 ">
                                    <div class="container_row">
                                        <div id="tab-relatedProducts" class="collapse in">
                                            <div id="carousel" class="slider slider_second">
                                                <div class="slider_viewport">
                                                    <div class="slider_list">
                                                        <?php
                                                        $sql = "SELECT 
                                                a.product_code_related , a.id_related
                                                ,(SELECT image FROM product_image where a.product_code_related = product_code  LIMIT 1 ) AS img
                                                ,(SELECT product_type_title_th FROM product_main where a.product_code_related = product_code  LIMIT 1 ) AS product_type_title_th
                                                ,(SELECT product_category_title_th FROM product_main where a.product_code_related = product_code  LIMIT 1 ) AS product_category_title_th
                                                ,(SELECT product_title_th FROM product_main where a.product_code_related = product_code  LIMIT 1 ) AS product_title_th
                                                FROM product_related a
                                                WHERE product_code ='" . $_GET["product_code"] . "' 
                                                ORDER BY  a.insert_date  DESC";
                                                        $query = mysqli_query($conn, $sql);
                                                        $i = 0;
                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                            $i++;
                                                            ?>
                                                            <div class="slider_item">
                                                                <a target="_blank"
                                                                   href="product_detail.php?product_code=<?php echo $result['product_code_related']; ?>&product_type_title_th=<?php echo $result['product_code_related']; ?>
                                                &product_category_title_th=<?php echo $result['product_category_title_th']; ?>">
                                                                    <img src="backoffice/<?php echo ($result['img'] == "") ? 'images/noimage.jpg' : $result['img']; ?>" style="width: 180px; heigth:180px;">
                                                                </a>
                                                                <div style="height:20px; ">
                                                                    <h5><a target="_blank"
                                                                           href="product_detail.php?product_code=<?php echo $result['product_code_related']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
                                                            &product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code_related']; ?></a>
                                                                    </h5>
                                                                </div>
                                                                <p class="popular-item-desc"
                                                                   style="width:300px; text-align:left; "><?php echo $result['product_title_th']; ?></p>
                                                                <a style="width:280px" target="_blank"
                                                                   href="product_detail.php?product_code=<?php echo $result['product_code_related']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
                                                            &product_category_title_th=<?php echo $result['product_category_title_th']; ?>"
                                                                   class="btn btn-primary">BUY NOW</a>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <input type="hidden" id="count_rel" value="<?php echo $i; ?>">
                                                    </div>
                                                </div>
                                                <div class="slider_nav">
                                                    <div class="slider_arrow slider_arrow__left"></div>
                                                    <div class="slider_arrow slider_arrow__right"></div>
                                                </div>
                                                <div class="slider_control-nav" style="display:none;">
                                                    All this selectors must be created dynamically. They are here just
                                                    for example
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </article>
        </main>
    </div>

    <script src="js/Drift.js"></script>
    <script src="js/slider.js"></script>

    <script>
        new Drift(document.querySelector('.drift-demo-trigger'), {
            paneContainer: document.querySelector('.detail'),
            inlinePane: 900,
            inlineOffsetY: -85,
            containInline: true,
            hoverBoundingBox: true
        });

        // Get the modalYoutube
        var modalYoutube = document.getElementById('myModal');

        // Get the button that opens the modalYoutube
        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modalYoutube
        btn.onclick = function () {
            modalYoutube.style.display = "block";
        }

        span.onclick = function () {
            modalYoutube.style.display = "none";
        }

        // When the user clicks anywhere outside of the modalYoutube, close it
        window.onclick = function (event) {
            if (event.target == modalYoutube) {
                modalYoutube.style.display = "none";
            }
        }

        var w = window.innerWidth;
        var itemNumber = 1;
        if (w > 800) {

            var count_rel = $("#count_rel").val();

            if (count_rel > 4) {
                itemNumber = 4;
            } else {
                itemNumber = count_rel;
            }
        }
   
        $('a.imgprd').click(function () {
            console.log('imgprd');
            var largeImage = $(this).attr('data-full');
            var dataCount = $(this).attr('data-count');
            $('.selected').removeClass('selected');
            $(this).addClass('selected');
            $('.full img').hide();
            $('.full img').attr('src', largeImage);
            $('.full img').fadeIn();
            console.log('mdiwdiwdw');
            $('.drift-demo-trigger').attr('data-zoom', largeImage);

            var max = $('.imgprd').length;
            console.log('max' + max);
            if (dataCount == max) {
                $(".youtube-play").css("display", "");
            } else {
                $(".youtube-play").css("display", "none");
            }
        }); // closing the listening on a click

        $(".btn-group > .smartvaliation").click(function () {
            $(".btn-group > .smartvaliation").removeClass("label-danger").addClass("label-default");

            $(this).addClass("label-danger");
            inquiryProductValiation();
        });

        $(".btn-group > .smartvaliation2").click(function () {
            $(".btn-group > .smartvaliation2").removeClass("label-danger").addClass("label-default");

            $(this).addClass("label-danger");
            inquiryProductValiation();
        });

        $(".btn-group > .smartvaliation3").click(function () {
            $(".btn-group > .smartvaliation3").removeClass("label-danger").addClass("label-default");

            $(this).addClass("label-danger");
            inquiryProductValiation();

        });

        function inquiryProductValiation() {

            var valiationOne = $(".btn-group > .smartvaliation.label-danger").text();
            var valiationTwo = $(".btn-group > .smartvaliation2.label-danger").text();
            var valiationThree = $(".btn-group > .smartvaliation3.label-danger").text();
            
            if (valiationTwo !== '') {
                console.log("isnull blank")
            } else if (valiationThree !== '') {
                console.log("isnull blank")
            } else {
                $.post("valiation_product_ajax.php", {
                        'valiationOne': valiationOne,
                        'idValiation':'<?echo $id_valiation?>'
                    }, function (result) {
                    document.getElementById("ProductDisplayName-get").innerHTML = result.productResult['product_title_th'];
                    document.getElementById("ProductDisplayCode-get").innerHTML = "รหัสสินค้า: "+result.productResult['product_code'];
                    document.getElementById("ProductDisplayHeadline").innerHTML = result.productResult['headline'];
                    document.getElementById("ProductDisplaySubHeadline").innerHTML = result.productResult['sub_headline'];
                    document.getElementById("ProductDisplayDescription").innerHTML = result.productResult['product_description_th'];
                    }
                )
            }
        }
        
        function addProductOrder() {
            $("#addProductOrderFrm").submit();
        }

    </script>
    <script src="js/nextprv.js"></script>

<?php
mysqli_close($conn);
include 'footer.php';
?>