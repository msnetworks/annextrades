

<?php
$currentFile = basename($_SERVER['PHP_SELF'], ".php");

$firstCharacter = $firstname[0];
?>
<?php 
	if($page == 'services' ||   $page == 'servicecompanyinfo') { ?>
		<form  name="prosearching" id="prosearching" method="post" action="services.php">
<?php }
else{
	?>
	<form  name="prosearching" id="prosearching" method="post" action="products.php">
	<?php }
	?>

<div class="searchcont">
<table width="525" border="0" cellspacing="0" cellpadding="0">
    <tr>
	<td class="selectType">
	  	<select name="selectType" id="selectType">
			<?php 
				if($page == 'services' ||   $page == 'servicecompanyinfo') { ?>
					<option value="products1.php">Services</option>
			<?php }
			else{
		  ?>
		  <option value="products.php">Products</option>
		  <?php }
		  ?>		
		</select>
	  </td>
      <td width="300"><!--<input type="text" name="p_name" id="textfield" class="searchbox" value="Type Keyword"   onfocus="if(this.value == 'Type Keyword') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Type Keyword';}" onKeyPress="if(window.event.keyCode == '13'){ return false; }" /> -->
      <input type="text" name="p_name" id="textfield" class="searchbox" value="Type Keyword"   onfocus="if(this.value == 'Type Keyword') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Type Keyword';}" onKeyPress="if(window.event.keyCode == '13'){ return false; }" />
      </td>	 
      <td width="100" class="cate-listbg"><select name="country" id="country" class="cate-list">
        <option value="">------- <?php echo $country; ?> --------</option>
		<?php
		if($_SESSION['language']=='english')
		{
		$select_coonnn="SELECT * FROM country";
		}
		
		//$select_coonnn="SELECT * FROM country";
		$res_coon=mysqli_query($con,$select_coonnn);
		while($fetch_coon=mysqli_fetch_array($res_coon))
		{
		?>
		<option value="<?php echo $fetch_coon['country_id']; ?>"><?php echo $fetch_coon['country_name']; ?></option>
		<?php }	?>
      </select>
      </td>
	   <td width="100" class="cate-listbg"><select name="category" id="category" class="cate-list">
        <option value="">------- <?php echo $category; ?> --------</option>
		<?php 
		if($_SESSION['language']=='english')
			{
			$select_catttee="SELECT * FROM category WHERE parent_id=''";
			}
			
		//$select_catttee="SELECT * FROM category WHERE parent_id=''";
		$res_catee=mysqli_query($con,$select_catttee);
		while($fetch_catee=mysqli_fetch_array($res_catee))
		{
		?>
		<option value="<?php echo $fetch_catee['c_id']; ?>"><?php echo $fetch_catee['category']; ?></option>
		<?php } ?>
      </select>
      </td>
      
    </tr>
  </table>
  
  
  
</div>

<div class="search-button-cont">
  <a><input name="Submit" type="submit" value="Discover"/></a>
</div>

</form>

<script>
jQuery('#selectType').change(function(){

	var page  = $(this).val();
	$('#prosearching').attr('action',page);
});
</script>