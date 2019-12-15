<?php
ob_start();
session_start();
	
if(!isset($_SESSION["intLine"]))
{
	if(isset($_POST["product_code"]))
	{
		 $_SESSION["intLine"] = 0;
         $_SESSION["product_code"][0] = $_POST["product_code"];
         $_SESSION['product_name'][0] = $_POST['product_name'];
         $_SESSION['product_image'][0] = $_POST['product_image'];
         $_SESSION['product_code_str'][0] = $_POST['product_code'];
		 $_SESSION["product_amount"][0] = $_POST["product_amount"];
	}
}
else
{
	
	$key = array_search($_POST["product_code"], $_SESSION['product_code_str']);
	if((string)$key != "")
	{
		 $_SESSION["product_amount"][$key] = $_SESSION["product_amount"][$key] + $_POST["product_amount"];
	}
	else
	{
		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
		 $intNewLine = $_SESSION["intLine"];
         $_SESSION["product_code"][$intNewLine] = $_POST["product_code"];
         $_SESSION['product_name'][$intNewLine] = $_POST['product_name'];
         $_SESSION['product_image'][$intNewLine] = $_POST['product_image'];
		 $_SESSION["product_amount"][$intNewLine] = $_POST["product_amount"];
	}

}

// show order

/* 
$Total = 0;
  $SumTotal = 0;

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["product_code"][$i] != "")
	  {
		?>
	  
		product code : <?php echo $_SESSION["product_code"][$i];?> 
        <> 
		product amount : <?php echo $_SESSION["product_amount"][$i];?>
        <hr>
	  <?php
      }
      
  }
  */
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
                </div>
            </div>
            <br/>
            <div class="row text-center">
                เพิ่มในรายการเสนอสินค้าแล้ว...
            </div>
            <br>
        </main>
    </div>

<?php
header("location:index.php");
include 'footer.php';
?>
</body>
</html>