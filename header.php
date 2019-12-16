<?php 
ob_start(); 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="theme-color" content="#53a93f">
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta http-equiv="Accept-CH" content="DPR, Viewport-Width, Width">

<link href="css\bundleAll.css?v=l9iu5N6o2fdqe0GWMhkNOcAfpZ4KAOqcc1MArYfnyxE1" rel="stylesheet">
<link href="css\social.css" rel="stylesheet">
<link rel="stylesheet" href="css\header.css">

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php
error_reporting(~E_NOTICE);
include 'backoffice/conn.php';
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

if ($_GET["action"] == "logout") {
    session_destroy();
    header("location:index.php");
}

if ($_GET["action"] == "logoutfacebook") {
    echo "<script> logoutMyFB() </script>";
    session_destroy();
    header("location:index.php");
}
?>
<script type="text/javascript">

    $("#myCarousel").on("swiperight", function (event) {
        $(this).carousel('prev');
    });
    $("#myCarousel").on("swipeleft", function (event) {
        $(this).carousel('next');
    });

    $("#modal-category-video").on('hide.bs.modal', function () {
        $("#yt-player iframe").attr("src", $("#yt-player iframe").attr("src"));
    });

    function logoutMyFB() {
        FB.logout(function () {
            window.location.reload()
        });
        return false;
    }
</script>
<!-- Google Tag Manager -->
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-WKBNDBC');</script>
<!-- End Google Tag Manager -->
</head>


<div id="mask"></div>
<div id="modalWrapper"></div>

<?php
    include 'menu_mobile.php';
?>

<div id="site-wrapper" class="site-wrapper container">
    <!--[if lt IE 9]>
    <p class="browsehappy"><strong>WARNING:</strong> You are using an <strong>outdated</strong> browser. Please <b><a
            href="http://browsehappy.com/">upgrade your browser</a></b> to improve your experience.</p>
    <![endif]-->

    <script type="text/javascript" src="js\jquery.mobile.navigate.min.js"></script>
    <header role="banner" class="site-header dont-print">
        <div class="navbar-top row dont-print">
            <nav class="site-navigation">
                <h2 class="sr-only">Site Navigation</h2>
                <ul class="header-links list-inline">
                    <li id="headerNavHomeLink">
                        <a href="index.php">หน้าหลัก</a>
                    </li>
                    <li id="headerNavInstructionsLink">
                        <a href="product_all.php">สินค้า</a>
                    </li>
                    <li id="headerNacResourceLink">
                        <a target="_blank" href="article.php">บทความ</a>
                    </li>
                    <li id="headerNavTaxLink">
                        <a target="_blank" href="/service_menu.php?common_smart_id=107">ทำไมต้องเรา?</a>
                    </li>
                    <li id="headerNavAboutLink">
                        <a target="_blank" href="/service_menu.php?common_smart_id=108">ติดต่อเรา</a>
                    </li>
                    <li id="headerNavContactLink">
                        <a href="#">ใบเสนอราคา</a>
                    </li>
                    <li id="headerNavContactLink">
                        <a href="#">เปลี่ยนภาษา</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="branding row dont-print">
            <div class="branding-logo dont-print">
                <div style="display:inline-block;">
                    <font class="texttitleRight">02-114-7006</font><br>
                    <font class="texttitleRight">087-022-4003</font>
                </div>
                <div style="display:inline-block;vertical-align:top;">
                    <a href="index.php">
                        <h2 class="sr-only">Traffic Safety Store</h2>
                        <img width="40px" data-src="images/logotf.png" src="images/logotf.png"
                             alt="Traffic Safety Store Logo">
                    </a>
                </div>
                <!-- <a href="index.php">
                    <h2 class="sr-only">Traffic Safety Store</h2>
                    <img width="40px" data-src="images/logotf.png" src="images/logotf.png" alt="Traffic Safety Store Logo" >
                </a> -->
            </div>
            <a href="index.php">
                <p class="font-logo">
                    <font class="font-logo" color="white">ร้านไทยจราจร</font>
            </a>
            </p>
            <p class="texttitleCenter">
                <font class="texttitleCenter">ผู้นำด้านอุปกรณ์จราจรที่ทันสมัย <br> และครบวงจรมากที่สุดในประเทศไทย</font>
            </p>

            <!-- <p class="texttitleRight">
                    <font class="texttitleRight">ผู้นำด้านอุปกรณ์จราจรที่ทันสมัย <br> และครบวงจรมากที่สุดในประเทศไทย</font>
                </p> -->
            <div class="branding-support" style="z-index: 3;">
                <div style="clear: none; float: right;">
                    <!--
                    <div class="valueProp">
                        <p style="margin-top: 0px;margin-bottom: 0px;line-height:35px;text-align: right;">Traffic Safety Supplies<br>Delivered FAST!</p>
                    </div>
