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
$sql = "SELECT * FROM common_smart_master WHERE common_menu = '" . $_POST["namemenu"] . "'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
echo json_encode(array('status' => '1','message'=> $row['common_content']));

?>