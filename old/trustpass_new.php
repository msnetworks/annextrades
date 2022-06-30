<?php 
  include("includes/header.php");

  //session_start();
  $sess_id=$_SESSION['user_login']; 
  $hh=$_SESSION['hh'];
  $mem=mysqli_query($con,"select * from membersettings");
  $fetchmem=mysqli_fetch_array($mem);
  $produ=$fetchmem['gold_year'];
  $sillver_year=$fetchmem['sillver_year'];
  $bronze_year=$fetchmem['bronze_year'];
  $gold_amount=$fetchmem['gold_amount'];
  $silver_amount=$fetchmem['silver_amount'];
  $bronze_amount=$fetchmem['bronze_amount'];

  $select_sql=mysqli_query($con,"select * from registration where id='$sess_id'");
  $fet=mysqli_fetch_array($select_sql);

  if(isset($_REQUEST['Submit']))
  {

  $pay=$_POST['pay'];
  $currentdate=date("Y.m.d");
  //echo "select * from payment_tbl where userid='$sess_id'and expired_date<'$currentdate'";exit;
  $select_pay=mysqli_query($con,"select * from payment_tbl where userid='$sess_id' and paystatus='1'");
  $select_fet=mysqli_fetch_array($select_pay);
  $mem=$select_fet['membershiptype'];
  $expired_date=$select_fet['expired_date'];
  $num_row=mysqli_num_rows($select_pay);
  if($num_row>0)
  {
  $msg = "You are Already".$mem." in $webname";
  header("Location:trustpass_new.php?msg=1");
  }
  else
  {
  header("Location:paypal.php?pay=$pay");
  } //comented for demo 
  //header("Location:paypal.php?pay=$pay&demo"); // for demo
  }

