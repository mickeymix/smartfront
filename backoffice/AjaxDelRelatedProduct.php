<?php
 //echo "You input : <u>".$_POST["data1"]."</u>";
 include 'conn.php';
 $id_related = $_POST["data1"];
$product_code = $_POST["data2"];
 $conn = mysqli_connect($host, $user, $pass, $dbname);
 
 
			
 
 
 $sql = "DELETE FROM product_related WHERE id_related = ".$id_related;
	
		if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
	
		
		} else {
			$alert="Error: " . $sql . "<br>" . $conn->error;
			print($alert);
		}
			
 
	
 ?>
 <ul>
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
