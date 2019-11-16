<?
include 'conn.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");


$sql = "SELECT email FROM email_customer  ORDER BY INSERT_DATE DESC ";
$query = mysqli_query($conn, $sql);
 $a=array("");
while ($result = mysqli_fetch_assoc($query)) {
	
	array_push($a,$result['email']);
}	
echo $a;
$conn->close();
?>