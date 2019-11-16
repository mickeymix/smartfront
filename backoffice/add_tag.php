<?
	include 'head.php';
	
	$product_code_get = $_GET["product_code"];
	
		
	$conn = mysqli_connect($host, $user, $pass, $dbname);
	mysqli_set_charset($conn,"utf8");
	
	
	if($_GET["action"] == "1"){
		
			$product_code = $_GET["product_code"];
			$keyword = $_GET["keyword"];

		
		
			$sql = "INSERT INTO tag_product (product_code, keyword ,insert_date,insert_by)
			VALUES ('$product_code','$keyword',SYSDATE(),'$username_log')";

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$alert="New product successfully.";
			} else {
				$alert="Error: " . $sql . "<br>" . $conn->error;
			}
	}	
	
	

	if($_GET["action"] == "998"){

	$id  = $_GET["id"];

	

	$sql ="DELETE FROM tag_product WHERE id='".$id."'";

			

				if ($conn->query($sql) === TRUE) {

					$alert="DELETE successfully";

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
	
		
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>เพิ่มTag สินค้า</h2>   
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
				  
				  <form  action="add_tag.php" method="GET" class="form-horizontal" data-parsley-validate="" novalidate="">
           
					
					<label>Keyword</label>
					<input class="form-control" placeholder="" type="text" name="keyword" value="" />
					<br/> 
					
					
				
					
					
					 
					<input type="hidden" name="action" value="1" />
					<input type="hidden" name="product_code" value="<? echo $product_code_get; ?>" />
                     <button type="submit" class="btn btn-success">  Save  </button>
                     <button type="reset" class="btn btn-primary">Reset</button>   
					 <a href="" class="btn btn-default">Back</a>              
				  </form>

			
       
		
		
		
		
		<br/>
		<br/><br/>
			
			<div class="table-responsive">
				
				
				 <table class="table table-striped table-bordered table-hover">

					<thead>

						<tr>

							<th>#</th>

							<th>รหัสสินค้า</th>

							<th>ชื่อสินค้า</th>				

							<th>Tag Name</th>
							
							<th>URL</th>
							
							<th>ลบ</th>
							

						</tr>

					</thead>

					<tbody>
					
					<?php					 
					 $perpage = 100;
						 if (isset($_GET['page'])) {
							$page = $_GET['page'];
						 } else {
							$page = 1;
						 }					 
					 $start = ($page - 1) * $perpage;
					 
					 $sql = "SELECT 
							A.id
							,A.product_code
							,A.keyword
							,(SELECT product_title_th FROM product_main WHERE A.product_code = product_code LIMIT 1 ) AS product_title_th
							FROM tag_product A  WHERE A.product_code = '$product_code_get' ORDER BY TRIM(product_title_th)  ASC limit {$start} , {$perpage}";		
						 								
					 $query = mysqli_query($conn, $sql);

					 ?>									

					<? 
						$i =0;
						while ($result = mysqli_fetch_assoc($query)) {
						$i++;
					?>		
						<tr>
							<td><? echo $i?></td>
							<td><?php echo $result['product_code']; ?></td>
							<td><?php echo $result['product_title_th']; ?></td>
							<td><?php echo $result['keyword']; ?></td>
							<td>https://roadsafetyproduct.com/tag_product.php?keyword=<?php echo $result['keyword']; ?></td>
							<td style="text-align:center; width:20;">											
								<button class="btn btn-danger" onClick="javascript:location.href='add_tag.php?action=998&id=<?php echo $result['id']; ?>&product_code=<? echo $product_code_get; ?>'"><i class="fa fa-pencil"></i>ลบ</button>
							</td>
						</tr>
					
					<?
						}
					?>	
					</tbody>
					
				</table>	
									
				
			</div>
			
			<?php
		
			  $sql2 = "SELECT 
							A.product_code
							,A.keyword
							,(SELECT product_title_th FROM product_main WHERE A.product_code = product_code LIMIT 1 ) AS product_title_th
							FROM tag_product A  ";

			 $query2 = mysqli_query($conn, $sql2);

			 $total_record = mysqli_num_rows($query2);

			 $total_page = ceil($total_record / $perpage);

			 ?>

			 <nav>

				 <ul class="pagination">

					 <li>

						 <a href="add_tag.php?page=1&product_code=<? echo $product_code_get; ?>" aria-label="Previous">

							 <span aria-hidden="true">&laquo;</span>

						 </a>

							 </li >

								 <?php for($i=1;$i<=$total_page;$i++){ ?>

								 

								 <?

								 if($i == $page){

								?>	 

									<li class='active'><a  href="add_tag.php?page=<?php echo $i; ?>&product_code=<? echo $product_code_get; ?>"><?php echo $i; ?></a></li>

								<?	

								}else{

								?>

									<li><a href="add_tag.php?page=<?php echo $i; ?>&product_code=<? echo $product_code_get; ?>"><?php echo $i; ?></a></li>

								<?	

								}

								 ?>

									

								 <?php } ?>

							 <li>

						 <a href="add_tag.php?page=<?php echo $total_page;?>&product_code=<? echo $product_code_get; ?>" aria-label="Next">

							 <span aria-hidden="true">&raquo;</span>

						 </a>

					 </li>

				 </ul>

			 </nav> 
	
		
		 <!-- /. PAGE INNER  -->
			</div>     
		 </div>
		
		
         <!-- /. PAGE WRAPPER  -->
        </div>



			
			
<?
	$conn->close();
	include 'footer.php';
?>

 
