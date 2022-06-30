<form  name="prosearching" method="post" action="sellnow.php?DIVIDd=StabTwo">
<div class="searchcont">
<table width="525" border="0" cellspacing="0" cellpadding="0">
<?php /*?><?php if($_SESSION['pro_name']!="")
{
$tttt=$_SESSION['pro_name'];
 } else { 
$tttt="Type Keyword";
} ?><?php */?>

    <tr>
      <td width="300"><!--<input type="text" name="p_name" id="textfield" class="searchbox" value="<?php echo $tttt; ?>"   onfocus="if(this.value == 'Type Keyword') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Type Keyword';}" onKeyPress="if(window.event.keyCode == '13'){ return false; }" />-->
      
      <input type="text" name="p_name" id="textfield" class="searchbox" value="<?php echo $tttt; ?>"   onfocus="if(this.value == 'Type Keyword') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Type Keyword';}" onKeyPress="if(window.event.keyCode == '13'){ return false; }" />
      </td>
      <td width="100" class="cate-listbg"><select name="country" id="country" class="cate-list">
        <option value="">------- <?php echo $country; ?> --------</option>
		<?php
		$select_coonnn="SELECT * FROM country";
		$res_coon=mysqli_query($con,$select_coonnn);
		while($fetch_coon=mysqli_fetch_array($res_coon))
		{
		/*if($_SESSION['country']==$fetch_coon['country_id'])
		{
		$selected="SELECTED";
		}
		else { $selected=""; } */
		?>
		<option value="<?php echo $fetch_coon['country_id']; ?>" <?php echo $selected; ?>><?php echo $fetch_coon['country_name']; ?></option>
		<?php }	?>
      </select>
      </td>
	   <td width="100" class="cate-listbg"><select name="category" id="category" class="cate-list">
        <option value="">------- <?php echo $category; ?> --------</option>
		<?php 
		$select_catttee="SELECT * FROM category WHERE parent_id=''";
		$res_catee=mysqli_query($con,$select_catttee);
		while($fetch_catee=mysqli_fetch_array($res_catee))
		{
		/*if($_SESSION['category']==$fetch_catee['c_id'])
		{
		$selected="SELECTED";
		}
		else { $selected=""; }*/
		?>
		<option value="<?php echo $fetch_catee['c_id']; ?>" <?php echo $selected; ?>><?php echo $fetch_catee['category']; ?></option>
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