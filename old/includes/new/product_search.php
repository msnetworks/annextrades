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
		cursor:pointer;
		z-index:99999 !important;
		list-style-type: none;
		padding-left: 0!important;
		background: #fff;
		max-height: 250px;
		margin: 0;
		overflow: auto;
		background: rgba(255,255,255,1);
		background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
		background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(47%, rgba(246,246,246,1)), color-stop(100%, rgba(237,237,237,1)));
		background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
		background: -o-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
		background: -ms-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
		background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=1 );
		
		
	}

	.list-gpfrm li:hover{
		padding:12px;
		color: white;
		
		background-color: #3d3d3d;

	}
	.ui-autocomplete { 
		
		}
		
		/* .ul{
			
		}
		.li{
			
		}  
 */
 
</style>
<div class="subscribe-form-group">
	<div class="form-group gst20">
		<?php 
			$sid = "/servicecompanyinfo.php?id=".$_GET['id']."&cid=".$_GET['cid']."&scid=".$_GET['scid'];
			@$cid = "/services.php?category=".$_GET['category'];
			@$ccid = "/services.php?page=2&qry=&category=";
			if($_SERVER['REQUEST_URI'] == '/service-categories.php' ||$_SERVER['REQUEST_URI'] == $ccid || $_SERVER['REQUEST_URI'] == '/services.php' || $_SERVER['REQUEST_URI'] == $cid || $_SERVER['REQUEST_URI'] == $sid){
		
		?>
		<form method="post" action="services.php" id="prosearching">
		
			<?php }else{ ?>
		<form method="post" action="products.php" id="prosearching">
		<?php } ?>
			<select class="Product-select" name="selectType" id="selectType">
				 <?php 
					if($_SERVER['REQUEST_URI'] == '/service-categories.php' ||$_SERVER['REQUEST_URI'] == $ccid || $_SERVER['REQUEST_URI'] == '/services.php' || $_SERVER['REQUEST_URI'] == $cid || $_SERVER['REQUEST_URI'] == $sid){
				?>
					<option value="services.php" <?php if($_SESSION['search'] == "services.php") { echo 'selected';} ?>>Services</option> 
					<option value="products.php" <?php if($_SESSION['search'] == "products.php") ?>>Product</option>
				<?php } else{ ?>
					<option value="products.php" <?php if($_SESSION['search'] == "products.php") { echo 'selected';}?>>Product</option>
					<option value="services.php" <?php if($_SESSION['search'] == "services.php")  ?>>Services</option> 
				<?php } ?>
			</select>
			<div class="input-gpfrm input-gpfrm-lg">
				<input type="text" name="p_name" placeholder="Type Keyword" id="querystr" class="form-catrole" autocomplete="off" aria-describedby="basic-addon2">
			<ul class="list-gpfrm" style="width: 94%;left: 3%; max-height: 250px; overflow-y: auto; "id="hdTuto_search" role="menu"></ul>
			</div>
              
				<?php 
				 
				 
					//echo $sid;
					if($_SERVER['REQUEST_URI'] == '/service-categories.php' ||$_SERVER['REQUEST_URI'] == $ccid || $_SERVER['REQUEST_URI'] == '/services.php' || $_SERVER['REQUEST_URI'] == $cid || $_SERVER['REQUEST_URI'] == $sid){
				?>
					<button class="subscribe-btn" style="background: #2baae1 !important;" name="Submit" type="submit">DISCOVER</button>
				<?php }else{ ?>
					<button class="subscribe-btn" name="Submit" type="submit">DISCOVER</button> 
				<?php } ?>
		</form>
		
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

<script type="text/javascript">
	
	$(document).ready(function(){

		//Autocomplete search using PHP, MySQLi, Ajax and jQuery

			//generate suggestion on keyup

			$('#querystr').keyup(function(e){
				
				e.preventDefault();

				var form = $('#prosearching').serialize();
					var page = $("#selectType").val();
					/* var page = $(this).val(); */
					console.log(page);
					if (page == 'products.php') {
						
						$.ajax({

							type: 'POST',

							url: 'includes/new/autocomplete.php?type=product',

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
						$(document).on('click', '.list-gpfrm-list', function(e){

							e.preventDefault();

							$('#hdTuto_search').hide();

							var fullname = $(this).data('fullname');

							$('#querystr').val(fullname);
							document.getElementById('prosearching').submit();
						});

					}
					else{
						$.ajax({

							type: 'POST',

							url: 'includes/new/autocomplete.php?type=service',

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
						$(document).on('click', '.list-gpfrm-list', function(e){

							e.preventDefault();

							$('#hdTuto_search').hide();

							var fullname = $(this).data('fullname');

							$('#querystr').val(fullname);
							document.getElementById('prosearching').submit();
						});
					}
				/* }); */
				//fill the input
				
			});
	});

</script>