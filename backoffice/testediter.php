<? include 'head.php';
	
	
$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");
?>
 
  <script src="js/popper1.14.5.js"></script>
  <script src="js/bootstrap4.1.3.js"></script>

  <!-- include summernote -->
  <link rel="stylesheet" href="dist/summernote-bs4.css">
  <script type="text/javascript" src="dist/summernote-bs4.js"></script>


  <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 300,
        tabsize: 2
      });
    });
  </script>
</head>
<body>
<div class="container">
  <h1>Summernote with Bootstrap 4</h1>
  <p>
    <span class="badge badge-primary">jQuery v3.3.1</span>
    <span class="badge badge-info">Bootstrap v4.1.3</span>
  </p>
  <div class="summernote"><p>Hello World</p></div>
</div>
</body>
</html>
