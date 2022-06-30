<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../css/froala_editor.css">
  <link rel="stylesheet" href="../../css/froala_style.css">
  <link rel="stylesheet" href="../../css/plugins/code_view.css">
  <link rel="stylesheet" href="../../css/plugins/colors.css">
  <link rel="stylesheet" href="../../css/plugins/emoticons.css">
  <link rel="stylesheet" href="../../css/plugins/image_manager.css">
  <link rel="stylesheet" href="../../css/plugins/image.css">
  <link rel="stylesheet" href="../../css/plugins/line_breaker.css">
  <link rel="stylesheet" href="../../css/plugins/table.css">
  <link rel="stylesheet" href="../../css/plugins/char_counter.css">
  <link rel="stylesheet" href="../../css/plugins/video.css">
  <link rel="stylesheet" href="../../css/plugins/fullscreen.css">
  <link rel="stylesheet" href="../../css/plugins/file.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

  <style>
    body {
      text-align: center;
    }

    div#editor {
      width: 81%;
      margin: auto;
      text-align: left;
    }
  </style>
</head>

<body>
  <div id="editor">
    <div id='edit' style="margin-top: 30px;">
      <h1>Sticky Toolbar</h1>

      <p>This is the full featured Froala WYSIWYG HTML editor with Sticky Toolbar.</p>

      <img class="fr-fir fr-dii" src="../../img/photo1.jpg" alt="Old Clock" width="300" />Lorem <strong>ipsum</strong>
      dolor sit amet, consectetur <strong>adipiscing <em>elit.</em> Donec</strong> facilisis diam in odio iaculis
      blandit. Nunc eu mauris sit amet purus <strong>viverra</strong><em> gravida</em> ut a dui.<br />
      <ul>
        <li>Vivamus nec rutrum augue, pharetra faucibus purus. Maecenas non orci sagittis, vehicula lorem et, dignissim
          nunc.</li>
        <li>Suspendisse suscipit, diam non varius facilisis, enim libero tincidunt magna, sit amet iaculis eros libero
          sit amet eros. Vestibulum a rhoncus felis.<ol>
            <li>Nam lacus nulla, consequat ac lacus sit amet, accumsan pellentesque risus. Aenean viverra mi at urna
              mattis fermentum.</li>
            <li>Curabitur porta metus in tortor elementum, in semper nulla ullamcorper. Vestibulum mattis tempor tortor
              quis gravida. In rhoncus risus nibh. Nullam condimentum dapibus massa vel fringilla. Sed hendrerit sed est
              quis facilisis. Ut sit amet nibh sem. Pellentesque imperdiet mollis libero.</li>
          </ol>
        </li>
      </ul>

      <table style="width: 100%;">
        <tr>
          <td style="width: 25%;"></td>
          <td style="width: 25%;"></td>
          <td style="width: 25%;"></td>
          <td style="width: 25%;"></td>
        </tr>
        <tr>
          <td style="width: 25%;"></td>
          <td style="width: 25%;"></td>
          <td style="width: 25%;"></td>
          <td style="width: 25%;"></td>
        </tr>
      </table>

      <a href="http://google.com" title="Aenean sed hendrerit">Aenean sed hendrerit</a> velit. Nullam eu mi dolor.
      Maecenas et erat risus. Nulla ac auctor diam, non aliquet ante. Fusce ullamcorper, ipsum id tempor lacinia, sem
      tellus malesuada libero, quis ornare sem massa in orci. Sed dictum dictum tristique. Proin eros turpis, ultricies
      eu sapien eget, ornare rutrum ipsum. Pellentesque eros nisl, ornare nec ipsum sed, aliquet sollicitudin erat.
      Nulla tincidunt porta <strong>vehicula.</strong><br />
    </div>

    <p><strong>This is some dummy text so you can see the sticky toolbar in action.</strong></p>

  </div>

  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

  <script type="text/javascript" src="../../js/froala_editor.min.js"></script>

  <script type="text/javascript" src="../../js/plugins/align.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/code_beautifier.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/code_view.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/colors.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/draggable.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/emoticons.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/font_size.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/font_family.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/image.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/file.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/image_manager.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/line_breaker.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/link.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/lists.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/paragraph_format.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/paragraph_style.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/video.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/table.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/url.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/entities.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/char_counter.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/inline_style.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/save.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/fullscreen.min.js"></script>
  <script type="text/javascript" src="../../js/plugins/quote.min.js"></script>

  <script>
    (function () {
      new FroalaEditor("#edit")
    })()
  </script>
</body>

</html>