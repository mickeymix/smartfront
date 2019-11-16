<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link href="css/application.css" rel="stylesheet"/>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="js/slider.js"></script>
<style>
.container { margin:150px auto; }
h1 { text-align:center;}
</style>
</head>
<body>
<div id="jquery-script-menu">
<div class="jquery-script-center">
<ul>
<li><a href="http://www.jqueryscript.net/slider/Multi-slide-Carousel-jQuery.html">Download This Plugin</a></li>
<li><a href="http://www.jqueryscript.net/">Back To jQueryScript.Net</a></li>
</ul>
<div class="jquery-script-ads"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<div class="jquery-script-clear"></div>
</div>
</div>
  <div class="container">
  <h1> Multi-slide Image Carousel Demo</h1>
    <div class="container_row">

      <!-- First slider -->
      <div id="slider" class="slider slider_first">
        <div class="slider_viewport">
          <div class="slider_list">
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=390"></div>
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=388"></div>
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=407"></div>
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=435"></div>
          </div>
        </div>
        <div class="slider_nav">
          <div class="slider_arrow slider_arrow__left"></div>
          <div class="slider_arrow slider_arrow__right"></div>
        </div>
        <div class="slider_control-nav">
          <!-- All this selectors must be created dynamically. They are here just for example -->
        </div>
      </div>

    </div>

    <!-- Second slider. Carousel -->
    <div class="container_row">      
      <div id="carousel" class="slider slider_second">
        <div class="slider_viewport">
          <div class="slider_list">
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=390"></div>
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=388"></div>
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=407"></div>
            <div class="slider_item"><img src="https://unsplash.it/600/400?image=435"></div>
          </div>
        </div>
        <div class="slider_nav">
          <div class="slider_arrow slider_arrow__left"></div>
          <div class="slider_arrow slider_arrow__right"></div>
        </div>
        <div class="slider_control-nav">
          <!-- All this selectors must be created dynamically. They are here just for example -->
        </div>
      </div>
    </div>

   

</div>

  <script>
    var $slider = $('#slider').slider();
    var $carousel = $('#carousel').slider({
      interval: 3000,
      items: 2,
      loop: true,
      imgWidth: 300,
      callback: function(number) {
        console.log('Current carousel slide - ' + number);
      }
    });
    
    console.log('Total number of slides - ' + $slider.getSlidesCount());
  </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
