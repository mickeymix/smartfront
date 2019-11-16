<?  session_start(); ?>
<?php
include 'backoffice/conn.php';



if($_GET["action"] == "logout"){
	session_destroy();
	 header( "Location: index.php" );
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">

    <title>ร้านไทยจราจร</title>

<?
ob_start();
require_once("header.php");

require_once("account/login_user.php");


?>
 <?
 
 
 	if($_POST["action"] == "1"){
	
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$address = $_POST["address"];
		$company = $_POST["company"];
		$sub_district = $_POST["district"];
		$amphur = $_POST["amphur"];
		$province = $_POST["province"];
		$postcode = $_POST["postcode"];
	
		$user_type = $_POST["user_type"];
	
		$sql = "INSERT INTO users ( firstname,lastname,username  ,password,email ,phone,address 
		,company ,sub_district ,amphur ,province ,postcode ,modify_date,insert_date,user_type)
		VALUES ('$firstname','$lastname','$email','$password','$email','$phone','$address'
		,'$company','$sub_district','$amphur','$province','$postcode',SYSDATE(),SYSDATE(),'$user_type')";
		
		$conn = mysqli_connect($host, $user, $pass, $dbname);

		mysqli_set_charset($conn,"utf8");
		
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$alert="New record created successfully";
			
			
			$obj = new LoginUser();
			
			$customer = $obj->Login($email,$password,$conn);
			
			if($customer->customer_id != null){
				
				$_SESSION["customer_id"] = $customer->customer_id;
				$_SESSION["firstname"] = $customer->firstname;
				$_SESSION["lastname"] = $customer->lastname;
				
				
			
				 header( "Location: index.php" );
			
			}else{
				$stats = "Username And Password Not Found";
			}
			
		//	$_SESSION["customer_id"] = $customer->customer_id;
		//	$_SESSION["firstname"] = $firstname;
		//	$_SESSION["lastname"] = $lastname;
		
		
		
		
	
		//	header( "Location: index.php" );
		} else {
			$alert="Error: " . $sql . "<br>" . $conn->error;
		}
		
		
		mysqli_close($conn);
	}
 ?>

 <script language=Javascript>
        function Inint_AJAX() {
           try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
           try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
           try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
           alert("XMLHttpRequest not supported");
           return null;
        };

        function dochange(src, val) {
             var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
                            document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
                       } 
                  }
             };
             req.open("GET", "address/localtion.php?data="+src+"&val="+val); //สร้าง connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //ส่งค่า
        }

        window.onLoad=dochange('province', -1);    

		//	$sql = "INSERT INTO users (customer_id, firstname,lastname,username  ,password,email ,phone,address 
	//	,company ,sub_district ,district ,province ,postcode ,modify_date,insert_date,user_type)
	//	VALUES ()";
		function validateForm() {
		  var x = document.forms["myForm"]["firstname"].value;
		  if (x == "") {
			alert("firstname must be filled out");
			return false;
		  }
		  
		   x = document.forms["myForm"]["lastname"].value;
		  if (x == "") {
			alert("lastname must be filled out");
			return false;
		  }
		  
		   x = document.forms["myForm"]["password"].value;
		  if (x == "") {
			alert("password must be filled out");
			return false;
		  }
		  
		   x = document.forms["myForm"]["email"].value;
		  if (x == "") {
			alert("email must be filled out");
			return false;
		  }
		  
		   x = document.forms["myForm"]["phone"].value;
		  if (x == "") {
			alert("phone must be filled out");
			return false;
		  }
		  
		   x = document.forms["myForm"]["address"].value;
		  if (x == "") {
			alert("address must be filled out");
			return false;
		  }
		  
		  
		  
		  x = document.forms["myForm"]["province"].value;
		  if (x == "0") {
			alert("province must be filled out");
			return false;
		  }
		  
		  x = document.forms["myForm"]["amphur"].value;
		
		  if (x == "0") {
			alert("district must be filled out");
			return false;
		  }
		  
		  x = document.forms["myForm"]["district"].value;
		  if (x == "0") {
			alert("sub-district must be filled out");
			return false;
		  }
		  
		  x = document.forms["myForm"]["postcode"].value;
		  if (x == "") {
			alert("postcode must be filled out");
			return false;
		  }
		  
			  x = document.forms["myForm"]["password"].value;
		 var  y = document.forms["myForm"]["PasswordConfirmation"].value;
		    if (x != y) {
			alert("password not match");
			return false;
		  }
		   
		}		
 </script>
        <div class="content-wrapper row">
            
            <main class="main container" role="main">
                
	<form name="myForm" id="registrationForm" action="register.php" onsubmit="return validateForm()" method="post">
		<div class="row col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<section class="row">
				<header>
					<h3>Account Information</h3>
				</header>

				<div id="accountInformation">
					<div class="row">
						<div class="form-group row">
							<label for="EmailAddress">Email Address</label>
							<span class="required_field">*</span>
							<input class="form-control" data-val="true" data-val-email="The Email Address field is not a valid e-mail address." data-val-required="The Email Address field is required." id="email" name="email" type="text" value="">
							<span class="field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true"></span>
						</div>
						<div class="form-group row">
							<label for="Password">Password</label>
							<span class="required_field">*</span>
							<input class="form-control" data-val="true" data-val-required="The Password field is required." id="password" name="password" type="password">
							<span class="field-validation-valid" data-valmsg-for="password" data-valmsg-replace="true"></span>
						</div>
						<div class="form-group row">
							<label for="PasswordConfirmation">Password Confirmation</label>
							<span class="required_field">*</span>
							<input class="form-control" data-val="true" data-val-equalto="&#39;Password Confirmation&#39; and &#39;Password&#39; do not match." data-val-equalto-other="*.Password" data-val-required="The Password Confirmation field is required." id="PasswordConfirmation" name="PasswordConfirmation" type="password">
							<span class="field-validation-valid" data-valmsg-for="PasswordConfirmation" data-valmsg-replace="true"></span>
						</div>
					
					</div>
				</div>
			</section>
			<section class="row">
				<header>
					<h3>Delivery address</h3>
				</header>
				
				<div>
					<label>&nbsp;</label>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="BillingAddress_FirstName">First Name</label>
						<span class="required_field">*</span>
						<input class="form-control" data-val="true" data-val-required="The First Name field is required." id="firstname" name="firstname" type="text" value="">
						<span class="field-validation-valid" data-valmsg-for="firstname" data-valmsg-replace="true"></span>
					</div>
					<div class="col-md-6">
						<label for="BillingAddress_LastName">Last Name</label>
						<span class="required_field">*</span>
						<input class="form-control" data-val="true" data-val-required="The Last Name field is required." id="lastname" name="lastname" type="text" value="">
						<span class="field-validation-valid" data-valmsg-for="lastname" data-valmsg-replace="true"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="BillingAddress_Company">Company</label>
					
					<input class="form-control" id="company" name="company" type="text" value="">
					<span class="field-validation-valid" data-valmsg-for="company" data-valmsg-replace="true"></span>
				</div>
				<div class="form-group">
					<label for="BillingAddress_AddressLine1">Address</label>
					<span class="required_field">*</span>
					<input class="form-control" data-val="true" data-val-required="The Address Line 1 field is required." id="address" name="address" type="text" value="">
					<span class="field-validation-valid" data-valmsg-for="address" data-valmsg-replace="true"></span>
				</div>
						
				<div class="form-group row">
					<div class="col-md-6">
						<label for="BillingAddress_State">Province</label>
						 <span class="required_field">*</span>           
						<span id="province"  >
							<select class="form-control" name="province">
								<option value="0">- เลือกจังหวัด -</option>
							</select>
						</span>
					</div>
					<div class="col-md-6">
						<label for="BillingAddress_City">District</label>
						    <span id="amphur">
								<select class="form-control" >
									<option value='0'>- เลือกอำเภอ -</option>
								</select>
							</span>
					</div>
				</div>
				<div class="form-group row">
			
					<div class="col-md-6">
						<label for="">Sub-District</label>
						<span class="required_field">*</span>
						<span id="district"  >
							<select class="form-control" >
								<option value='0'>- เลือกตำบล -</option>
							</select>
						</span>
					</div>
					
					
					<div class="col-md-6">
						<label for="BillingAddress_Zip">Postcode</label>
						<span class="required_field">*</span>
						<input class="form-control" data-val="true" data-val-regex="The Zip Code must be 5 digits." data-val-regex-pattern="[0-9]{5}" data-val-required="The Zip field is required." id="postcode" name="postcode" type="text" value="">
						<span class="field-validation-valid" data-valmsg-for="postcode" data-valmsg-replace="true"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="BillingAddress_Phone">Phone</label>
					<span class="required_field">*</span>
					<input class="form-control" data-val="true" data-val-required="The Phone field is required." id="phone" name="phone" type="text" value="">
					<span class="field-validation-valid" data-valmsg-for="phone" data-valmsg-replace="true"></span>
				</div>
	
			</section>
			
			<section class="row">
				<div class="form-group">
					<label>Shipping address type:</label>
				</div>
				<div class="radio-group">
					<label class="col-md-4">
						<input data-val="true" data-val-required="The Shipping Address Type field is required."  name="user_type" type="radio" checked  value="residential"> Residential
					</label>
					<label class="col-md-4">
						<input  name="user_type" type="radio" value="commercial"> Commercial
					</label>
				</div>
				<div>
					<span class="field-validation-valid" data-valmsg-for="ShippingAddress.AddressType" data-valmsg-replace="true"></span>
				</div>
			</section>
			<section class="col-md-8 col-md-push-2 row">
				<div class="label"> &nbsp; </div>
				<div class="form-action">
					<input type="submit" class=" btn btn-success btn-lg" value="Register">
				</div>
				<br/>
			</section>
		</div>
		<input type="hidden" name="action" value="1" />
	</form>

			</main>
			
        </div>

<?

include 'footer.php';
?>