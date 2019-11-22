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

    <title>ร้านไทยจราจร</title>

    <?
    include 'headerblog.php';


    $conn = mysqli_connect($host, $user, $pass, $dbname);

    mysqli_set_charset($conn, "utf8");
    ?>

    <div class="content-wrapper row">

        <main class="main container" role="main">
            <br/><br/>


            <div class="row">
                <div class="col-sm-8 ">
                    <?php

                    $perpage = 20;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;


                    $sql = "SELECT * FROM article WHERE start_art <= ADDTIME(SYSDATE(),'7:00:00') ORDER BY INSERT_DATE DESC ";


                    $query = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($query)) {

                        $keyword_email = $result['keyword'];


                        ?>

                        <div class="row">
                            <div class="col-sm-4 ">
                                <div style="height:50px">
                                    <h2><?php echo $result['head_art']; ?></h2>
                                </div>
                                <a target="_blank"
                                   href="article_detail.php?id_art=<?php echo $result['id_art']; ?>"><img
                                            src="backoffice/<?php echo $result['img_art']; ?>" width="297px"></a>
                            </div>
                            <div class="col-sm-8 ">
                                <div align="right" style="height:50px">

                                    <?
                                    //                                    http://twitter.com/share?text=text goes here&url=http://url goes here&hashtags=hashtag1,hashtag2,hashtag3
                                    $urlForShare = "https://roadsafetyproduct.com/article_detail.php?id_art=" . $result['id_art'] . "";
                                    //                                    echo "<script> console.log('dsdsdsdsds $urlForShare')</script>";
                                    ?>
                                    <a target="_blank"
                                       href="http://www.facebook.com/sharer.php?u=<? echo urlencode($urlForShare) ?>"><img
                                                src="images/fb_share.png" width="40px"></a>
                                    <a target="_blank"
                                       href="https://twitter.com/intent/tweet?url=<? echo urlencode($urlForShare) ?>"><img
                                                src="images/twitter_share.png" width="40px"></a>
                                    <a target="_blank" href="http://line.me/ti/p/@trafficthai"><img
                                                src="images/line_share.png" width="40px"></a>
                                </div>
                                <div>
                                    <?php echo $result['desp_art']; ?>
                                </div>
                                <div class="text-right">
                                    <a target="_blank"
                                       href="article_detail.php?id_art=<?php echo $result['id_art']; ?>">Read
                                        More...</a>
                                </div>
                            </div>
                        </div>
                        <?
                    }

                    ?>

                    <?php


                    $sql2 = "SELECT * FROM article ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="article.php?page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>

                                <?
                                if ($i == $page) {
                                    ?>
                                    <li class='active'><a
                                                href="article.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?
                                } else {
                                    ?>
                                    <li><a href="article.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?
                                }
                                ?>

                            <?php } ?>
                            <li>
                                <a href="article.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
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
                            <div style="height:60px">
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
                                   onclick="add_email_artical(9 ,'article');"/>
                            <div style="height:130px">
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
                        $sql = "SELECT *  FROM article WHERE head_art <> '' AND start_art <= ADDTIME(SYSDATE(),'7:00:00')  ORDER BY clickcount DESC , insert_date DESC LIMIT 10";


                        $query = mysqli_query($conn, $sql);

                        while ($resultRelate = mysqli_fetch_assoc($query)) {
                            ?>
                            <li style="list-style-type: none;">
                                <a target="_blank"
                                   href="article_detail.php?id_art=<?php echo $resultRelate['id_art']; ?>">
                                    <font color='black'><? echo $resultRelate['head_art'] ?></font>
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
            <? $sql = "SELECT * FROM service_config WHERE id = 1 ";
            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)) {
                ?>

                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="col-xs-12 col-md-12"><a href="<? echo $result['service_link_one'] ?>"
                                                            target="_blank">
                                <img class="cld-responsive img-responsive center-block lazy"
                                     data-src="backoffice/<? echo $result['service_img_one'] ?>" height="250"
                                     width="250" alt="shipping truck icon">
                            </a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><? echo $result['service_title_one'] ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<? echo $result['service_link_two'] ?>"
                                                            target="_blank"><img
                                        class="cld-responsive img-responsive center-block lazy"
                                        data-src="backoffice/<? echo $result['service_img_two'] ?>" height="250"
                                        width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><? echo $result['service_title_two'] ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-xs-12 col-md-12"><a href="<? echo $result['service_link_three'] ?>"
                                                            target="_blank"><img
                                        class="cld-responsive img-responsive center-block lazy"
                                        data-src="backoffice/<? echo $result['service_img_three'] ?>" height="250"
                                        width="250" alt="customer service icon"></a></div>
                        <div class="col-xs-12 col-md-12 text-center">
                            <h2><? echo $result['service_title_three'] ?></h2>
                        </div>
                    </div>
                </div>
            <? } ?>

        </main>
    </div>

<?
$conn->close();
include 'footer.php';
?>