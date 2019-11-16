<?
require_once("call_product.php");
require_once("conn.php");
file_exists("call_product.php");
file_exists("conn.php");
$obj = new CallProduct();


//"SEAT0000045,ST-T901"
$business_units = $obj->callApiProductSync($_POST["productCode"]);
ini_set('max_execution_time', 300);
   $conn = mysqli_connect($host, $user, $pass, $dbname);
	mysqli_set_charset($conn,"utf8");	
	
foreach ($business_units as $business) {

	foreach ($business['product_categories'] as $product_categories) {
		
		foreach ($product_categories['product_types'] as $product_types) {
		
				foreach ($product_types['products'] as $products) {
					
					
					
					
					$CHKDUB = chkdub($conn , $products['product_code']);
						
					
					
					if($CHKDUB == 0){
					
					AddProduct($products
					,$product_types['product_type_code']
					,$product_types['product_type_title_th']
					,$product_types['product_type_title_en']
					,$product_categories['product_category_code']
					,$product_categories['product_category_title_th']
					,$product_categories['product_category_title_en']
					,$conn
					);
					
					foreach ($products['product_price_list'] as $priceList) {
					
						AddProductPrice($priceList,$products['product_code'],$conn);
					}	
					
					}else{
						
						UpdateProduct($products
						,$product_types['product_type_code']
						,$product_types['product_type_title_th']
						,$product_types['product_type_title_en']
						,$product_categories['product_category_code']
						,$product_categories['product_category_title_th']
						,$product_categories['product_category_title_en']
						,$conn
						);
						
						
					
					}
						
				}
				
		}
		
	}	

}	
	mysqli_close($conn);
	
	
	?> <a href="sync_data_product.php"> BACK </a> <?
	
function chkdub($conn , $productCode){
		$sql =  "SELECT COUNT(*) AS CHKDUB FROM product_main WHERE product_code = '".$productCode."'";
		
		$result = $conn->query($sql);
		$CHKDUB = null;
		while($row = $result->fetch_assoc()) {

				
		$CHKDUB = $row["CHKDUB"];

				
		}
		
		return $CHKDUB;
}	
	
	
function UpdateProduct($product,$product_type_code,$product_type_title_th,
						$product_type_title_en,$product_category_code,$product_category_title_th,$product_category_title_en,$conn){
							
							
	$sql = "UPDATE product_main SET  
			product_title_en =  '".$product['product_title_en']."'
			, product_title_th =  '".$product['product_title_th']."'
			, product_unit_en =  '".$product['product_unit_en']."'
			, product_unit_th = '".$product['product_unit_th']."'
			, warranty_days = '".$product['warranty_days']."'
			, available_product = '".$product['available_product']."'
			, booked_product = '".$product['booked_product']."'
			, product_type_code = '".$product_type_code."'
			, product_type_title_th = '".$product_type_title_th."'
			, product_type_title_en = '".$product_type_title_en."'
			, product_category_code = '".$product_category_code."'
			, product_category_title_th = '".$product_category_title_th."'
			, product_category_title_en = '".$product_category_title_en."'
			, sell_with_web = '".$product['sell_with_web']."'
			, modify_date = SYSDATE()
			WHERE product_code = '".$product['product_code']."'				
			";	

			if(mysqli_query($conn, $sql)){
			echo $product['product_code']."successfully.";
			} else{
				echo "ERROR: Could not able to execute". mysqli_error($conn);
			}	
			
}		
function AddProduct($product,$product_type_code,$product_type_title_th,
						$product_type_title_en,$product_category_code,$product_category_title_th,$product_category_title_en,$conn){
			
		$sql = "INSERT INTO product_main (
		product_code,
		product_title_en,
		product_title_th,
		product_unit_en,
		product_unit_th,
		warranty_days,
		available_product,
		booked_product,
		product_type_code,
		product_type_title_th,
		product_type_title_en,
		product_category_code,
		product_category_title_th,
		product_category_title_en,
		sell_with_web,
		modify_date,
		insert_date
		) VALUES
        ('".
        $product['product_code']."','".
        $product['product_title_en']."','".
        $product['product_title_th']."','".
        $product['product_unit_en']."','".
        $product['product_unit_th']."','".
        $product['warranty_days']."','".
        $product['available_product']."','".
        $product['booked_product']."','".	
		$product_type_code."','".
		$product_type_title_th."','".
		$product_type_title_en."','".
		$product_category_code."','".
		$product_category_title_th."','".
		$product_category_title_en."',
		'".$product['sell_with_web']."',
        
		SYSDATE(),
		SYSDATE()
		)";
		
		if(mysqli_query($conn, $sql)){
			echo $product['product_code']."successfully.";
		} else{
			echo "ERROR: Could not able to execute". mysqli_error($conn);
		}
	}	
	
	function AddProductPrice($priceList,$product_code,$conn){
		$sql = "INSERT INTO product_price (
			product_code,
			from_amount,
			to_amount,
			price,
			modify_date,
			insert_date
			) VALUES
			('".
			$product_code."','".
			$priceList['from_amount']."','".
			$priceList['to_amount']."','".
			$priceList['price']."',
			SYSDATE(),
			SYSDATE()
			)";
			
			if(mysqli_query($conn, $sql)){
				
			} else{
				echo "ERROR: Could not able to execute". mysqli_error($conn);
			}
	}		
?>
















