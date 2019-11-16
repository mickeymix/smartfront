 <?php
class LoginUser
	{
 

 

		function Login($username , $password,$conn) {
	
	 
				 $sql = "SELECT * FROM users WHERE email ='".$username."' AND password = '".$password."'";
				 $query = mysqli_query($conn, $sql);
				 
				
				$customer = new LoginUser();
			
				 
				 while ($result = mysqli_fetch_assoc($query)) {	
			
				$customer->customer_id  =	$result['customer_id'];
				$customer->firstname  =	$result['firstname'];
				$customer->lastname  =	$result['lastname'];
				 }
				 
				 return $customer;
				 
		}		 

	}
 
 ?>