?>
        <script type="text/javascript">

          function popUp1(URL) {
          day = new Date();
          id = day.getTime();
          eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=500,left = 150,top = 234');");
          }

          </script>
          <script>
          function shows(obj1)
          {
            
              if (document.getElementById(obj1).style.visibility == "hidden") {
                  document.getElementById(obj1).style.visibility = "visible";
                } 
              else 
              {
                  document.getElementById(obj1).style.visibility = "hidden";
                }
            
          }
          function hides(obj1)
          {
          document.getElementById(obj1).style.display = 'none';
          document.getElementById(obj1).style.display = "block";
          }


          function showbox(val)
          {
            
            if(val=="" || val=="Director/CEO/General Manager" || val=="Sales" || val=="Purchasing" || val=="Technical & Engineering" || val=="Administrative" || val=="Marketing" || val=="Owner/Entrepreneur" )
            {
              document.getElementById('showbox').innerHTML='';
            }
            else
            {
              document.getElementById('showbox').innerHTML='<input type="text" name=other><span class=content1>(Specify)</span>';
            }
          }
        </script>
        <script type="text/javascript">  

          function checking()
          { 
            
            if(document.trustpass.fname.value=="")
            {
              alert("Please Enter the FirstName");
            document.trustpass.fname.focus();
            return false;
            }
            
            if(document.trustpass.lname.value=='')
            {
            alert("Please Enter the LastName");
            document.trustpass.lname.focus();
            return false;
            }
            
            /*if(document.trustpass.manu.checked==false && document.trustpass.tradecom.checked==false && document.trustpass.buyoff.checked==false && document.trustpass.agent.checked==false && document.trustpass.wholesale.checked==false && document.trustpass.gov.checked==false && document.trustpass.assoc.checked==false && document.trustpass.bussin.checked==false && document.trustpass.other.checked==false)
            {
            alert("Please Select Atleast One Checkbox");
            return false;
            }*/
            
            if(document.trustpass.street.value=='')
            {
            alert("Please Enter the Street");
            document.trustpass.street.focus();
            return false;
            }
            
            if(document.trustpass.city.value=='')
            {
            alert("Please Enter the City");
            document.trustpass.city.focus();
            return false;
            }
            
            if(document.trustpass.state.value=='')
            {
            alert("Please Enter the State");
            document.trustpass.state.focus();
            return false;
            }
            
            if(document.trustpass.pcode.value=='')
            {
            alert("Please Enter the Zipcode");
            document.trustpass.pcode.focus();
            return false;
            }
            else if(isNaN(document.trustpass.pcode.value))
            {
            alert("Please Enter Numbers only");
            document.trustpass.pcode.focus();
            return false;
            }
            
            if(document.trustpass.pcountrycode.value=='')
            {
            alert("Please Enter the Countrycode");
            document.trustpass.pcountrycode.focus();
            return false;
            }
            else if(isNaN(document.trustpass.pcountrycode.value))
            {
            alert("Please Enter Numbers only");
            document.trustpass.pcountrycode.focus();
            return false;
            }
            if(document.trustpass.pareacode.value=='')
            {
            alert("Please Enter the Areacode");
            document.trustpass.pareacode.focus();
            return false;
            }
            else if(isNaN(document.trustpass.pareacode.value))
            {
            alert("Please Enter Numbers only");
            document.trustpass.pareacode.focus();
            return false;
            }
            if(document.trustpass.pnumber.value=='')
            {
            alert("Please Enter the PhoneNumber");
            document.trustpass.pnumber.focus();
            return false;
            }
            else if(isNaN(document.trustpass.pnumber.value))
            {
            alert("Please Enter Numbers only");
            document.trustpass.pnumber.focus();
            return false;
            }
            if(document.trustpass.agreebutton.checked==false)
            {
            alert("You need agree to Agreement of use Membership upgrade");
            return false;
            }
            return true;
            
          }

        </script>
        <?php if(isset($_REQUEST['succ'])) { ?>
        <div style="padding-left:300px; color:#009900; font-weight:bold;" > Confirmation Mail Sent To Your Email </div>
          <?php } ?>
          <div class="body-cont">
            <div class="body-cont1">
              <div class="company__container">
                <?php include("includes/side_menu.php"); ?>
                <div class="body-right">
                    <?php include("includes/menu.php"); ?>
                    <!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
                    <div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
                    <div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
                      <div   class="bordersty">
                        <div class="headinggg"><strong> <?php echo $member_details; ?></strong></div>
                        <!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
                        <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                          <form action="" method="post"  name="trustpass" id="trustpass" >
                            <tr>
                              <td colspan="3">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="1%" align="right" valign="top"></td>
                                    <td width="98%"  class="browse_center"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                        <tr>
                                          <td width="100%" height="31"  align="left" valign="middle" class="browsetext"><?php echo $trustpass_new_upgdmem;?></td>
                                          
                                        </tr>
                                    </table></td>
                                    <td width="1%" align="left" valign="top"></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" class="border_box"><table width="100%" border="0" cellpadding="3" cellspacing="2" style="border-bottom:1px solid #0075b0">
                                  <tr><td colspan="2"></td></tr>
                                    <?PHP if(isset($_REQUEST['msg']))
                                  { $m=$_REQUEST['msg'];?>
                                          <tr>
                                            <td colspan="2" align="center"><?php if($m=='1')
                                          echo "<font color='red'>You are Already Member in $webname.com</font>";?></td>
                                          </tr>
                                  <?PHP }?>
                                  
                                          <tr>
                                            <td width="32%">&nbsp;<strong><?php echo $choose_service_pack; ?>:</strong></td>
                                            <td width="68%" class="">
                                    <?php if(isset($_REQUEST['stat'])) { 
                                        $change_status=$_REQUEST['stat'];
                                      
                                      if($change_status == "GoldSupplier") {
                                      ?>
                                      
                                      <span class="">
                                      <input name="pay" id="months12" value="1" checked="checked" type="radio" />
                                                </span><span>
                                                <label for="months12"><span style="font-size:12px"><?php echo $gole_member; ?> &nbsp; (<?PHP echo $produ." "."YEARS". ","."$".$gold_amount;?>)</span></label>
                                                </span>
                                    <?php } else if($change_status == "SilverSupplier") { ?>
                                        
                                      <span class=""> 
                                                <input name="pay" id="months24" checked="checked" value="2" type="radio" />
                                                </span><span>
                                                <label for="months24"><span style="font-size:12px"><?php echo $silver_member; ?> &nbsp;(<?PHP echo $sillver_year." "."YEARS". ","."$".$silver_amount;?>)</span><br />
                                                </label>
                                      
                                  <?php } else if($change_status == "bronzeSupplier") { ?>
                                        <label>
                                                <input name="pay" checked="checked" type="radio" value="3" />
                                                </label>
                                                </span><span style="font-size:12px">
                                        <?php echo $bronze_member; ?> &nbsp;(<?PHP echo $bronze_year." "."YEARS". ","."$".$bronze_amount;?>)
                                      </span>
                                      
                                    <?php } 
                                    } else {
                                  ?>
                                        <span class="">
                                      <input name="pay" id="months12" value="1" checked="checked" type="radio" />
                                                </span><span>
                                                <label for="months12"><span style="font-size:12px"><?php echo $gold_member; ?> &nbsp; (<?PHP echo $produ." "."YEARS". ","."$".$gold_amount;?>)</span></label>
                                                </span>
                                      
                                      <span class="">                      <br />
                                                <input name="pay" id="months24" value="2" type="radio" />
                                                </span><span>
                                                <label for="months24"><span style="font-size:12px"><?php echo $silver_member; ?> &nbsp;(<?PHP echo $sillver_year." "."YEARS". ","."$".$silver_amount;?>)</span><br />
                                                </label>
                                                
                                      <label>
                                                <input name="pay" type="radio" value="3" />
                                                </label>
                                                </span><span style="font-size:12px">
                                        <?php echo $bronze_member; ?> &nbsp;(<?PHP echo $bronze_year." "."YEARS". ","."$".$bronze_amount;?>)
                                      </span>
                                    <?php } ?>
                                    </td>
                                          </tr>
                                          <tr>
                                            <td colspan="2" class=""><?php echo $trust_content; ?></td>
                                          </tr>
                                          <tr>
                                            <td rowspan="2"><span style="color:#FF0000">*</span> <strong><?php echo $name; ?></strong></td>
                                            <td class=""><div><div style="float:left;"><?php echo $fname; ?><br />
                                                <input name="fname" type="text" id="fname" value="<?PHP echo $fet['firstname'];?>"/></div>
                                      <div style="float:right"><?php echo $lname; ?><br />
                                                <input type="text" name="lname" value="<?PHP echo $fet['lastname'];?>"/></div></div></td>
                                      
                                          </tr>
                                          <tr>
                                            <!--<td class=""><?php echo $lname; ?><br />
                                                <input type="text" name="lname" value="<?PHP echo $fet['lastname'];?>"/></td>-->
                                          </tr>
                                          <tr>
                                            <td><span style="color:#FF0000">*</span> <strong><?php echo $Sex; ?></strong><strong><span class="style1"> : </span></strong></td>
                                            <td class="">
                                              <input name="sex" type="radio" value="Male" <?PHP if($fet['gender']=='Male'){?> checked="checked" <?PHP }?> />
                              <?php echo $male; ?>
                              <input name="sex" type="radio" value="Female" <?PHP if($fet['gender']=='Female'){?> checked="checked" <?PHP }?> />
                              <?php echo female; ?></td>
                            </tr>
                              <tr>
                                <td><span style="color:#FF0000">*</span><strong><?php echo $busi_mail; ?>:</strong></td>
                                <td class=""><span style="font-size:12px"><?PHP echo $fet['email'];?></span></td>
                              </tr>
                              <!--<tr>
                                <td>&nbsp;<span style="font-size:12px"><strong>< ?php echo $trustpass_new_depp;?></strong></span></td>
                                <td class="inTxtHead"><select name="dept"  onchange="javascript:showbox(this.value);">
                                  <option value="">< ?php echo $trustpass_new_seldep;?></option>
                                  < ?php
                                  $sel_dept=mysqli_query($con,"select * from department");
                                  while($dep_res=mysqli_fetch_array($sel_dept))
                                  {

                                  ?>
                                  <option value="< ?PHP echo $dep_res['department_name'];?>" >< ?PHP echo $dep_res['department_name'];?></option>
                                  < ?PHP }?>
                                  </select>&nbsp;<div id="showbox" align="left"></div></td>
                              </tr>-->
                              <!--<tr>
                                <td>Job Title:</td>
                                <td>< ?PHP //echo $fet['jobtitle'];?></td>
                              </tr>-->
                              <tr>
                                <td><span style="color:#FF0000">*</span> <strong><?php echo $company_name; ?>:</strong></td>
                                <td class=""><span style="font-size:12px"><?PHP echo $fet['companyname'];?></span></td>
                              </tr>
                              <?php
                                $select_sell=mysqli_query($con,"select * from tbl_seller where user_id='$sess_id'");
                                    $fetch=mysqli_fetch_array($select_sell);
                                $seller_businesstype=$fetch['seller_businesstype'];?>
                              <!--<tr>
                                <td class="required" style="padding-top:90px;" valign="top"><span class="redbold">* </span>Business Type:</td>
                                <td><span class="inTxtNormal">
                                  <input name="manu" value="Manufacturer"  type="checkbox" />
                                  Manufacturer<br />
                                  <input name="tradecom" value="Trading Company"  type="checkbox" />
                                  Trading Company<br />
                                  <input name="buyoff" value="Buying Office"  type="checkbox" />
                                  Buying Office<br />
                                  <input name="agent" value="Agent"  type="checkbox" />
                                  Agent<br />
                                  <input name="wholesale" value="Distributor/Wholesaler"  type="checkbox" />
                                  Distributor/Wholesaler<br />
                                  <input name="gov" value="Government ministry/Bureau/Commission"  type="checkbox" />
                                  Government ministry/Bureau/Commission<br />
                                  <input name="assoc" value="Association"  type="checkbox" />
                                  Association<br />
                                  <input name="bussin" value="Business Service (Transportation, finance, travel, Ads, etc)"  type="checkbox" />
                                  Business Service (Transportation, finance, travel, Ads, etc)<br />
                                  <input name="other" value="Other"  type="checkbox"  onclick="javascript:shows('once');" />
                                  Other &nbsp;</span>
                                  <div id="once" style="visibility:hidden">
                                          <input type="text" name="others" value="" />
                                        </div></td>
                              </tr>-->
                              <tr>
                                <td><span style="color:#FF0000">*</span><strong><?php echo $contact_address; ?></strong></td>
                                <td>
                                  <table width="100%" border="0">
                                    <tr>
                                      <td width="31%" class=""><?php echo $street_address; ?>:</td>
                                      <td width="69%"><input name="street" type="text" value="<?PHP echo $fet['street']; ?>" maxlength="50"   /></td>
                                    </tr>
                                    <tr>
                                      <td class=""><?php echo $city; ?>:</td>
                                      <td><input name="city" type="text" value="<?PHP echo $fet['city'];?>" maxlength="25" /></td>
                                    </tr>
                                    <tr>
                                      <td class=""><?php echo $province_state; ?>:</td>
                                      <td><input name="state" type="text" value="<?PHP echo $fet['state'];?>" maxlength="25"  /></td>
                                    </tr>
                                    <?PHP //echo "select * from country where country_id='$fet[country]'";
                                      $selectcountry=mysqli_query($con,"select * from country where country_id='$fet[country]'");
                                          $rowcountry=mysqli_fetch_array($selectcountry);
                                    ?>
                                    <tr>
                                      <td class=""><?php echo $country; ?>:</td>
                                      <td class=""><span style="font-size:12px"><?PHP echo $rowcountry['country_name'];?></span></td>
                                    </tr>
                                    <tr>
                                      <td class=""><?php echo $zip_postal; ?>:</td>
                                      <td><input type="text" name="pcode" value="<?PHP echo $fet['zipcode'];?>" /></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td><span style="color:#FF0000">*</span><strong><?php echo $phone_number; ?>:</strong></td>
                                <td>
                                  <table width="56%" border="0">
                                    <tr>
                                      <td width="36%" class=""><?php echo $country_code; ?></td>
                                      <td width="24%" class=""><?php echo $area_code; ?></td>
                                      <td width="40%" class=""><?php echo $number ?>:</td>
                                    </tr>
                                    <tr>
                                      <td><input name="pcountrycode"  maxlength="8" size="4" value="<?PHP echo $fet['country'];?>" type="text" /></td>
                                      <td><input name="pareacode"  maxlength="8"  size="4" value="<?PHP echo $fet['areacode'];?>" type="text" /></td>
                                      <td><input name="pnumber"  maxlength="34" size="14" value="<?PHP echo $fet['phonenumber'];?>" type="text" /></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;<strong><?php echo $fax_number; ?>:</strong></td>
                                <td>
                                  <table width="56%" border="0">
                                      <tr>
                                        <td width="35%" class=""><?php echo $country_code; ?></td>
                                        <td width="26%" class=""><?php echo $area_code; ?></td>
                                        <td width="39%" class=""><?php echo $number; ?><span class="style1"> : </span></td>
                                      </tr>
                                      <tr>
                                        <td><input name="countrycode"  maxlength="8" size="4" value="<?PHP echo $fet['countrycode']; ?>" type="text" /></td>
                                        <td><input name="areacode"  maxlength="8"  size="4" value="<?PHP echo $fet['areacode']; ?>" type="text" /></td>
                                        <td><input name="number"  maxlength="34" size="14" value="<?PHP echo $fet['faxnumber'];?>" type="text" /></td>
                                      </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input value="agree" name="agreebutton" id="agree" type="checkbox" />
                                    I agree to&nbsp;<a href="terms.php" target="_blank"><?php echo $membership_agreemant; ?></a><a href="terms.php" target="_blank" class="topics2"></a>
                                  <div id="error_info" style="display: none;"><?php echo $trustpass_new_syer;?></div></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center"><label>
                                <input name="Submit" class="search_bg" type="submit" onclick="return checking();" value="<?php echo $submit; ?>" />
                                </label></td>
                              </tr>			
                            </table>
                          </td>
                        </tr>
			                </form>
                    </table>
                  <div>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <!-- <div class="body-cont4"> 

        </div> -->
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
