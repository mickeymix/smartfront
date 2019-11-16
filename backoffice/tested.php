<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Summernote - Bootstrap 4</title>
  <!-- include jquery -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

  <!-- include libs stylesheets -->
  <link rel="stylesheet" href="css/bootstrap4.1.3.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.5/umd/popper.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.js"></script>

  <!-- include summernote -->
  <link rel="stylesheet" href="dist/summernote-bs4.css">
  <script type="text/javascript" src="dist/summernote-bs4.js"></script>

  <link rel="stylesheet" href="examples/example.css">
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
