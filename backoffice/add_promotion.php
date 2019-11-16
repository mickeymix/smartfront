<?php


if($_POST["action"] == "1"){
require_once("conn.php");
file_exists("conn.php");

	$conn = new mysqli($host, $user, $pass, $dbname);
	mysqli_set_charset($conn,"utf8");

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	
	
	
	$product_code = $_POST["product_code"];
	$product_promo_type = $_POST["product_promo_type"];
	
	
	
	$sql2 = "SELECT COUNT(*) AS CHK_COUNT FROM product_main WHERE product_code = '".$product_code."'";
	

	
		$query = mysqli_query($conn, $sql2);

		while($result = mysqli_fetch_assoc($query)) {
			$chk_count = $result['CHK_COUNT'];
		}	
	
	if($chk_count <> "0"){
		$sql = "INSERT INTO product_promotion (product_code, product_promo_type,modify_date,insert_date,update_by)
		VALUES ('$product_code','$product_promo_type',SYSDATE(),SYSDATE(),'$username_log')";

		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$alert="New product successfully.";
		} else {
			$alert="Error: " . $sql . "<br>" . $conn->error;
		}
	}else{
		$alert="Product code not found.";
	}	
	
	$conn->close();
	
	if($product_promo_type == "promo"){
		header( "Location: add_product_promo.php?alert=".$alert );
	}else{
		header( "Location: add_product_recommen.php?alert=".$alert );
	}	
	
	 
}

?>