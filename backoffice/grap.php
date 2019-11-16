<?php // content="text/plain; charset=utf-8"
// $Id: groupbarex1.php,v 1.2 2002/07/11 23:27:28 aditus Exp $
date_default_timezone_set("Asia/Bangkok");
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
 

$username = "root";
$password = "rootroot";
$dbname = "thai_cloth";
	
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
		
	

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$d1 = 0;
		$d2 = 0;
		$d3 = 0;
		$d4 = 0;
		$d5 = 0;
		$d6 = 0;
		$d7 = 0;
		$d8 = 0;
		$d9 = 0;
		$d10 = 0;
		$d11 = 0;
		$d12 = 0;
		
		if($_GET["dt"] == "1"){
			$dateStart = $_GET["dateStart"];
			
			$sql = "SELECT  YEAR(INSERT_DATE),MONTH(INSERT_DATE) AS MM , TOTAL_SALE FROM order_magic WHERE YEAR(INSERT_DATE) = $dateStart ORDER BY INSERT_DATE DESC";
		}else{
			$sql = "SELECT  YEAR(INSERT_DATE),MONTH(INSERT_DATE) AS MM , TOTAL_SALE FROM order_magic WHERE YEAR(INSERT_DATE) = YEAR(SYSDATE()) ORDER BY INSERT_DATE DESC";
		}
		
		
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) { 
	
			if($row["MM"] == "1"){ 
			$d1 = $d1 + $row["TOTAL_SALE"];
			}else if($row["MM"] == "2"){
			$d2 = $d2 + $row["TOTAL_SALE"];
			}else if($row["MM"] == "3"){
			$d3 = $d3 + $row["TOTAL_SALE"];
			}else if($row["MM"] == "4"){
			$d4 = $d4 + $row["TOTAL_SALE"];
			}else if($row["MM"] == "5"){
			$d5 = $d5 + $row["TOTAL_SALE"];	
			}else if($row["MM"] == "6"){
			$d6 = $d6 + $row["TOTAL_SALE"];	
			}else if($row["MM"] == "7"){
			$d7 = $d7 + $row["TOTAL_SALE"];	
			}else if($row["MM"] == "8"){
			$d8 = $d8 + $row["TOTAL_SALE"];	
			}else if($row["MM"] == "9"){
			$d9 = $d9 + $row["TOTAL_SALE"];	
			}else if($row["MM"] == "10"){
			$d10 = $d10 + $row["TOTAL_SALE"];
			}else if($row["MM"] == "11"){
			$d11 = $d11 + $row["TOTAL_SALE"];	
			}else if($row["MM"] == "12"){
			$d12 = $d12 + $row["TOTAL_SALE"];	
			}

		
		
		
		}
		$conn->close();
	
 
$datay1=array($d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12);
//$datay2=array(35,190,190,190,190,190);
//$datay3=array(20,70,70,140,230,260);
 
$graph = new Graph(1000,400,'auto');    
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->img->SetMargin(50,40,50,50);
$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
 
$graph->xaxis->title->Set('Year 2017');
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
$graph->title->Set('SALE FOR YEAR');
$graph->title->SetFont(FF_FONT1,FS_BOLD);
 
$bplot1 = new BarPlot($datay1);
//$bplot2 = new BarPlot($datay2);
//$bplot3 = new BarPlot($datay3);
 
$bplot1->SetFillColor("orange");
//$bplot2->SetFillColor("brown");
//$bplot3->SetFillColor("darkgreen");
 
$bplot1->SetShadow();
//$bplot2->SetShadow();
//$bplot3->SetShadow();
 
$bplot1->SetShadow();
//$bplot2->SetShadow();
//$bplot3->SetShadow();
 
$gbarplot = new GroupBarPlot(array($bplot1));
$gbarplot->SetWidth(0.6);
$graph->Add($gbarplot);
 
$graph->Stroke();
?>			