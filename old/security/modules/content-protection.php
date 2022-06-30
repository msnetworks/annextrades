<?php
//Content Protection
$table   = $prefix . 'content-protection';
$query   = $mysqli->query("SELECT * FROM `$table`");
$query2  = $mysqli->query("SELECT * FROM `$table` WHERE function='selecting' OR function='printscreen' OR function='print' OR function='drag'");
$vsource = $mysqli->query("SELECT enabled FROM `$table` WHERE function='view_source' AND enabled=1 LIMIT 1");
$dtools  = $mysqli->query("SELECT enabled FROM `$table` WHERE function='developer_tools' AND enabled=1 LIMIT 1");

if ($srow['jquery_include'] == 1) {
    echo '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>';
}

while ($row2 = $query2->fetch_assoc()) {
    
    //Disable Selecting
    if ($row2['function'] == 'selecting' && $row2['enabled'] == 1) {
        echo '
<style>
/*  */
body{
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>
';
    }
    
    //Disable PrintScreen
    if ($row2['function'] == 'printscreen' && $row2['enabled'] == 1) {
        echo '
<style>
@media print {
    html, body {
       display: none;  // Hides the whole page
    }
}
</style>';
    }
    
    //Disable Printing
    if ($row2['function'] == 'print' && $row2['enabled'] == 1) {
        echo '
<style type="text/css" media="print">
    /* Disable Printing */
    * { display: none; }
</style>';
    }
    
    //Disable Drag
    if ($row2['function'] == 'drag' && $row2['enabled'] == 1) {
        echo '
<style>
*, *::after, *::before {
	-webkit-user-select: none;
	-webkit-user-drag: none;
	-webkit-app-region: no-drag;
	cursor: default;
}
</style>';
    }
}

echo '<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {';

while ($row = $query->fetch_assoc()) {
    
    //Disable Right Click (Context Menu)
    if ($row['function'] == 'rightclick' && $row['enabled'] == 1) {
        echo '
      $(document).bind("contextmenu",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
';
    }
    
    //Disable Right Click on Images
    if ($row['function'] == 'rightclick_images' && $row['enabled'] == 1) {
        echo '
$(\'img\').bind(\'contextmenu\', function(e){
';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
return false;
}); 
';
    }
    
    //Disable Cut
    if ($row['function'] == 'cut' && $row['enabled'] == 1) {
        echo '
      $(document).bind("cut",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
';
    }
    
    //Disable Copy
    if ($row['function'] == 'copy' && $row['enabled'] == 1) {
        echo '
      $(document).bind("copy",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
';
    }
    
    //Disable Paste
    if ($row['function'] == 'paste' && $row['enabled'] == 1) {
        echo '
      $(document).bind("paste",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
';
    }
    
    //Disable Drag
    if ($row['function'] == 'drag' && $row['enabled'] == 1) {
        echo '
      document.body.setAttribute("draggable",false);
	  $(document).bind("drag",function(e) {
          e.preventDefault();
      });

$(document.body).bind("dragover", function(e) {
            e.preventDefault();
            return false;
       });
';
    }
    
    //Disable Drop
    if ($row['function'] == 'drop' && $row['enabled'] == 1) {
        echo '
      $(document).bind("drop",function(e) {
          e.preventDefault();
      });
';
    }
    
    //Disable PrintScreen
    if ($row['function'] == 'printscreen' && $row['enabled'] == 1) {
        echo '
$(document).keyup(function (e) {
    if(!e) e = window.event;
    var keyCode = e.which || e.keyCode
    if (keyCode  == 44) {
        ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
		$("body").hide();
        ccd();
    }
});

';
    }
    
    //Disable Printing
    if ($row['function'] == 'print' && $row['enabled'] == 1) {
        echo '
jQuery(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
        ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
        return false;
    }
});
';
    }
    
    //Keep the website out of frames
    if ($row['function'] == 'iframe_out' && $row['enabled'] == 1) {
        echo '
if(top.location!=self.location) top.location=self.location;
';
    }
    
    //Disable View Source Keyboard Shortcut
    if ($row['function'] == 'view_source' && $row['enabled'] == 1) {
        echo '
document.onkeydown = function(e) {
        if (e.ctrlKey && (e.keyCode === 85)) {
            ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
            return false;
        }';
        if ($dtools->num_rows <= 0) {
            echo '};';
        }
    }
    
    //Disable Browser's Developer Tools (Console)
    if ($row['function'] == 'developer_tools' && $row['enabled'] == 1) {
        if ($vsource->num_rows <= 0) {
            echo 'document.onkeydown = function(e) {';
        }
        echo '
		if (e.keyCode === 123) {
            ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
            return false;
        }
};
';
    }
}

echo '
}, false);
</script>
';
?>