<?php ob_start(); ?>
<?php session_start();
include 'backoffice/conn.php';
header('Content-Type: application/json');

require_once("account/login_user.php");
$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
	// $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
    $digits = 4;
    $ranId = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
    $startId = "SMART".$ranId."" ;
	$sql = "INSERT INTO users (customer_user_login,firstname, lastname, cus_password, email, phone, insert_date,modify_date) 
		VALUES ('".$startId."'
        ,'".$_POST["namecus"]."'
        ,'".$_POST["lastnamecus"]."'
        ,'".$_POST["password_cus"]."'
        ,'".$_POST["email"]."'
        ,'".$_POST["phonenumber"]."'
        ,SYSDATE(),SYSDATE())";
	$query = mysqli_query($conn,$sql);

	if($query) {
            $_SESSION["customer_id"] = $startId;
            $_SESSION["firstname"] = $_POST["namecus"];
            $_SESSION["lastname"] = $_POST["lastnamecus"];
        echo json_encode(array('status' => '1','message'=> 'Record add successfully','name'=> "'".$_POST["namecus"]."'"
        ,'lastname'=> "'".$_POST["lastnamecus"]."'"
        ,'email'=> "'".$_POST["email"]."'"
        ,'customerID' =>$startId));
        // $obj = new LoginUser();
        // $customer = $obj->Login($_POST["email"], $_POST["password_cus"], $conn);
        // if ($customer->customer_id != null) {
        //     $_SESSION["customer_id"] = $customer->customer_id;
        //     $_SESSION["firstname"] = $customer->firstname;
        //     $_SESSION["lastname"] = $customer->lastname;
             
        // }
        // else{
        //     echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        // }
	}
	else
	{
		echo json_encode(array('status' => '0','message'=> "Error insert data! '".$conn->error."'"));
	}
	mysqli_close($conn);
?>