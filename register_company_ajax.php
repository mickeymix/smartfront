<? ob_start(); ?>
<? session_start();
include 'backoffice/conn.php';
header('Content-Type: application/json');

	
$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
	// $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$sql = "INSERT INTO users (firstname, lastname, cus_password, email, phone,taxnumber,company, insert_date,modify_date) 
		VALUES ('".$_POST["namecompanycus"]."'
        ,'".$_POST["lastnamecompanycus"]."'
        ,'".$_POST["password_companycus"]."'
        ,'".$_POST["emailcompany"]."'
        ,'".$_POST["phonenumbercompany"]."'
		,'".$_POST["taxref"]."'
		,'".$_POST["comnapy"]."'
        ,SYSDATE(),SYSDATE())";
	$query = mysqli_query($conn,$sql);

	if($query) {
		$_SESSION["customer_id"] = $startId;
		$_SESSION["firstname"] = $_POST["namecus"];
		$_SESSION["lastname"] = $_POST["lastnamecus"];
		echo json_encode(array('status' => '1','message'=> 'Record add successfully','name'=> "'".$_POST["namecompanycus"]."'"
        ,'lastname'=> "'".$_POST["lastnamecompanycus"]."'"
        ,'email'=> "'".$_POST["emailcompany"]."'"));
	}
	else
	{
		echo json_encode(array('status' => '0','message'=> "Error insert data! '".$conn->error."'"));
	}

	mysqli_close($conn);
