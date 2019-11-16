<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");		
	
$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");

if($_POST["action"] == "1"){
	
	$service_top_title = $_POST["service_top_title"];



	$sql = "UPDATE service_config SET 
	service_top_title = '$service_top_title'
	WHERE id = 1 ";

		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$alert="อัพเดตข้อมูลเรียบร้อย";
		//$alert=$sql;
		} else {
			$alert="Error: " . $sql . "<br>" . $conn->error;
		}

}
?>


<script src="js/ckeditor.js"></script>
	<script src="js/sample.js"></script>
 <link rel="stylesheet" href="styles/bootstrap.min.css">
 <div id="wrapper">
        <?php include("top.php");?>   
           <!-- /. NAV TOP  -->
                <?php include("menu.php");?>  
        <!-- /. NAV SIDE  -->
	
		<form  action="ma_service_title.php" method="POST" class="form-horizontal" enctype="multipart/form-data" >
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>เมนูจัดการ service</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                  <!-- /. ROW  -->
				  <?php if($alert<>""){ ?>
				  <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo "$alert"; ?>    
                   </div>
					 <?php } ?>		
				  
				  
					<?
						//$sql = "SELECT service_top_title  FROM service_config WHERE id ='1";
	
	
					//	$result = $conn->query($sql);

					$sql = "SELECT * FROM service_config ";				
				    $query = mysqli_query($conn, $sql);
				 
						while($result = mysqli_fetch_assoc($query)) {
                    ?>
                    <br/>
                    <label>ชื่อหัวข้อ :</label>
                    <br/>
                    <input class="form-control" placeholder="กรุณาใส่ข้อมูลหัวข้อ" type="text" name="service_top_title"  value="<?=$result["service_top_title"];?>" />
                    
                   
					<?
						}
					?>	
					 <br/> <br/> 
					<input type="hidden" name="action" value="1" />
                     <button type="submit" class="btn btn-success">  Save  </button>
                     <button type="reset" class="btn btn-primary">Reset</button>   
					 <a href="" class="btn btn-default">Back</a>              


    </div>
             <!-- /. PAGE INNER  -->
            </div>
		
         <!-- /. PAGE WRAPPER  -->
        </div>

</form>

			<script data-sample="1">
				CKEDITOR.replace( 'editor1' );
				CKEDITOR.replace( 'editor2' );
				
			</script>
			
<?
	$conn->close();
	include 'footer.php';
?>