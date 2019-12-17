<?php
	ob_start();
	session_start();
	// session_destroy();

	  // clear session product order.
	  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
	  {
		  unset($_SESSION['product_code'][$i]); 
		  unset($_SESSION['product_image'][$i]);
		  unset($_SESSION['product_amount'][$i]);
		  unset($_SESSION['intLine'][$i]);
	  }
	  
	  unset($_SESSION['intLine']);
	  unset($_SESSION['product_code']); 
	  unset($_SESSION['product_image']);
	  unset($_SESSION['product_amount']);


?>
