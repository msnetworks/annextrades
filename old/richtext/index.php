<html>
    <head>
        <meta charset="utf-8">
		<!-- <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script> -->
		<!-- // Avaliable Packages
		// Standard -->
		<!-- <script src="//cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script> -->
		<!-- // Basic -->
		<!-- <script src="//cdn.ckeditor.com/4.10.1/basic/ckeditor.js"></script> -->
		<!-- // Full -->
		<!-- <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script> -->
		<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    </head>
    <body>
        <textarea name="p_bdes" class="form-control"><?php echo htmlspecialchars_decode($bdes); ?></textarea>
        <script>
            CKEDITOR.replace( 'p_bdes' );
		</script>
		<br><br>
		<!-- <span class="mandory">*</span> < ?php echo $detail_des; ?>
		<textarea name="p_ddes">< ?php echo htmlspecialchars_decode($ddes); ?></textarea>
        <script>
            CKEDITOR.replace( 'p_ddes' );
        </script> -->
    </body>
</html>