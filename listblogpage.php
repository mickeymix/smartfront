<html>
<?
include 'backoffice/conn.php';
$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
?>
<body>
<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="my-4">บทความที่น่าสนใจ <br><br>
        <small>ทางเรามีบทความดีดีมากมาย ตัวอย่างมีดังนี้</small>
    </h1>

    <div class="row">
        <?

        $sql = "SELECT * FROM (SELECT * FROM article where start_art <= SYSDATE() ORDER BY id_art DESC LIMIT 3) sub ORDER BY id_art ASC";
        $query = mysqli_query($conn, $sql);
        echo "<script> console.log('dsowdkwokowskows')</script>";
        while ($result = mysqli_fetch_assoc($query)) { ?>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <a target="_blank" href="article_detail.php?id_art=<? echo $result['id_art'] ?>"><img class="card-img-top"
                                                                                     src="backoffice/<? echo $result['img_art'] ?>"
                                                                                     alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a target="_blank" href="article_detail.php?id_art=<? echo $result['id_art'] ?>"><? echo $result['head_art'] ?></a>
                        </h4>
                        <p class="card-text"><? echo $result['desp_art'] ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>


    </div>
    <!-- /.row -->


</div>
<!-- /.container -->


</body>
</html>