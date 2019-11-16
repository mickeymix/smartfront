<?php
 //echo "You input : <u>".$_POST["data1"]."</u>";
 include 'conn.php';
 $product_code = $_POST["data1"];
 $username_log = $_POST["data2"];
 $product_code_related = $_POST["data3"];
 $conn = mysqli_connect($host, $user, $pass, $dbname);
 
 
			$sql2 = "SELECT COUNT(product_code) AS COUNT_PRODUCT FROM  product_main WHERE product_code ='".$product_code_related."' ";
		
			$result2 = $conn->query($sql2);
			$COUNT_PRODUCT = 0;
			while($row2 = $result2->fetch_assoc()) {
			$COUNT_PRODUCT = $row2["COUNT_PRODUCT"];
			}	
 
 
 $sql = "INSERT INTO product_related (product_code, insert_date , product_code_related , update_by) 
		VALUES ('$product_code',SYSDATE(), '$product_code_related' ,'$username_log' ) ";
	 if($COUNT_PRODUCT != 0){
		if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		$alert="New record created successfully";
		
		} else {
			$alert="Error: " . $sql . "<br>" . $conn->error;
			print($alert);
		}
	}		
 
	
 ?>	<ul>
			<? 

			$sql6 = "SELECT 
					a.product_code_related , a.id_related
					,(SELECT image FROM product_image where a.product_code_related = product_code  LIMIT 1 ) AS img
					FROM product_related a
					WHERE product_code ='".$product_code."' 
					ORDER BY  a.insert_date  DESC";
		
			$result6 = $conn->query($sql6);
	
			while($row6 = $result6->fetch_assoc()) {
		
			?>		
				<?=$row6["product_code_related"];?>
				
			
								
				<li style="width:130px" onclick="delRelated(<?=$row6["id_related"];?>);">
				<img src="<?=$row6["img"];?>" width="100px"> <img src="images/close_5.png" width="20px"> 
			
				</li>
				
			<?
			}
			
			
			?>	
 </ul>
 
	<? $conn->close();?>
