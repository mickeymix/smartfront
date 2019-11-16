<?  
// ini_set('session.gc_maxlifetime', 5000000);
// session_set_cookie_params(50000000); 
session_start(); 

?>
<?php

	include 'conn.php';
    
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_set_charset($conn, "utf8");
	if($_SESSION["username_log"] == null){
		echo "<script> window.location ='index.php'; </script>";
		
	}else{
        $sessionLogin = $_SESSION["username_log"];
        $sql = "SELECT * FROM admin_master Where adminusername ='".$sessionLogin."'";
    
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $username_log = $row["adminname"];
	}	
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Thai Traffic</title>
        <meta name="description" content="Pushy is an off-canvas navigation menu for your website.">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/demo.css">
        <!-- Pushy CSS -->
        <link rel="stylesheet" href="css/pushy.css">
        
        <!-- jQuery -->
        <script src="js/jquery3.3.1.js"></script>
		
		
	<!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    </head>
    <body>

   <script>
		function backHome(url_home){
			location.href = url_home;
		}
		
		function resetDataAll(){
			if (confirm('ระวัง!!! คุณต้องการลบข้อมูลทั้งหมดใช่หรือไม่ ??')) {
					location.reload();
			} else {
				// Do nothing!
			}
		
		}
		
		
		
	</script>

       

     