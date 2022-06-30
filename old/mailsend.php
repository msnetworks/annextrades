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
<div class="cate-heading"> <?php echo $browse; ?></div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>

<?php
$pro=$_REQUEST['id'];
$res="select * from buyingleads where buy_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
//$id=$result['user_id'];
$id=$result['id'];
$res3=mysqli_query($con,"select * from country where country_id='$result[seller_country]'");
$result1=mysqli_fetch_array($res3);
$result1['country'];
?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <span> <?php echo $mail_sent; ?></span></div>
<div style="border: solid 1px #CFCFCF;">




 
<div style="color:#009900; font-size:16px; font-weight:bold; padding:100px;"> <?php echo $mail_sent_success; ?></div>  




</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>


