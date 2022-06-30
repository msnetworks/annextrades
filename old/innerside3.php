<div class="bluebox-cont"> 

<div class="blueheading"> Locations</div>
<div class="blue-content">
<ul> 
<?php 
if($_SESSION['language']=='english')
{
$select_countttt="SELECT * FROM country WHERE RAND() LIMIT 0,5";
}
else if($_SESSION['language']=='french')
{
$select_countttt="SELECT * FROM country_french WHERE RAND() LIMIT 0,5";
}
else if($_SESSION['language']=='chinese')
{
$select_countttt="SELECT * FROM country_chinese WHERE RAND() LIMIT 0,5";
}
else
{
$select_countttt="SELECT * FROM country_spanish WHERE RAND() LIMIT 0,5";
}
//$select_countttt="SELECT * FROM country WHERE RAND() LIMIT 0,5";
$res_counnttt=mysqli_query($con,$select_countttt);
while($fetch_countt=mysqli_fetch_array($res_counnttt)
{
?>


<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> </a><span>(2485)</span></div> </li>
<?php } ?>

<!--<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>-->


</ul>

<span class="more2"><a href="#"> More....</a></span></div>

</div>




<!--<div class="bluebox-cont"> 

<div class="blueheading">Group Products</div>
<div class="blue-content">
  <a href="#">All Products</a> <br/> 
  <strong><a href="#">1  Product Per Company </a></strong></div>

</div>-->

<!--<div class="bluebox-cont"> 

<div class="blueheading">Search Options</div>
<div class="blue-content">

  <table width="167" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" align="left" valign="top"><select name="select2" id="select2" class="selectbox">
        <option>Select Certification</option>
      </select>      </td>
    </tr>
    <tr>
      <td width="22" align="left" valign="top"><input type="checkbox" name="checkbox" id="checkbox" /></td>
      <td width="145" align="left" valign="top">Show Premium Suppliers</td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><input type="submit" name="button" id="button" value="Search" class="search-btn" /></td>
    </tr>
  </table>
</div>

</div>-->