-->
                </div>
            </div>
        </div>


        <nav class="navbar navbar-default row" id="header-nav-main">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#header-nav-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="header-nav-collapse">

                    <?php
                    include 'menu.php';
                    ?>


                    <div id="search-bar" class="search-bar dont-print">
                        <div class="search col-sm-4 col-lg-6">
                            <div class="search-group input-group">
                                <input class="search-field form-control" type="text" id="search-term" name="search-term"
                                       placeholder="Search for cones, bumps, signs, etc...">
                                <img class="search-icon dont-print cld-responsive"
                                     src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/images/search-icon.png"
                                     data-src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_3.0,q_auto:best,w_auto/v47/images/search-icon.png"
                                     alt="Search Icon">
                                <span class="search-button input-group-btn">
<!--                                    <a href="javascript:DoSearch('/search');" class="btn btn-dark" type="button">Go</a>-->
                                    <button class="btn btn-dark" onclick="onSearchProductClick()">ค้นหา</button>
                                </span>
                            </div>
                        </div>
                        <a href="#" class="store-departments btn btn-primary">Shop Now</a>
                    </div>
                    <nav class="store dont-print">
                        <header class="sr-only">
                            <h2>Your Cart</h2>
                        </header>
                        <ul class="store-links">
                            <?php if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) { ?>
                                <div class="dropdown">
                                    <li class="store-user">
                                        <a href="#">
                                            <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></a>
                                    </li>
                                    <div class="dropdown-content">
                                        <li class="store-cart">
                                            <a href="index.php?action=logout"><span class="glyphicon glyphicon-log-out"
                                                                                    style="color:black"></span>
                                                <font color="black"> Logout </font>
                                            </a>
                                        </li>
                                    </div>
                                </div>


                            <?php } else { ?>
                                <?php if (isset($_SESSION['facebook_id']) && !empty($_SESSION['facebook_id'])) { ?>
                                    <div class="dropdown">
                                        <a href="#">
                                            <?php echo $_SESSION['customer_name'] ?></a>
                                        <div class="dropdown-content">
                                            <li class="store-cart">
                                                <a href="index.php?action=logoutfacebook"><span
                                                            class="glyphicon glyphicon-log-out"
                                                            style="color:black"></span>
                                                    <font color="black"> Logoutfacebook </font>
                                                </a>
                                            </li>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <li class="store-user"><a href="login.php">Login</a> <i>/</i> <a
                                                href="register_smart.php">Register</a></li>
                                <?php } ?>
                            <?php } ?>
                            <li class="store-cart"><a href="#"><img class="cart-icon"
                                                                    src="https://media.trafficsafetystore.com/image/upload/c_limit,dpr_2.0,f_auto,q_auto:best,w_auto/v1/images/cart-icon-2x.png"></a>
                            </li>&nbsp;&nbsp;
                            <li class="order-cart">
                                <div class="item">
                                    <!-- <a href="#" onclick="showProductOrderDetail()"> -->
                                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <?php 
                                            // Display Product Order in cart
                                            $productOrderCount = 0;
                                            for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                                            {
                                                if($_SESSION["product_code"][$i] != "")
                                                {
                                                   $productOrderCount += 1;
                                                }
                                            }
                                      
                                            if($productOrderCount != 0){
                                                echo '<span style="height: 16px;width: 16px" class="notify-badge">'.$productOrderCount.'</span>';    
                                            }
                                        ?>
                                        <img class="cart-icon" src="images/order_form.png" width="30px">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" style="width:400px;">
                                        
                                        <form action="product_add_order_send_email.php" method="post">
                                            <div class="dropdown-header text-center product_show_detail_ordre">
                                                <strong>รายการสินค้าสำหรับเสนอใบราคา</strong>
                                            </div>
                                            <div class="row product_show_detail_ordre">
                                                <div class="col-sm-12">
                                                    <table class='table table-border product_show_detail_ordre'>
                                                        <thead>
                                                            <tr>
                                                                <td class='product_show_detail_ordre'>
                                                                    <strong>
                                                                        รหัสสินค้า
                                                                    </strong>  
                                                                </td>
                                                                <td>
                                                                    <strong>
                                                                        รูปสินค้า
                                                                    </strong>
                                                                </td>
                                                                <td>
                                                                    <strong>
                                                                        ชื่อสินค้า
                                                                    </strong>
                                                                </td>
                                                                <td>
                                                                    <strong>
                                                                        จำนวนสินค้า
                                                                    </strong>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $Total = 0;
                                                            $SumTotal = 0;
                                                            for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                                                            {
                                                                    if($_SESSION["product_code"][$i] != "")
                                                                    {
                                                                        ?>

                                                                            <tr>
                                                                                <td>
                                                                                    <?php echo $_SESSION['product_code'][$i];?>
                                                                                </td>
                                                                                <td>
                                                                                    <img itemprop="image"
                                                                                        src="backoffice/<?php echo $_SESSION['product_image'][$i];?>"
                                                                                        class="drift-demo-trigger image-toggle magnified cld-responsive"
                                                                                        style="width:80px;"
                                                                                        />
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $_SESSION['product_name'][$i];?>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="product_amount" id="product_amount" class="form-control text-center" value="<?php echo $_SESSION['product_amount'][$i];?>">
                                                                                </td>
                                                                            </tr>
                                                                    <?php
                                                                    }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary"> ขอใบเสนอราคา..ด่วน ! (ไม่เกิน 5 นาที) </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </li> &nbsp;&nbsp;
                            <li class="lineAds"><a target="_blank" href="http://line.me/ti/p/@trafficthai"><img
                                            class="cart-icon" src="images/lineAt_icon.png" width="30px"></a></li>&nbsp;&nbsp;&nbsp;

                            <li class="facebookAds"><a target="_blank" href="https://www.facebook.com/trafficthai/"><img
                                            src="images/page_facebook.png" width="30px"></a></li>&nbsp;&nbsp;

                            <li class="store-phone-number" style="display:none;">
                                <div class="phone-number">02-111-5555</div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </nav>
    </header>
    <header class="print-only printAtFullWidth">
        <img src="images\tss_Logo_blue.png" style="max-height: 30px; vertical-align: middle;"
             alt="Traffic Safety Store Logo">
        <span class="pull-right" style="text-align:right; font-size:16px; font-weight:600;">
            <span class="glyphicon glyphicon-link glyphicon-position-static"></span>
            <span class="glyphicon glyphicon-earphone glyphicon-position-static"></span> 02-111-5555
        </span>

    </header>
    <header role="banner" class="dont-print" id="mobile-header" style="padding: 0;">

        <div class="col-xs-4 no-pad dont-print">
            <div class="menu-option" id="mobile-menu-toggle">
                <span class="icon ion-navicon"></span>
            </div>
            <div class="menu-option" id="search-menu-toggle">
                <span class="icon ion-ios7-search"></span>
            </div>
        </div>
        <div class="col-xs-4 text-center no-pad dont-print" id="mobile-logo">
            <div style="display: table-cell; vertical-align: middle; height: 45px;">
                <a href="index.php" class="logo-mobile">
                    <img class="cld-responsive" src="images/logotf.png" alt="Traffic Safety Store Home"
                         style="max-height: 30px; vertical-align: middle; ">
                    ร้านไทยจราจร
                </a>

            </div>
        </div>

        <div class="col-xs-4 text-right no-pad pull-right dont-print">
            <?php if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) { ?>
                <a href="javascript:void(0)" class="menu-option left-border dont-print">
                    <span class="ion-ios7-person-outline icon"></span>
                </a>
            <?php } else { ?>
                <a href="login.php" class="menu-option left-border dont-print">
                    <span class="ion-ios7-person-outline icon"></span>
                </a>
            <?php } ?>
            <a href="javascript:void(0)" class="menu-option dont-print">
                <span class="ion-ios7-cart-outline icon dont-print"></span>
            </a>
        </div>

        <script type="text/javascript">
            var gListToHide, gListToShow; //hack for edge case switching from desktop view to mobile view

            function switchList(listToHide, listToShow) {
                $('#' + listToHide).hide();
                $('#' + listToShow).show(500);
                $("#mobile-menu").scrollTop(0);
            };

            function toggleMobileMenu() {
                $('body').toggleClass('shift-right');
                $("#add-to-cart-floating").css('position', 'relative');
                // switchList(gListToHide, gListToShow); 
                switchList('mobileSubCatsFor-12', 'mobileCats');
            };

            localStorage.mobileMenuOpen = false;
            localStorage.menuClosedViaBackButton = false;
            
            $(document).ready(function () {
                $('#mobile-menu-toggle').click(function () {
                    toggleMobileMenu();
                    localStorage.mobileMenuOpen = !localStorage.mobileMenuOpen;
                    history.pushState(localStorage.mobileMenuOpen, "");
                });
            });

            function showProductOrderDetail() { 
                // alert("ok");
                // On click show showProduct Detail
                $("#showProductOrderDetail").modal('show');
            }

            //on user navigation, trigger the switchList function so the back/forward buttons work as expected
            $(window).on('navigate', function (event, data) {
                var direction = data.state.direction;
                
                if (localStorage.mobileMenuOpen) {
                    event.preventDefault();
                    toggleMobileMenu();
                    localStorage.menuClosedViaBackButton = true;
                } else if (localStorage.menuClosedViaBackButton && !localStorage.mobileMenuOpen) {
                    event.preventDefault();
                    toggleMobileMenu();
                    localStorage.menuClosedViaBackButton = false;
                }
                
            });

            $("#search-menu-toggle").click(function () {
                $("body").toggleClass("show-search");
                $("#sitewideBanner").toggleClass("search-margin")
            })

            function onSearchProductClick() {
                const nameInput = $("#search-term").val();

                if ('' !== nameInput) {
                    location.href = "search_product.php?productSearch=" + nameInput;
                } else {
                    alert("กรุณาใส่ชื่อหรือรหัสสินค้าที่ต้องการจะค้นหา")
                }
            }

            $(document).on("keypress", "input", function (e) {
                if (e.which === 13) {
                    onSearchProductClick()
                }
            });

        </script>
        <div class="mobile-search col-xs-12 dont-print">
            <form action="/Search" method="GET">
                <input type="search" name="q" class="form-control" placeholder="Search for a product...">
            </form>
        </div>
    </header>

    <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKBNDBC"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->