<?php session_start(); ?>
<?php
include 'backoffice/conn.php';


if ($_GET["action"] == "logout") {
    session_destroy();
    header("Location: index.php");
}
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">

    <title>ร้านไทยจราจร</title>

    <?php
    include 'header.php';


    $keywordForSearch = $_GET["productSearch"];

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    mysqli_set_charset($conn, "utf8");
    ?>

    <div class="content-wrapper row">

        <main class="main container" role="main">
            <br/><br/>
            <div class="row">
                <div id="index-popular-heading" class="col-sm-12 text-center">
                    <h2><span>สินค้าจราจรที่เกี่ยวกับ "<?php echo $keywordForSearch ?>"</span></h2>
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
                $sql = "SELECT a.product_type_title_th,a.product_category_title_th,a.product_code ,a.product_title_th ,a.product_description_th ,(SELECT image FROM product_image WHERE a.product_code = product_code ORDER BY INSERT_DATE ASC LIMIT 1 ) 
AS image_product,a.product_category_code FROM product_main a WHERE a.sell_with_web = '1' AND product_title_th  LIKE '%$keywordForSearch%' OR product_code LIKE '%$keywordForSearch%' OR keyword LIKE '%$keywordForSearch%'  ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
                $query = mysqli_query($conn, $sql);

                while ($result = mysqli_fetch_assoc($query)) {
                    ?>

                    <div class="col-sm-6 col-md-3 popular-item">

                        <?php
                        if ($result['product_category_code'] === 'SPECIAL') { ?>
                            <a href="spacial_product.php?product_code=<?php echo $result['product_code'] ?>"
                              > <img class="cld-responsive img-responsive center-block"
                                                             src="backoffice/<?php echo ($result['image_product'] == "") ? 'images/noimage.jpg' : $result['image_product']; ?>"
                                                             alt="<?php echo $result['product_title_th']; ?>"> </a>
                        <?php } else { ?>
                            <a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>">
                                <img class="cld-responsive img-responsive center-block" src="backoffice/<?php
                                echo ($result['image_product'] == "") ? 'images/noimage.jpg' : $result['image_product']; ?>"
                                     alt="<?php echo $result['product_title_th']; ?>"> </a>
                        <?php
                        } ?>

                        <div style="height:20px;">
                            <h5>
                                <a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"><?php echo $result['product_code']; ?></a>
                            </h5>
                        </div>
                        <p class="popular-item-desc"><?php echo $result['product_title_th']; ?></p>
                        <?php
                        echo "<script>console.log('dsdsdsdsdsd ".$result['product_category_code']."')</script>";
                        if ($result['product_category_code'] === 'SPECIAL') { ?>
                            <a href="spacial_product.php?product_code=<?php echo $result['product_code'] ?>"
                               class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>
                        <?php } else { ?>
                            <a href="product_detail.php?product_code=<?php echo $result['product_code']; ?>&product_type_title_th=<?php echo $result['product_type_title_th']; ?>
							&product_category_title_th=<?php echo $result['product_category_title_th']; ?>"
                               class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>
                        <?php
                        } ?>
                    </div>

                    <?php
                }
                ?>
            </div>
            <?php

            $sql2 = "SELECT id FROM product_main WHERE sell_with_web = '1' AND product_title_th  LIKE '%$keywordForSearch%' OR product_code LIKE '%$keywordForSearch%' OR keyword LIKE '%$keywordForSearch%' ";
            $query2 = mysqli_query($conn, $sql2);
            $total_record = mysqli_num_rows($query2);
            if ($total_record > 1) {
                $total_page = ceil($total_record / $perpage);

                ?>
                <div style="text-align: center;">
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="index.php?page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>

                                <?php
                                if ($i == $page) {
                                    ?>
                                    <li class='active'><a
                                                href="search_product.php?productSearch=<?php echo $keywordForSearch ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="search_product.php?productSearch=<?php
                                        echo $keywordForSearch ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                }
                                ?>

                            <?php } ?>
                            <li>
                                <a href="search_product.php?productSearch=<?php echo $keywordForSearch ?>&page=<?php echo $total_page; ?>"
                                   aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php } ?>


            <?php $sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)) {
                ?>?>
                <div class="row">
                    <div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
                        <h2><span><?php echo  $result['service_top_title']?></span></h2>
                    </div>
                </div>

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
            <?php } ?>
        </main>
    </div>

<?php
mysqli_close($conn);
include 'footer.php';
?>