<?
	include 'head.php';
?>
<?


	$cus_id = $_GET["cus_id"];
	
	
	// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
    if($_GET["action"] == "999"){
		
	$id_card = $_GET["id_card"];
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
	
		$sql = "UPDATE  member_magic SET ID_CARD='$id_card' where ID = '$cus_id' ";
		

		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$alert="New record created successfully";
		} else {
			$alert="Error: " . $sql . "<br>" . $conn->error;
		}
		
	}
	
	 if($_GET["action"] == "998"){
		
	$id_tax = $_GET["id_tax"];
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
	
		$sql = "UPDATE  member_magic SET ID_TAX='$id_tax' where ID = '$cus_id' ";
		

		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$alert="New record created successfully";
		} else {
			$alert="Error: " . $sql . "<br>" . $conn->error;
		}
		
	}

?>
	<div id="wrapper">
        <?php include("top.php");?>   
           <!-- /. NAV TOP  -->
                <?php include("menu.php");?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>ข้อมูลลูกค้า</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                  <!-- /. ROW  -->
				   <?php if($alert<>""){ ?>
				  <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo "$alert"; ?>    
                   </div>
					 <?php } ?>		
		
				  <div style="height:10px;"></div>
        <div class="table-responsive">
        <table>
                                  
<? 

		

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "SELECT * FROM member_magic  where ID = '$cus_id' ORDER BY  INSERT_DATE DESC ";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
?>									
                                      
											
                                        </tr>
										<tr>
											<td align="right"><font color="red">ชื่อ: &nbsp;</font></td>
                                            <td> <? echo $row["NAME"] ?></td>
											
                                        </tr>
										<tr>
											<td align="right"><font color="red">Email: &nbsp;</font></td>
                                            <td> <? echo $row["EMAIL"] ?></td>
											
                                        </tr>
										<tr>
											<td align="right"><font color="red">Mem ID: &nbsp;</font></td>
                                            <td> <? echo $row["MEM_ID"] ?></td>
											
                                        </tr>
										<tr>
											<td align="right"><font color="red">Tel: &nbsp;</font></td>
                                            <td> <? echo $row["TEL"] ?></td>
											
                                        </tr>
										<tr>
											<td align="right"><font color="red">ที่อยู่: &nbsp;</font></td>
                                            <td> <? echo $row["ADDRESS"] ?> 
											
											
											<? echo $row["TAMBUL"] ?> 
											
											<? 
											
											
											$sql3 = "SELECT AMPHUR_NAME FROM amphur  where AMPHUR_ID = '".$row["AUMPER"]."' ";
										
											$result3 = $conn->query($sql3);
	   
											while($row3 = $result3->fetch_assoc()) {
											
											echo  $row3["AMPHUR_NAME"];
											
											}
											
											
											
											?> 
											
											
											
											
											
											<? 
											$sql2 = "SELECT PROVINCE_NAME FROM province  where PROVINCE_ID = '".$row["PROVIANCE"]."' ";
		
		
											$result2 = $conn->query($sql2);
	   
											while($row2 = $result2->fetch_assoc()) {
											
											echo  $row2["PROVINCE_NAME"];
											
											}

											?> 
											
											<? echo $row["ZIP_CODE"] ?></td>
											
                                        </tr>
										
										<tr>
											<td align="right"><font color="red">Birthday: &nbsp;</font></td>
                                            <td> <? echo $row["BIRTHDAY"] ?></td>
											
                                        </tr>
										<tr>
											<td align="right"><font color="red">วันที่สมัคร: &nbsp;</font></td>
                                            <td> <? echo $row["INSERT_DATE"] ?></td>
											
                                        </tr>
										<tr>
										<form  id="aaa" action="customerDetail.php">
											<td align="right"><font color="red">บัตรประชาชน: &nbsp;</font></td>
                                            <td><input type="text" name="id_card" value="<? echo $row["ID_CARD"] ?>" > 
											<a onclick="updateDataa();" ><img src="../images/edit.jpg" width="20px" ></a>
											<input type="hidden" name="action" value="999" />
											<input type="hidden" name="cus_id" value="<?=$row["ID"];?>" />
											</td>
										</form>	
                                        </tr>
										<tr>
										
											<input type="hidden" name="cus_id" value="<?=$row["ID"];?>" />
											</td>
										</form>	
                                        </tr>
										
										
										
<? 										
}
$conn->close();
?>             
<script>
	function updateDataa(){
		$( "#aaa" ).submit();
	}
	
	function updateDatab(){
		$( "#bbb" ).submit();
	}
</script>                          
                                    </tbody>
                                </table>
                            </div>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>	
<?
	include 'footer.php';
?>