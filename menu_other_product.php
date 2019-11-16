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

    <div class="content-wrapper row">

        <main class="main container" role="main">
            <br/><br/>
            <div class="row">
                <div class="row">
                    <div id="index-popular-heading" class="col-sm-12 text-center">
                        <h2><span>สินค้าเพิ่มเติม</span></h2>
                    </div>
                </div>
                <div  class="col-sm-12 ">
                    <header>
                        <h1><? echo $_GET['menu_keyword']; ?></h1>
                    </header>
                    <br/>
                </div>
                <div  class="col-sm-12 text-center">
                    <ul class="product-list row">

                        <?
//                        $id_menu =  $_GET['id_menu'];
                        $sql = "SELECT * FROM menu WHERE menu_status ='H'";
                        $query = mysqli_query($conn, $sql);

                        while ($result = mysqli_fetch_assoc($query)) {



                            ?>


                            <li class="product-list-item col-xs-6 col-sm-4 col-md-3 col-lg-2" style="height: 447px;">
                                <a target="_blank" href="menu_main.php?id_menu=<?php echo $result['id_menu']; ?>&menu_keyword=<?php echo $result['menu_keyword']; ?>" class="product-list-link listingSaleNoticeLink ">

                                    <img class="product-list-thumbnail cld-responsive"  src="backoffice/<?php echo $result['menu_img']; ?>" alt="<?php echo $result['menu_name']; ?>">
                                    <span class="product-list-name" style="height: 66px; "><?php echo $result['menu_name']; ?></span>
                                </a>

<!--                                <p class="product-list-desc" style="height: 48px;text-align: left;">--><?php //echo $result['desc_sub_menu']; ?>

                                </p>
                                <a class="btn btn-info btn-sm listingSaleNoticeLink" target="_blank" href="menu_main.php?id_menu=<?php echo $result['id_menu']; ?>&menu_keyword=<?php echo $result['menu_keyword']; ?>">ดูรายละเอียด</a>
                            </li>



                            <?
                        }
                        ?>



                    </ul>

                </div>
            </div>



            <?   $sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)) {
                ?>?>
                <div class="row">
                    <div id="index-popular-heading" class="col-sm-12 text-center index-popular-products">
                        <h2><span><?echo  $result['service_top_title']?></span></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="col-xs-12 col-md-12"><a href="<?echo $result['service_link_one']?>" target="_blank">
                                <img class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?echo  $result['service_img_one']?>" height="250" width="250" alt="shipping truck icon">
                            </a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?echo  $result['service_title_one']?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<?echo $result['service_link_two']?>" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?echo  $result['service_img_two']?>" height="250" width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?echo  $result['service_title_two']?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<?echo $result['service_link_three']?>" target="_blank"><img  class="cld-responsive img-responsive center-block lazy" data-src="backoffice/<?echo  $result['service_img_three']?>" height="250" width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><?echo  $result['service_title_three']?></h2>
                        </div>
                    </div>
                </div>
            <?}?>


        </main>
    </div>

<?
mysqli_close($conn);
include 'footer.php';
?>