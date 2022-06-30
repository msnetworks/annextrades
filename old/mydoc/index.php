<html>
<head>
  <title>Share QR</title>
    <meta name="viewport" content="width=device-width,height=device-height,minimum-scale=1,maximum-scale=1"/>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" /> 
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>

<body>
  <div data-role="page" id="article1">
    <div data-role="header" data-theme="b" data-position="fixed" data-id="footer">
      <h1>Articles</h1>
    </div>
    <div data-role="content">
      <p>Article 1</p>
    </div>
  </div>

  <div data-role="page" id="article2">
    <div data-role="header" data-theme="b" data-position="fixed" data-id="footer">
      <a href="#article1" data-icon="home" data-iconpos="notext">Home</a>
      <h1>Articles</h1>
    </div>
    <div data-role="content">
      <p>Article 2</p>
    </div>
  </div>

  <div data-role="page" id="article3">
    <div data-role="header" data-theme="b" data-position="fixed" data-id="footer">
      <a href="#article1" data-icon="home" data-iconpos="notext">Home</a>
      <h1>Articles</h1>
    </div>
    <div data-role="content">
      <p>Article 3</p>
    </div>
    </div>

</body>
</html>
<script>
    $(document).on('swipeleft', '.ui-page', function(event){    
    if(event.handled !== true) // This will prevent event triggering more then once
    {    
        var nextpage = $.mobile.activePage.next('[data-role="page"]');
        // swipe using id of next page if exists
        if (nextpage.length > 0) {
            $.mobile.changePage(nextpage, {transition: "slide", reverse: false}, true, true);
        }
        event.handled = true;
    }
    return false;         
    });

    $(document).on('swiperight', '.ui-page', function(event){     
        if(event.handled !== true) // This will prevent event triggering more then once
        {      
            var prevpage = $(this).prev('[data-role="page"]');
            if (prevpage.length > 0) {
                $.mobile.changePage(prevpage, {transition: "slide", reverse: true}, true, true);
            }
            event.handled = true;
        }
        return false;            
    });
</script>