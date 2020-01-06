<?php

session_start();

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

$sql = "SELECT * FROM product_main where product_code='" . $product_code . "'";
$query = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($query)) {
    $product_title_th = $result['product_title_th'];
    $product_description_th = $result['product_description_th'];
    $content_prod_th = $result['content_prod_th'];
    $product_category_title_th = $result['product_category_title_th'];
    $product_type_title_th = $result['product_type_title_th'];

    $headline = $result['headline'];
    $sub_headline = $result['sub_headline'];
    $id_valiation = $result['valiation_id'];
    $freight = $result["freight"];
    $website_title = $result["website_title"];
    $keyword = $result["keyword"];
    $youtube = $result["youtube"];
    $tag_google = $result["tag_google"];
}

$sql_product_image  =  "select * from product_image where product_code = '". $product_code ."' limit 1 ";
$queryProductImage  =  mysqli_query($conn, $sql_product_image);
$imageProductSrc = "";
while ($result = mysqli_fetch_assoc($queryProductImage)) {
    $imageProductSrc = $result['image'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $product_title_th; ?><?php echo $headline; ?></title>
  
    <script type="text/javascript" src="js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.mobile.navigate.min.js"></script>
    <script type="text/javascript" src="js/nextprv.js"></script>

    <link rel="stylesheet" media="screen, projection" href="css/drift-basic.css">
    <link href="css/application.css" rel="stylesheet"/>
    <link href="css/product_detail.css" rel="stylesheet"/>
</head>
<body>

    <?php 
    include 'header.php';
    ?>

<div class="content-wrapper row">
        <nav class="sidebar">
            <div class="sideNavElement">
                <img id="acceptGovPOsLogo" src="images/weacceptgop-logo.png"
                     alt="We Accept Government Purchase Orders"/>
            </div>
        </nav>

        <main class="main container" role="main">

            <div class="row tss-breadcrumbs dont-print">
                <div class="col-xs-12">
                    <a href="index.php">Home</a>
                    > 
                    <a href="javascript:void(0)">
                        <?php echo $product_category_title_th; ?>
                    </a>
                    >
                    <a  href="javascript:void(0)">
                        <?php echo $product_type_title_th; ?>
                    </a>
                </div>
            </div>
            <br/>
            
            
            <?php 
            include 'product_sale_up.php';
            ?>

            <form action="product_add_order_service.php" method="post">
                <input type="hidden" name="product_code" id="product_code" value="<?php echo $product_code; ?>">      
                <input type="hidden" name="product_name" id="product_name" value="<?php echo $product_title_th; ?>">      
                <input type="hidden" name="product_image" id="product_image" value="<?php echo $imageProductSrc; ?>">      
                          
                <input type="hidden" name="action" id="action" value="add_order">
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>
                                            <strong>
                                                รหัสสินค้า
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                รูปภาพสินค้า
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                ชื่อสินค้า
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                จำนวน
                                            </strong>
                                        </td>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $product_code; ?>
                                        </td>
                                        <td>
                                            <img itemprop="image"
                                                src="backoffice/<?php echo $imageProductSrc;?>"
                                                alt="<?php echo $product_title_th; ?>"
                                                data-zoom="backoffice/<?php echo $imageProductSrc; ?>"
                                                class="drift-demo-trigger image-toggle magnified cld-responsive"
                                                style="width:120px;"
                                                />
                                        </td>
                                        <td>
                                            <?php echo $product_description_th; ?>
                                        </td>
                                        <td>
                                            <input type="text" name="product_amount" id="product_amount" class="form-control text-center" value="1">
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">เพิ่มรายการสินค้า</button>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
            </form>
        </main>
    </div>

<?php
include 'footer.php';
mysqli_close($conn);
?>
</body>
</html>