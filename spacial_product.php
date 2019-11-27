<? session_start(); ?>
<?php
include 'backoffice/conn.php';



if ($_GET["action"] == "logout") {
    session_destroy();
    header("Location: index.php");
}
?>

<?php


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");


$sql = "SELECT * FROM product_main where product_code='" . $_GET["product_code"] . "'";
$query = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($query)) {
    $common_content = $result['content_prod_th'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">

    <script>
        <?
        echo $tag_google;
        ?>
    </script>


    <title><? echo $product_title_th;  ?><? echo $headline;  ?></title>
    <meta name="Keywords" content="<? echo $keyword;  ?>" />
    <meta name="description" content="<? echo $sub_headline;  ?>" />
    <meta charset="utf8">


    <?
    include 'header.php';
    ?>
    <link rel="stylesheet" media="screen, projection" href="css/drift-basic.css">
    <link href="css/application.css" rel="stylesheet" />
    <style>
        ol {
            list-style-type: decimal;
        }
    </style>
    <style type="text/css">
        .detail {
            position: relative;
            width: 50%;

            float: left;
        }
    </style>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/nextprv.js"></script>


</head>

<body>

    <div class="content-wrapper row">
        <div class="quick-facts printAtFullWidth">
            <? echo ($common_content == "") ? "NO Content" : $common_content; ?>
        </div>
    </div>

    <?
	// mysqli_close($conn);
	include 'footer.php';
	?>
</body>