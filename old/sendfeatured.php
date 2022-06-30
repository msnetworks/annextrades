<?php include("includes/header.php");

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

<?php include("includes/innerside3.php"); ?>
</div>

                   

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"> <span><strong> <?php echo $partner_with; ?> <?php echo $webname; ?></strong></span></div>
<div style="border: solid 1px #CFCFCF;">

             <table width="100%" cellspacing="0" cellpadding="0">
				  <form name="contact" method="post" action="" onsubmit="return validate(this);">
                    <tr>
                      <td colspan="2" align="center">&nbsp;</td>
                    </tr>
					<tr>
                    <td colspan="2" align="center"><h3><strong><?php echo $select_suucees_info; ?> !</strong></h3></td>  
                    </tr>
                    <tr>
                      <td colspan="2" align="center">&nbsp;</td>
                    </tr>
					</form>
                  </table>
                                    
                                
<div><?PHP echo $pagingLink;
     echo "<br>";?>
					  </div>
</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>
