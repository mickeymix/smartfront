<?php
class CallProduct
{
   
//    function callApiProduct() {
//	$url = 'http://178.128.126.184:8080/api/v1/businessunits/1/products'; // path to your JSON file
//	$data = file_get_contents($url); // put the contents of the file into a variable
//	$array_data = json_decode($data, true);  // decode the JSON feed
//	$business_units = $array_data['business_units'];
//
//		
//		return $business_units;
//	}



function callApiProductSync($product) {
$host = "http://backoffice.smartbestbuys.com:8080";
$path = "/api/v2/products";
// $arr = $array = [  'productCodes' => ['SEAT0000045'] ];

	//$product ="SEAT0000045,ST-T901";
	
	$products = explode (",", $product); 
	 

   $checkfor = ([
    'productCodes'=>$products
   ]);


$arr = json_encode($checkfor);  
               
      

		
		
//$arr = array('');
$token = "de19e836-fdc8-495b-9e57-88518b9e0ad4";

$ch = curl_init();

// endpoint url
curl_setopt($ch, CURLOPT_URL, $host . $path);

// set request as regular post
curl_setopt($ch, CURLOPT_POST, true);

// set data to be send
curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);

// set header
curl_setopt($ch, CURLOPT_HTTPHEADER, array('api_key: ' . $token ,  'Content-Type: application/json'));

// return transfer as string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);
	$array_data = json_decode($response, true);  // decode the JSON feed
	$business_units = $array_data['products'];


return $business_units;

}	

 function callApiProduct() {
$host = "http://backoffice.smartbestbuys.com:8080";
$path = "/api/v1/businessunits/1/products";
// $arr = array('caseNumber' => '456456787');
$arr = array('');
$token = "de19e836-fdc8-495b-9e57-88518b9e0ad4";

$ch = curl_init();

// endpoint url
curl_setopt($ch, CURLOPT_URL, $host . $path);

// set request as regular post
//curl_setopt($ch, CURLOPT_POST, true);

// set data to be send
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arr));

// set header
curl_setopt($ch, CURLOPT_HTTPHEADER, array('api_key: ' . $token));

// return transfer as string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

//print($response);


curl_close($ch);
	$array_data = json_decode($response, true);  // decode the JSON feed
	$business_units = $array_data['business_units'];

return $business_units;
}
}

?>