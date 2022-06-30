<!-- <!DOCTYPE html>
<!--
Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
- ->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- <link type="text/css" href="ckeditor5/sample/css/sample.css" rel="stylesheet" media="screen" /> -->
    <!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
    <!-- <script type='test/javascript' src='https://annextrades.com/ckeditor5/ckeditor.js'></script> - ->
	
</head>
<body>

<main>
     < ?php
    $data = str_replace( '&', '&amp;', $data );
?> -->
		<textarea name="p_bdes" id="editor"><?php  echo htmlspecialchars_decode( $bdes );?></textarea>
        <script>
            CKEDITOR.replace( 'editor' );
            CKEDITOR.config.allowedContent = true;
        </script>
        <!-- <script>
            CKEDITOR.on( 'instanceCreated', function( event ) {
            editor.config.basicEntities = false;
            editor.config.entities_greek = false; 
            editor.config.entities_latin = false; 
            editor.config.entities_additional = '';
            editor.config.fillEmptyBlocks = false;

            });
        </script> -->
<!-- </main> -->

<!-- <script src="ckeditor5/ckeditor.js"></script>
<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script> -->
<!-- <script>
	ClassicEditor
    .create( document.querySelector( '#editor' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        console.log( error );
    } );

</script> -->
<!--
<script>
    var data = CKEDITOR.instances.editor1.getData();

    // Your code to save "data", usually through Ajax.
</script>
 --> 
<!-- </body>
</html> -->
<!-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link href="ckeditor5/editor/src/css/wysiwyg.css" rel="stylesheet">
        <link href="ckeditor5/editor/src/css/highlight.min.css" rel="stylesheet">
        [if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="well" style="margin: 2rem 0;">
                        <div class="form-group">
                            <label class="control-label" for="editor">Message:</label> 
                            <textarea id="editor" class="form-control" name="p_bdes" rows="3">< ?php  echo htmlspecialchars( $bdes );?></textarea>
                        </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="ckeditor5/editor/src/js/wysiwyg.js"></script>
        <script src="ckeditor5/editor/src/js/highlight.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#editor').wysiwyg({

                });
            });
        </script>
    </body>
</html>
        -->