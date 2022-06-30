<?php include("includes/header.php");

//print_r($_REQUEST['property']);

 ?>

<script type="text/javascript">
  function searchlist(id) {
    var currentDiv;
    currentDiv = document.getElementById(id);
    if (currentDiv != null) {
	currentDiv.style.display = 'none';
    }
	else{  
    currentDiv.style.display = 'block';
    }
}

function checkbox() {
//alert("hai");
	var lengthcount=document.searching.maxvalue.value;
//alert(lengthcount);
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var property = "property["+i+"]";
	 
	  var dom = document.getElementById(property);//alert(dom);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	
	if(checkedcount < 1) {
			alert("Select Atleast One product");
			return false;
		}
   else if(checkedcount>3)
   {
   	alert("Select Maximum Three Products Only ");
	return false;	
   }
}
function compare(){
 //alert("hai");
	var result=checkbox();
	if(result == false) {
		return false;
	}
	else {
	 document.searching.submit();
	}
}
function comp()
{
document.searching.Submit.readOnly=false;
}

function checking()
{
alert("You can't add contact to your Own Product");
}
</script>

<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>

</div>

<?php include("includes/innerside1.php"); ?>
</div>

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"> <span><strong><?php echo $sitemap; ?></strong></span></div>
<div style="border: solid 1px #CFCFCF;">

<table border="0" width="100%" style="padding-left:5px; padding-top:10px; line-height:30px;">
	<tr><td style="padding-left:30px;"><a href="index.php"><?php echo $home; ?></a></td></tr>
	<tr><td><b><?php echo $product_seaches; ?></b></td></tr>
	<tr><td style="padding-left:30px;"><a href="products1.php?DIVIDd=StabThree"><?php echo $Product; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="sellnow.php?DIVIDd=StabTwo"><?php echo $selling_leads; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="buyers1.php?DIVIDd=StabOne"><?php echo $buy_now; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="traders.php?DIVIDd=StabFour"><?php echo $trade; ?></a></td></tr>
	<tr><td><b><?php echo $l_account; ?></b></td></tr>
	<tr><td style="padding-left:30px;"><a href="register.php"><?php echo $free_registration; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="login.php"><?php echo $loginn; ?></a></td></tr>
	<tr><td><b><?php echo $community; ?></b></td></tr>
	<tr><td style="padding-left:30px;"><a href="forum_new.php?id=1"><?php echo $forums; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="mainarticles.php"><?php echo $articles; ?></a></td></tr>
	<tr><td><b><?php echo $categories; ?></b></td></tr>
	<tr><td style="padding-left:30px;"><a href="buyers1.php"><?php echo $for_buyers; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="sellnow.php"><?php echo $for_sellers; ?></a></td></tr>
	<tr><td><b><?php echo $trade; ?></b></td></tr>
	<tr><td style="padding-left:30px;"><a href="traders.php"><?php echo $trade; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="tradeshow.php"><?php echo $up_trade; ?></a></td></tr>
	<tr><td><b><?php echo $market_info; ?></b></td></tr>
	<tr><td style="padding-left:30px;"><a href="help.php"><?php echo $help; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="contact.php"><?php echo $customer_ser; ?></a></td></tr>
	<tr><td style="padding-left:30px;"><a href="sitemap.php"><?php echo $site_map; ?></a></td></tr>
</table>

</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>