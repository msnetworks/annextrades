<?php
 session_start();
 if (isset($_POST['Submit'])) { 
 $_SESSION['search'] = $_POST['selectType'];
 } 

?> 
<style type="text/css">

	.gst20{

		margin-top:20px;

	}

	#hdTuto_search{

		display: none;

	}

	.list-gpfrm-list a{

		text-decoration: none !important;

	}

	.list-gpfrm li{
		
		cursor: pointer;

		padding: 4px 0px;

	}

	.list-gpfrm{
		position: absolute; 
		cursor: default;
		z-index:30 !important;
		list-style-type: none;
		padding: 15px;
		background: #fff;
		height: 250px;
		overflow: scroll;
	}

	.list-gpfrm li:hover{

		color: white;

		background-color: #3d3d3d;

	}
	.ui-autocomplete { 
		
		}  

</style>
<?php
	$currentFile = basename($_SERVER['PHP_SELF'], ".php"); 
?>
				
<div class="subscribe-form-group" style="width: 500px !important;">
	<div class="form-group">
		<form method="post" action="products.php" id="prosearching">
			<select class="Product-select" name="selectType" id="selectType">
				 <?php
				 
				 
				 /*$sid = "/servicecompanyinfo.php?id=".$_GET['id']."&cid=".$_GET['cid']."&scid=".$_GET['scid'];
				  		@$ccid = "/services.php?page=2&qry=&category=";
                        //echo $sid;
						if($_SERVER['REQUEST_URI'] == '/service-categories.php' || 
						$_SERVER['REQUEST_URI'] == '/services.php' || 
						$_SERVER['REQUEST_URI'] == $sid || $_SERVER['REQUEST_URI'] == $ccid){ */
					if ($currentFile == 'services' ||   $currentFile == 'servicecompanyinfo'){ 
				?>
				<option value="services.php" <?php if($_SESSION['search'] == "services.php") { echo 'selected';} ?>> Services</option> 
				<option value="products.php" <?php if($_SESSION['search'] == "products.php") { echo 'selected';}?>>Product</option>
				<?php }else{ ?>
					<option value="products.php" <?php if($_SESSION['search'] == "products.php") { echo 'selected';}?>>Product</option>
					<option value="services.php" <?php if($_SESSION['search'] == "services.php") { echo 'selected';} ?>>Services</option> 
				<?php } ?>
			</select>
			<input type="text" name="p_name" placeholder="Type Keyword" id="querystr" class="form-catrole" autocomplete="off" aria-describedby="basic-addon2">
			
				<?php 
				 
				/*  $sid = "/servicecompanyinfo.php?id=".$_GET['id']."&cid=".$_GET['cid']."&scid=".$_GET['scid'];
				 @$cid = "/services.php?category=".$_GET['category'];
				 @$ccid = "/services.php?page=2&qry=&category=";
					//echo $sid;
					if($_SERVER['REQUEST_URI'] == '/service-categories.php' ||$_SERVER['REQUEST_URI'] == $ccid || $_SERVER['REQUEST_URI'] == '/services.php' || $_SERVER['REQUEST_URI'] == $cid || $_SERVER['REQUEST_URI'] == $sid){ */
					if ($currentFile == 'services' ||   $currentFile == 'servicecompanyinfo'){ 
				?>
					<button class="subscribe-btn" style="background: #2baae1 !important;" name="Submit" type="submit">DISCOVER</button>
				<?php }else{ ?>
					<button class="subscribe-btn" name="Submit" type="submit">DISCOVER</button> 
				<?php } ?>
		</form>
		<ul class="list-gpfrm" id="hdTuto_search"></ul>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#selectType').change(function() {
			var page = $(this).val();
			$($(this)).parent('#prosearching').attr('action', page);
		});
	});
</script> 


<!-- <script type="text/javascript">
	
	$(document).ready(function(){

	//Autocomplete search using PHP, MySQLi, Ajax and jQuery

		//generate suggestion on keyup

		$('#querystr').keyup(function(e){
			
			e.preventDefault();

			var form = $('#prosearching').serialize();
			
			$.ajax({

				type: 'POST',

				/* url: 'includes/new/autocomplete.php', */

				data: form,

				dataType: 'json',

				success: function(response){

					if(response.error){

						$('#hdTuto_search').hide();

					}

					else{

						$('#hdTuto_search').show().html(response.data);

					}

				}

			});

		});

		

		//fill the input

		$(document).on('click', '.list-gpfrm-list', function(e){

			e.preventDefault();

			$('#hdTuto_search').hide();

			var p_name = $(this).data('p_name');

			$('#querystr').val(p_name);

		});

	});

</script> -->
