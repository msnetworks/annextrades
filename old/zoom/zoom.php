<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="zoom/doc/css/normalize.css" />
    <link rel="stylesheet" href="zoom/doc/css/foundation.css" />
    <link rel="stylesheet" href="zoom/doc/css/prism.css" />
    <link rel="stylesheet" href="zoom/doc/css/manual.css" />
    <script src="zoom/doc/js/vendor/modernizr.js"></script>
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  </head>

  <body>
  
  <div class="container">
    <div class="row">
    </div>
    <section>
      <div class="row">
        <div class="large-12 column">
          <p><pre><code class="language-markup"><!-- get jQuery from the google apis --><!-- 
          <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

          <!-- CSS STYLE-->
          <link rel="stylesheet" type="text/css" href="zoom/css/xzoom.css" media="all" />

          <!-- XZOOM JQUERY PLUGIN  -->
          <script type="text/javascript" src="zoom/js/xzoom.min.js"></script></code></pre>
          </p>    
          <div class="line"><span class="label alert round">Step 3</span>
          <p>Add the xzoom markup to your HTML document:</p>
          <p>
            <pre><code class="language-markup"><img class="xzoom" src="zoom/path/to/preview_image_01.jpg" xoriginal="zoom/path/to/original_image_01.jpg" />

            <div class="xzoom-thumbs">
            <a href="zoom/path/to/original_image_01.jpg">
                <img class="xzoom-gallery" width="80" src="zoom/path/to/thumbs_image_01.jpg"  xpreview="zoom/path/to/preview_image_01.jpg">
            </a>
            <a href="zoom/path/to/original_image_02.jpg">
                <img class="xzoom-gallery" width="80" src="zoom/path/to/preview_image_02.jpg">
            </a>
            <a href="zoom/path/to/original_image_03.jpg">
                <img class="xzoom-gallery" width="80" src="zoom/path/to/preview_image_03.jpg">
            </a>
            <a href="zoom/path/to/original_image_04.jpg">
                <img class="xzoom-gallery" width="80" src="zoom/path/to/preview_image_04.jpg">
            </a>
            </div></code></pre>
          </p>
          </div>
          <div class="line"><span class="label alert round">Step 4</span>
          <p>
            <pre><code class="language-javascript">/* calling script */
            $(".xzoom").xzoom({tint: '#333', Xoffset: 15});
            </code></pre>
          </p>
          </div>                        
        </div>       
      </div>
    </section>     
  </div>
    <script src="zoom/doc/js/vendor/jquery.js"></script>
    <script src="zoom/doc/js/foundation.min.js"></script>
    <script src="zoom/doc/js/vendor/prism.js"></script>
  </body>
</html>
