<?php 
require_once("call_product.php");
require_once("conn.php");
file_exists("call_product.php");
file_exists("conn.php");
$obj = new CallProduct();
//$obj-> callApiProduct(); 
$business_units = $obj->callApiProduct();

 $product_categories = $business_units[0]['product_categories'];

	ini_set('max_execution_time', 300);
	$conn = mysqli_connect($host, $user, $pass, $dbname);
	mysqli_set_charset($conn,"utf8");	
	if($conn === false){
		die("ERROR: Could not connect" .mysqli_connect_error());
	}

	foreach ($product_categories as $categories) {
	//	echo $categories['product_category_code'];
	//	echo $categories['product_category_title_th'];
	//	echo $categories['product_category_title_en'];
			foreach ($categories['product_types'] as $product_type) {
				//echo $product_type['product_type_code'];
				//echo $product_type['product_type_title_th'];
				//echo $product_type['product_type_title_en'];
				foreach ($product_type['products'] as $product) {
					//echo $product['product_code'];
					//echo $product['product_title_en'];
					//echo $product['product_title_th'];
					//echo $product['product_unit_en'];
					//echo $product['product_unit_th'];
					//echo $product['warranty_days'];
					//echo $product['available_product'];
					//echo $product['booked_product'];
					AddProduct($product
					,$product_type['product_type_code']
					,$product_type['product_type_title_th']
					,$product_type['product_type_title_en']
					,$categories['product_category_code']
					,$categories['product_category_title_th']
					,$categories['product_category_title_en']
					,$conn
					);
									
					foreach ($product['product_price_list'] as $priceList) {
						//echo $priceList['from_amount'];
						//echo $priceList['to_amount'];
						//echo $priceList['price'];
						AddProductPrice($priceList,$product['product_code'],$conn);
					}	
				
				}				
				
			}
	}	
	
	mysqli_close($conn);
	
	
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
		SYSDATE(),
		SYSDATE()
		)";
		
		if(mysqli_query($conn, $sql)){
			echo "Records added successfully.";
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
				echo "Records added successfully.";
			} else{
				echo "ERROR: Could not able to execute". mysqli_error($conn);
			}
	}	
	
/*
ini_set('max_execution_time', 300);
	
	$conn = mysqli_connect($host, $user, $pass, $dbname);

	mysqli_set_charset($conn,"utf8");
	
	if($conn === false){
		die("ERROR: Could not connect" .mysqli_connect_error());
	}
	
	foreach ($products as $product) {
			

	$sql = "INSERT INTO product_main (
		product_id,
        product_title_th,
        product_title_en,
        product_description_th,
        product_description_en,
        product_unit_th,
        product_unit_en,
        product_code,
        warranty_days,
        available_product,
        booked_product,
        business_unit_id,
        business_title_th,
        business_title_en,
        business_unit_code,
        product_category_id,
        product_category_title_th,
        product_category_title_en,
        product_category_code,
        product_type_id,
        product_type_title_th,
        product_type_title_en,
        product_type_code,
        product_storage_zone_id,
        product_storage_zone_title,
        from_amount,
        to_amount,
        price,
		modify_date,
		insert_date
		) VALUES
        ('".
		$product['product_id']."','".
        $product['product_title_th']."','".
        $product['product_title_en']."','".
        $product['product_description_th']."','".
        $product['product_description_en']."','".
        $product['product_unit_th']."','".
        $product['product_unit_en']."','".
        $product['product_code']."','".
        $product['warranty_days']."','".
        $product['available_product']."','".
        $product['booked_product']."','".
        $product['business_unit_id']."','".
        $product['business_title_th']."','".
        $product['business_title_en']."','".
        $product['business_unit_code']."','".
        $product['product_category_id']."','".
        $product['product_category_title_th']."','".
        $product['product_category_title_en']."','".
        $product['product_category_code']."','".
        $product['product_type_id']."','".
        $product['product_type_title_th']."','".
        $product['product_type_title_en']."','".
        $product['product_type_code']."','".
        $product['product_storage_zone_id']."','".
        $product['product_storage_zone_title']."','".
        $product['from_amount']."','".
        $product['to_amount']."','".
        $product['price']."',
		SYSDATE(),
		SYSDATE()
		)";
		
	
	
    
		if(mysqli_query($conn, $sql)){
			echo "Records added successfully.";
		} else{
			echo "ERROR: Could not able to execute". mysqli_error($conn);
		}
		
		foreach ($product['priceList'] as $priceList) {
			$sql = "INSERT INTO product_price (
			product_code,
			from_amount,
			to_amount,
			price,
			modify_date,
			insert_date
			) VALUES
			('".
			$product['product_code']."','".
			$priceList['from_amount']."','".
			$priceList['to_amount']."','".
			$priceList['price']."',
			SYSDATE(),
			SYSDATE()
			)";
			
			if(mysqli_query($conn, $sql)){
				echo "Records added successfully.";
			} else{
				echo "ERROR: Could not able to execute". mysqli_error($conn);
			}
					
		}
		
		
	} 

mysqli_close($conn);
*/
?>