<?php include("includes/header.php"); 


 ?>



<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?></div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>

</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"><?php echo $send_message_to_suupp; ?></div>
<div style="border: solid 1px #CFCFCF;" >

<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
						  <td>&nbsp;</td>
						  </tr>
                            <tr>
                              <td height="30" align="left" >
							
							  <img src="images/icon_N1.gif" width="36" height="37" /><strong><?php echo $thankumessages; ?></strong></td>
                            </tr>
                            <tr>
                              <td><form id="productupload1" name="productupload1" method="post" action="">
                                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                                  <tr>
                                    <td >
                                       
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="71%"><img src="images/icon_N2.gif" width="36" height="37" /><strong><?php echo $post_buying_leads; ?>!</strong></td>
                                              <td width="29%" align="center"><label> <a href="buying_leads2.php"><?php echo $post; ?> </a><a href="buying_leads2.php" class="topics"></a></label></td>
                                            </tr>
                                          </table>
                                    </td>
                                  </tr>
                                 
                                  
                                </table>
								<input type="hidden" value="<?PHP echo $s; ?>" name="maxvalue" />
                              </form></td>
                            </tr>
                            
          </table> 



</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>