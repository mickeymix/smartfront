<? ob_start(); ?>
<? session_start();
include 'conn.php';
header('Content-Type: application/json');
$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");

$sql = "INSERT INTO valiation_answer_master (v_option_one,v_option_two, v_option_three, v_sku, v_ori_id) 
		VALUES ('".$_POST["v_option_one"]."'
        ,'".$_POST["v_option_two"]."'
        ,'".$_POST["v_option_three"]."'
        ,'".$_POST["v_sku"]."'
        ,'".$_POST["v_ori_id"]."')";
$query = mysqli_query($conn,$sql);

if($query) {
    echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
}
else
{
    echo json_encode(array('status' => '0','message'=> "Error insert data! '".$conn->error."'"));
}

mysqli_close($conn);

?>