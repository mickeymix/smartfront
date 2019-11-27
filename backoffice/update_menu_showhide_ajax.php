<? ob_start(); ?>
<? session_start();
include 'conn.php';
header('Content-Type: application/json');
$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
// $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
//if(isset($_POST['namemenu'])){

//}

//echo "<script>console.log('Debug Objects: " . $_POST["namemenu"] . "' );</script>";
$sql = "UPDATE menu SET menu_status = '" . $_POST["menustatus"] . "' WHERE menu_name =  '" . $_POST["nameproduct"] . "'";

$query = mysqli_query($conn, $sql);
//$array = mysqli_fetch_row($query);

if($query) {
    echo json_encode(array('status' => '1','message'=> 'ได้แก้ไขเมนูเรียบร้อย'));
}else{
    echo json_encode(array('status' => '2','message'=> 'แก้ไขเมนูไม่สำเร็จ'));
}

mysqli_close($conn);

?>