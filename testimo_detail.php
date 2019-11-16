<? session_start(); ?>
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

<?php
$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM testimo WHERE id_testimo=" . $_GET["id_testimo"];


$query = mysqli_query($conn, $sql);

while ($result = mysqli_fetch_assoc($query)) { ?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <meta property="og:title" content="<?php echo $result['head_testimo']; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url"
          content="https://roadsafetyproduct.com/testimo_detail.php?id_testimo=<?php echo $result['id_testimo']; ?>"/>
    <meta property="og:image" content="https://roadsafetyproduct.com/backoffice/<?php echo $result['img_testimo']; ?>"/>
    <meta property="og:description" content="<? echo $result['short_description_testimo']; ?>"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@OlwV8JfBA7ZJ5fm">
    <meta name="twitter:creator" content="@OlwV8JfBA7ZJ5fm">
    <meta name="twitter:title" content="<?php echo $result['head_testimo']; ?>">
    <meta name="twitter:description" content="<? echo $result['short_description_testimo']; ?>">
    <meta name="twitter:image" content="https://roadsafetyproduct.com/backoffice/<?php echo $result['img_testimo']; ?>">
    <title>ร้านไทยจราจร</title>
<? } ?>

<?
include 'header.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>
</head>
<body>
    <div class="content-wrapper row">

        <main class="main container" role="main">
            <br/><br/>


            <div class="row">
                <?php

                $sql = "SELECT * FROM testimo WHERE id_testimo=" . $_GET["id_testimo"];


                $query = mysqli_query($conn, $sql);

                while ($result = mysqli_fetch_assoc($query)) {
                    $keyword_email = $result['keyword'];
                    $countClick = $result['clickcount'];

                    $addNewClick = $countClick + 1;
                    $sqlUpdate = "UPDATE testimo SET clickcount = " . $addNewClick . " WHERE id_testimo = " . $_GET["id_testimo"] . " ";
                    mysqli_query($conn, $sqlUpdate)
                    ?>


                    <div class="col-sm-8 ">
                        <div align="right" style="height:50px">
                            <?
                            //                                    http://twitter.com/share?text=text goes here&url=http://url goes here&hashtags=hashtag1,hashtag2,hashtag3
                            $urlForShare = "https://roadsafetyproduct.com/testimo_detail.php?id_testimo=" . $result['id_testimo'] . "";
                            //                                    echo "<script> console.log('dsdsdsdsds $urlForShare')</script>";
                            ?>
                            <a target="_blank"
                               href="http://www.facebook.com/sharer.php?u=<? echo urlencode($urlForShare) ?>"><img
                                        src="images/fb_share.png" width="40px"></a>
                            <a target="_blank"
                               href="https://twitter.com/intent/tweet?url=<? echo urlencode($urlForShare) ?>"><img
                                        src="images/twitter_share.png" width="40px"></a>
                            <a target="_blank" href="http://line.me/ti/p/@trafficthai"><img src="images/line_share.png"
                                                                                            width="40px"></a>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 ">
                                <h2><?php echo $result['head_testimo']; ?></h2>
                                <br/><br/><br/><br/>
                               
                                <div>
                                    <?php echo $result['desp_testimo']; ?>
                                </div>

                            </div>

                        </div>


                    </div>
                    <?
                }

                ?>

                <!--<div class="col-sm-4 " style="position: fixed;z-index: 999; right:0;"> -->
                <div class="col-sm-4 ">
                    <div class="row text-center">
                        <?
                        $sql = "SELECT id ,img , name_button FROM email_img ORDER BY insert_date DESC limit 1";


                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                        ?>

                        <div style="background-image: url('backoffice/<? echo $row["img"] ?>');background-size :contain; width: 100%; height: 100%;background-repeat-x: no-repeat;background-repeat-y: no-repeat;">

                            <br/><br/>
                            <h2 class="art-header "></h2>
                            <br/><br/>
                            <div style="height:100px">
                                <p class="art">

                                </p>
                            </div>

                            <input type="text" id="email-customer" placeholder="Enter your email"
                                   style="width:60%; text-align:center; display: inline; height:50px;"/>
                            <br/><br/>


                            <!--<img src="images/tidtam.png" style="width:400px; tex-align:center; display: inline;" onclick="add_email('article.php','SnBnBlog');" > -->


                            <input type="hidden" id="paper_id" value="3"/>
                            <input type="button" value="<? echo $row["name_button"] ?>"
                                   style="width:60%; text-align:center; display: inline; font-size:20px;"
                                   onclick="add_email(9 ,'<?php echo $keyword_email; ?>');"/>
                            <div style="height:100px">
                                <p class="art">

                                </p>
                            </div>
                        </div>
                    </div>
                    <?
                    }
                    ?>

                    <div class="row">
                        <br>
                        <br>
                        <center>
                            <h2>บทความยอดนิยม</h2>
                        </center>
                        <br>

                        <?
                        $sql = "SELECT *  FROM testimo WHERE head_testimo <> '' AND id_testimo <> " . $_GET["id_testimo"] . " AND start_art <= ADDTIME(SYSDATE(),'7:00:00')  ORDER BY insert_date DESC LIMIT 10";


                        $query = mysqli_query($conn, $sql);

                        while ($resultRelate = mysqli_fetch_assoc($query)) {
                            ?>
                            <li style="list-style-type: none;"><a target="_blank"
                                                                  href="testimo_detail.php?id_testimo=<?php echo $resultRelate['id_testimo']; ?>">
                                    <font color='black'><? echo $resultRelate['head_testimo'] ?></font>
                                </a>
                                <br>
                                <p>ยอดผู้เข้าชม <? echo $resultRelate['clickcount'] ?> ครั้ง</p>
                            </li>

                            <hr>
                            <?
                        }
                        ?>
                    </div>
                </div>

            </div>


            <br/><br/><br/><br/>
            <?   $sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)) {
                ?>?>

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
</body>
<?

include 'footer.php';
?>