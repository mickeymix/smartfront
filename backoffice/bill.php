<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบเสร็จรับเงิน</title>
<STYLE type=text/css>BODY {
width:900px;
height:auto;
margin: 0 auto;
}
</STYLE>
</head>

<body>
<p>
<?php
@$datenew=date('Y-m-d');
echo "&nbsp;";
echo "<div style='width:900px; padding:20px; border:solid 1px #ccc;margin:0 auto;'>";
echo "<p align=center></p>";

echo "<table border='0' width='90%'>";
?>
<table width="697" height="189" border="0" align="center">
<tr>
<td width="127" align="center"><img src='../images/logo.jpg' width='187' height='208' /></td>
<td width="426"><h2 align="center">... บัวสาย ผ้าไทย ช้อปปิ้งออนไลน์ ... 
</h2>
<ul>
<li>ร้านบัวสาย  ผ้าไทย</li>

<li>เลขที่163 หมู่ที่ 6 ตำบล ดอนคา อำเภอ อู่ทอง จังหวัด สุพรรณบุรี 72160</li>
<li>โทร  090-5192866 , 089-1621125</li>
</ul> </td>
</tr>
</table>
<p align="center">-----------------------------------------------------------------------------------</p>
<p>&nbsp;</p>
<p>
<?php
include 'Connection_Config.php';


$order_id  = $_GET["order_id"];
$usr_id  = $_GET["usr_id"];

echo "<tr height='20'><td></td></tr>";




// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
		
	
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "SELECT * FROM member_magic  WHERE ID = '$usr_id'";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
			
			$name = $row["NAME"];
			$tel = $row["TEL"];
			$addr = $row["ADDRESS"];
			$ID_CARD = $row["ID_CARD"];
			$ID_TAX = $row["ID_TAX"];
		
	


echo "<tr><td colspan='5'><table border='0'>";
echo "<tr><td align='right' colspan='2' width='90'>ชื่อผู้ซื้อ :</td><td><input type='text' value='$name' size='50' readonly='readonly'></td></tr>";
echo "<tr><td align='right' colspan='2' width='90'>ที่อยู่ :</td><td><input type='text' value='$addr' size='50' readonly='readonly'></td></tr>";
echo "<tr><td align='right' colspan='2' width='90'>เบอร์โทร :</td><td><input type='text' value='$tel' size='50' readonly='readonly'></td></tr>";
echo "</td></tr></table>";



			}
			
			$sql2 = "SELECT * FROM order_magic WHERE ORDER_ID = '$order_id'";
			
			
			$result2 = $conn->query($sql2);
			$i =0;
		
			$total_salep = "";
			$total_pv = "";
		
			while($row2 = $result2->fetch_assoc()) {
			$i++;
				$total_salep = $row2["TOTAL_SALE"];
				$total_pv = $row2["TOTAL_PV"];
				$delivery = $row2["DELIVERY"];
			}	
			
			
echo "<tr height='20'><td></td></tr>";
echo "<tr><td colspan='5'><center><font size='5'><u>รายการสินค้า</u></font></center></td></tr>";
echo "<tr><td colspan='5'>&nbsp;</td></tr>";
echo "<table border = '1' style= border-collapse:collapse width='90%' align='center'><tr bgcolor='#FFCC00'><th width=10%>ลำดับที่</th><th>รายการสินค้า</th><th width=10%>จำนวน</th><th width=13%>ราคา</th><th width=13%>รวม</th></tr>";
			$sql = "SELECT a.ORDER_ID,a.ORDER_QTY , a.PRODUCT_ID, a.PRICE_SALE, a.PV, b.NAME ,b.PV  FROM order_detail a, product b
					WHERE a.PRODUCT_ID = b.ID AND a.ORDER_ID ='$order_id'";
			
			
			$result = $conn->query($sql);
			$i =0;
		
			while($row = $result->fetch_assoc()) {
			$i++;
			
			$name_p =	$row["NAME"];
			$order_qtyp =	$row["ORDER_QTY"];
			//$pv_p = $row["PV"];
		
			$price_sale = $row["PRICE_SALE"];
		

				echo "<tr align='center'><td width='60'>$i</td>";
				echo "<td align='left'>",$name_p ,"</td>";
				echo "<td width='80'>",$order_qtyp,"</td>";
				echo "<td width='80'>",$price_sale,"</td>";
			
				echo "<td width='80'>";
				printf("%.2f",$price_sale*$order_qtyp);
				echo "</td></tr>";
			}


function convert($number){ 
$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
$number = str_replace(",","",$number); 
$number = str_replace(" ","",$number); 
$number = str_replace("บาท","",$number); 
$number = explode(".",$number); 
if(sizeof($number)>2){ 
return 'ทศนิยมหลายตัว'; 
exit; 
} 
$strlen = strlen($number[0]); 
$convert = ''; 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[0], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
elseif($i==($strlen-2) AND $n==2){ $convert .= 'ยี่'; } 
elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
else{ $convert .= $txtnum1[$n]; } 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= 'บาท'; 
if($number[1]=='0' OR $number[1]=='00' OR $number[1]==''){ 
$convert .= 'ถ้วน'; 
}else{ 
$strlen = strlen($number[1]); 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[1], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){$convert .= 'หนึ่ง';} 
elseif($i==($strlen-2) AND $n==2){$convert .= 'ยี่';} 
elseif($i==($strlen-2) AND $n==1){$convert .= '';} 
else{ $convert .= $txtnum1[$n];} 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= 'สตางค์'; 
} 
return $convert; 
}
echo "<tr><td colspan='3' align='center'>- ค่าขนส่ง -</td><td colspan='3'><center> ";
printf("%.2f",$delivery);
echo " บาท</center></td></tr>";

echo "<tr><td colspan='3' align='center'>- รวมเป็นเงินทั้งสิน -</td><td colspan='3'><center> ";
printf("%.2f",$total_salep);
echo " บาท</center></td></tr></table>";
echo "<table border='0' width='90%'>";
echo "<tr height='50'><td></td></tr>";
echo "<tr><td colspan='5'> ท่านสามารถชำระเงินค่าสินค้าได้โดยการโอนเงินเข้าบัญชี <font color='blue'> <br/><br>1. ธนาคารกสิกรไทย สาขาศาลายา เลขที่บัญชี 459-0-42851-2  น.ส.ธารทิพย์  สังข์ทอง</br> <br>2. ธนาคารไทยพาณิชย์ สาขาเทสโก้ โลตัส ศาลายา เลขที่บัญชี 405-769701-4 นางสาวธารทิพย์  สังข์ทอง </br> <br>3. ธนาคารกรุงเทพ สาขา ทีโอที แจ้งวัฒนะ  เลขที่บัญชี 006-701163-5 นายวิเชียร  คงทน</br></font><br/> <br/></td></tr>";
echo "<tr height='20'><td></td></tr>";
echo "<tr><td colspan='6' align='right'>ลงชื่อ <u>$name</u></td></tr>";
echo "<tr><td colspan='6' align='right'>ลงวันที่ <u>$datenew</u></td></tr>
</table>";
echo "</table>";
echo "</div>";

$conn->close();
?>
</p>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<center> <input type="image" src="../images/printer.png" id=button1 name=button1 onClick="window.print()" width="60"  ><br>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>