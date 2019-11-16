<?
	include 'head.php';
	

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");
?>

<script>
	function validateForm() {
	  var x = document.forms["myForm"]["menu_keyword"].value;
	  if (x == "") {
		
		return false;
	  }
	}
</script>


<?
	$id  = $_GET["id"];
	if($_GET["action"] == "998"){
	
		$sql = "SELECT img_art FROM article WHERE id_art='".$id."'";
	
	
		$result = $conn->query($sql);
 
		while($row = $result->fetch_assoc()) {

				
			//	print($row["menu_img"]);

				unlink($row["img_art"]);
		}	
	
	$sql ="DELETE FROM article WHERE id_art ='".$id."'";
			
				if ($conn->query($sql) === TRUE) {
					$alert="DELETE successfully";
				} else {
					$alert="Error: " . $sql . "<br>" . $conn->error;
				}
	}

?>
 <div id="wrapper">
        <?php include("top.php");?>   
           <!-- /. NAV TOP  -->
                <?php include("menu.php");?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			
			
			
			
			
                <div class="row">
				
	
				
				
                    <div class="col-md-12">
                     <h2>ข้อมูลBlog</h2>   
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
		
				  <div style="height:10px;"></div>
        <div class="table-responsive">
		

		
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
											<th>Image</th>
											<th >Head</th>
													
											<th style="text-align:center; " >แก้ไข</th>
                                            <th style="text-align:center; " >link</th>
                                            <th style="text-align:center; " >ลบ</th>
											
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

		 
		$sql = "SELECT * FROM article    ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";

		
 $query = mysqli_query($conn, $sql);
 ?>									
<? 

	 $i =0;
	while ($result = mysqli_fetch_assoc($query)) {
	$i++;
?>								
                                        <tr>
                                            <td><? echo $i?></td>
											
											<td><img src="<?php echo $result['img_art']; ?>" width="70px" >	</td>
                                            <td><?php echo $result['head_art']; ?>	</td>
										
											<td style="text-align:center; width:20;">
												<button class="btn btn-primary" onClick="javascript:location.href='edit_art.php?id_art=<?php echo $result['id_art']; ?>'"><i class="fa fa-edit "></i>แก้ไข</button>
											</td>
                                            <td style="text-align:center; width:20;">
                                                <button class="btn btn-info" onClick="javascript:window.open('../article_detail.php?id_art=<?php echo $result['id_art']; ?>','_blank')">Preview</button>                                            </td>
											<td style="text-align:center; width:20;">
									
											<button class="btn btn-danger" onClick="javascript:location.href='ma_art.php?action=998&id=<?php echo $result['id_art']; ?>'"><i class="fa fa-pencil"></i>ลบ</button>
											</td>
											
                                        </tr>
<? 
	}
	
?>     
                                 
                                    </tbody>
                                </table>
								
<?php

	if($i == 0){
		
			echo "not found.";
	}	


	 
 $sql2 = "SELECT * FROM article ";
 $query2 = mysqli_query($conn, $sql2);
 $total_record = mysqli_num_rows($query2);
 $total_page = ceil($total_record / $perpage);
 ?>
 <nav>
	 <ul class="pagination">
		 <li>
			 <a href="ma_art.php?page=1" aria-label="Previous">
				 <span aria-hidden="true">&laquo;</span>
			 </a>
				 </li >
					 <?php for($i=1;$i<=$total_page;$i++){ ?>
					 
					 <?
					 if($i == $page){
					?>	 
						<li class='active'><a  href="ma_art.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?	
					}else{
					?>
						<li><a href="ma_art.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?	
					}
					 ?>
						
					 <?php } ?>
				 <li>
			 <a href="ma_art.php?page=<?php echo $total_page;?>" aria-label="Next">
				 <span aria-hidden="true">&raquo;</span>
			 </a>
		 </li>
	 </ul>
 </nav> 

       </div>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>			

<?
	$conn->close();
	include 'footer.php';
?>