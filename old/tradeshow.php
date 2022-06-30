<?php 
include("includes/header.php");
 include("easythumbnail.class.php");
if($session_user=="")
{

header("location:login.php");

}

$sess_id=$_SESSION['user_login'];

  $check_list=$_REQUEST['check_list']; 
  $userid=$_SESSION['user_login'];
  if(isset($_REQUEST['tradesub']))
  {
  $emailid=$_POST['emailid'];
  $notification=$_POST['notification'];

   $l=count($_SESSION);
		 for($h=1;$h<=$l;$h++)
		 {
		// echo "<br>";
		  $var=$_SESSION['sendid'.$h];
		// echo "<br>";
		 if($var!='')
		 {		//echo "select * from tbl_tradeshow where show_id=$var";

		  $querycount=mysqli_query($con,"select * from tbl_tradeshow where show_id=$var");
		  $fetquery=mysqli_fetch_array($querycount);
		  //print_r($fetquery);
		 echo   $fromdate=$fetquery['events_fromdate'];
		 $g= trim($fromdate);
		// echo "<br>";
         echo "ddd".date("m-d-Y",$g);
		 //echo "<br>";
		   $businesstype = split(",",$fromdate);
		
			
						echo $v=$businesstype[0];
						echo "<br>";
						echo $y=$businesstype[1];
						echo "<br>";
						$d=explode(" ",$v);
						echo $c=$d[0];
						echo "<br>";
						echo $c1=$d[1];
						echo "<br>";
						
						
						if($c=='January')
						{
						$m=01;
						}
						else if($c=='February')
						{
						$m=02;
						}
						else if($c=='March')
						{
						$m=03;
						}
						else if($c=='April')
						{
						$m=04;
						}
						else if($c=='May')
						{
						$m=05;
						}
						else if($c=='June')
						{
						$m=06;
						}
						else if($c=='July')
						{
						$m=07;
						}
						else if($c=='August')
						{
						$m=08;
						}else if($c=='September')
						{
						$m=09;
						}
						else if($c=='October')
						{
						$m=10;
						}
						else if($c=='November')
						{
						$m=11;
						}
						else if($c=='December')
						{
						$m=12;
						}
						
					$t=3;
					$b =5;	
				    $mk=mktime(0, 0, 0, $m, $c1-$b, $y);
					echo "<br>";
				     echo date("F-d-Y",$mk);
					 echo "<br>";
						//$businesstype[2];
						  
						  $dformat=date('F j, Y'); 
			
						 
						// $exe1=strtotime($fromdate);
						 
						 //echo mktime(0,0,0,$businesstype[0],$businesstype[1],$businesstype[2]);
						 
						 //$startDate = mktime (0,0,0,date("F"),date("j",$businesstype),date("Y"));
		 		 
   /* $exe1=strtotime($fromdate);
							
						$startDate = mktime(0,0,0,date("m",$exe1),date("d",$exe1),date("Y",$exe1));
                        $finishDate = $startDate + ($notification * 60 * 60); 
                        
						 echo $res=date('F j, Y',$finishDate); */
  
  /*  echo "<br>";
  echo $ress = date('F j, Y', strtotime('$notification days'));
  echo "<br>";*/
  }
  }
  }
 ?>



<script language="javascript" type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
	{
		
		return;
	}
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
	{
		objCheckBoxes.checked = CheckValue;
		
	}
	else
	{
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
		{
			objCheckBoxes[i].checked = CheckValue;
		}
	}
}

function checkbox1() {
     
	var lengthcount=document.editrade.maxvalue.value;
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++)
	{
	 var checkbox = "checkbox["+i+"]";
	 var dom = document.getElementById(checkbox);
		if(dom.checked==true)
		{
			checkedcount++;
		}
	}
	if(checkedcount < 1)
	    {
			alert("Select Atleast One Checkbox");
			return false;
		}
	if( confirm('Are you sure you want to Delete this Record?') )
						{
						return true;
						}
						else
						{	
						return false; 
						}
}
function compare(){
  	if(document.editrade.maxvalue.value=="")
	{
	alert('Select Atleast One Checkbox');
	return false;
	}
	else
	{
	if( confirm('Are you sure you want to Delete this Record?') )
						{
						return true;
						}
						else
						{	
						return false; 
						}
	}
	//var result=checkbox1();
	//if(result == false)
	//{
	//	return false;
	//}
	//else
	//{
		// document.inbox.submit();
	//}
}

</script>
<script language="javascript" type="text/javascript">
function show(value)
{
if(value=="productcate")
		{
			//alert("hai");
			document.getElementById("productcate").style.display='block';
		}
		else
		{
		 document.getElementById("productcate").style.display='none';
		} 	
}


function show1(value)
{
if(value=="regioncate")
		{
			document.getElementById("regioncate").style.display='block';
		}
		else
		{
		 document.getElementById("productcate").style.display='none';
		} 	
}
function popUp(URL) 
{
  window.open(URL, '','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100');
}



</script>
<style type="text/css">
.redbold
{
color:#FF0000;


}
</style>
<script language="javascript">
function tradeshowval()
{
if(document.frm_tradeshow.showname.value=="")
{
alert("Please Enter Your Show Name");
document.frm_tradeshow.showname.focus();
return false;
}

if(document.frm_tradeshow.from_year.value=="")
{
alert("Please Select The From Year");
document.frm_tradeshow.from_year.focus();
return false;
}

if(document.frm_tradeshow.from_month.value=="")
{
alert("Please Enter The From Month");
document.frm_tradeshow.from_month.focus();
return false;
}
if(document.frm_tradeshow.from_day.value=="")
{
alert("Please Enter The From Date");
document.frm_tradeshow.from_day.focus();
return false;
}

if(document.frm_tradeshow.to_year.value=="")
{
alert("Please Select The To Year");
document.frm_tradeshow.to_year.focus();
return false;
}

if(document.frm_tradeshow.to_month.value=="")
{
alert("Please Enter The To Month");
document.frm_tradeshow.to_month.focus();
return false;
}
if(document.frm_tradeshow.to_day.value=="")
{
alert("Please Enter The To Date");
document.frm_tradeshow.to_day.focus();
return false;
}
if(document.frm_tradeshow.fromtime.value=="")
{
alert("Please Enter The Start Time");
document.frm_tradeshow.fromtime.focus();
return false;
}
if(document.frm_tradeshow.totime.value=="")
{
alert("Please Enter The End Time");
document.frm_tradeshow.totime.focus();
return false;
}

if(document.frm_tradeshow.venue.value=="")
{
alert("Please Enter The Venue");
document.frm_tradeshow.venue.focus();
return false;
}
if(document.frm_tradeshow.address.value=="")
{
alert("Please Enter The Address");
document.frm_tradeshow.address.focus();
return false;
}
if(document.frm_tradeshow.country.value=="")
{
alert("Please Select The Country");
document.frm_tradeshow.country.focus();
return false;
}

var fnam=document.frm_tradeshow.uploadedfile.value;
if(document.frm_tradeshow.uploadedfile.value=="")
{
alert("Please Upload Your Event Image");
document.frm_tradeshow.uploadedfile.focus();
return false;
}

splt=fnam.split('.');
chksplt=splt[1].toLowerCase();

if(chksplt=='jpg'|| chksplt=='jpeg'){

}else{
alert(" Upload only jpg, jpeg image");
document.frm_tradeshow.uploadedfile.focus();
return false;
}

if(document.frm_tradeshow.exhibitors_no.value=="")
{
alert("Please Enter Your Number Of Exhibitors");
document.frm_tradeshow.exhibitors_no.focus();
return false;
}

if(isNaN(document.frm_tradeshow.exhibitors_no.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.exhibitors_no.focus();
		return false;
 }

if(document.frm_tradeshow.exhibitors_year.value=="")
{
alert("Please Select The Exhibitors Year");
document.frm_tradeshow.exhibitors_year.focus();
return false;
}

if(document.frm_tradeshow.attendees_no.value=="")
{
alert("Please Enter Your Number Of Attendees");
document.frm_tradeshow.attendees_no.focus();
return false;
}
if(isNaN(document.frm_tradeshow.attendees_no.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.attendees_no.focus();
		return false;
 }
if(document.frm_tradeshow.attendees_year.value=="")
{
alert("Please Enter Your Attended Year");
document.frm_tradeshow.attendees_year.focus();
return false;
}
if(document.frm_tradeshow.exhibition_no.value=="")
{
 alert("Please Enter The Exhibition Floor Size");
 document.frm_tradeshow.exhibition_no.focus();
 return false;
} 

if(isNaN(document.frm_tradeshow.exhibition_no.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.exhibition_no.focus();
		return false;
 }

if(document.frm_tradeshow.exhibition_year.value=="")
{
 alert("Please Select The Year Of Exhibiton");
 document.frm_tradeshow.exhibition_year.focus();
 return false;
} 
if(document.frm_tradeshow.phone.value=="")
{
 alert("Please Enter Your Phone Number");
 document.frm_tradeshow.phone.focus();
 return false;
} 
if(isNaN(document.frm_tradeshow.phone.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.phone.focus();
		return false;
 }
 if(document.frm_tradeshow.fax.value=="")
{
alert("Please Enter The Fax Number");
document.frm_tradeshow.fax.focus();
return false;
}

if(isNaN(document.frm_tradeshow.fax.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.fax.focus();
		return false;
 }
if(document.frm_tradeshow.summary.value=="")
{
alert("Please Enter The Summary");
document.frm_tradeshow.summary.focus();
return false;
}

if(document.frm_tradeshow.generalinformation.value=="")
{
alert("Please Enter The General Information");
document.frm_tradeshow.generalinformation.focus();
return false;
}
if(document.frm_tradeshow.industry.value=="")
{
alert("Please Select Your Industry");
document.frm_tradeshow.industry.focus();
return false;
}
if(document.frm_tradeshow.products.value=="")
{
 alert("Please Enter Product and Services");
 document.frm_tradeshow.products.focus();
 return false;
}
if(document.frm_tradeshow.attendee_information.value=="")
{
 alert("Please Enter Attendee Information");
 document.frm_tradeshow.attendee_information.focus();
 return false;
} 

if(document.frm_tradeshow.exhibitor_information.value=="")
{
 alert("Please Enter Exhibitor Information");
 document.frm_tradeshow.exhibitor_information.focus();
 return false;
} 
 if(document.frm_tradeshow.show_organizer.value=="")
 {
  alert("Please Enter The Show Organizer Name");
  document.frm_tradeshow.show_organizer.focus();
  return false;
 }
 
 var noalpha = /^[a-zA-Z ]*$/;
 if (!noalpha.test(document.frm_tradeshow.show_organizer.value)) {
     alert("Special Characters Are Not Allowed In Show Organizer Name.");
	 document.frm_tradeshow.show_organizer.value="";
	 document.frm_tradeshow.show_organizer.focus();
     return false;
	}
 if(document.frm_tradeshow.contact_person.value=="")
 {
  alert("Please Enter The Contact Person Name");
  document.frm_tradeshow.contact_person.focus();
  return false;
 }
 if (!noalpha.test(document.frm_tradeshow.contact_person.value)) {
     alert("Special Characters Are Not Allowed In Contact Person Name.");
	 document.frm_tradeshow.contact_person.value="";
	 document.frm_tradeshow.contact_person.focus();
     return false;
	}
   if(document.frm_tradeshow.jobtitle.value=="")
 {
  alert("Please Select The Jobtitle");
  document.frm_tradeshow.jobtitle.focus();
  return false;
 }
   if(document.frm_tradeshow.business_email.value=="")
 {
  alert("Please Enter The Business Email");
  document.frm_tradeshow.business_email.focus();
  return false;
 }
 
  if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.frm_tradeshow.business_email.value)))
	{       
        	document.frm_tradeshow.business_email.value="";
			document.frm_tradeshow.business_email.focus(); 
			return false;
	}
   if(document.frm_tradeshow.businessphone.value=="")
 {
  alert("Please Enter The Business Phone No");
  document.frm_tradeshow.businessphone.focus();
  return false;
 }
 if(isNaN(document.frm_tradeshow.businessphone.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.businessphone.focus();
		return false;
 }
  if(document.frm_tradeshow.faxnumber.value=="")
 {
  alert("Please Enter The Fax Number");
  document.frm_tradeshow.faxnumber.focus();
  return false;
 }
 
 if(isNaN(document.frm_tradeshow.faxnumber.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.faxnumber.focus();
		return false;
 }
 
   if(document.frm_tradeshow.businessaddress.value=="")
 {
  alert("Please Enter The Business Address");
  document.frm_tradeshow.businessaddress.focus();
  return false;
 }
if(document.frm_tradeshow.country2.value=="")
{
 alert("Please Select The Country Or Territory");
 document.frm_tradeshow.country2.focus();
 return false;
} 
 

}

function echeck(str) 
{

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}
		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }
		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
 		 return true
				
}

function change_time(str)
{
	if(str == 'from')
	{
		//alert('from');
		if(document.getElementById('from_am').style.display == "block")
		{
			//alert('from pm none');
			document.getElementById('from_am').style.display = "none";
			document.getElementById('from_pm').style.display = "block";
			document.getElementById('from_am_pm').value = "PM";
		}
		else if(document.getElementById('from_pm').style.display == "block")
		{
			//alert('from pm block');
			document.getElementById('from_am').style.display = "block";
			document.getElementById('from_pm').style.display = "none";
			document.getElementById('from_am_pm').value = "AM";
		}
	}
	else if(str == 'to')
	{
		//alert('to');
		if(document.getElementById('to_am').style.display == "block")
		{
			//alert('from pm none');
			document.getElementById('to_am').style.display = "none";
			document.getElementById('to_pm').style.display = "block";
			document.getElementById('to_am_pm').value = "PM";
		}
		else if(document.getElementById('to_pm').style.display == "block")
		{
			//alert('from pm block');
			document.getElementById('to_am').style.display = "block";
			document.getElementById('to_pm').style.display = "none";
			document.getElementById('to_am_pm').value = "AM";
		}
	}
}
</script>


<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div class="headinggg"> <?php echo $my_trade_alert; ?></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box" >
                        <tr>
                          <td valign="top"><form action="trade_action.php" method="post" enctype="multipart/form-data" name="frm_tradeshow" id="frm_tradeshow" onsubmit="return tradeshowval();">
                            <table width="99%"  cellspacing="0" cellpadding="0">
                              <tr>
                                <td class=""><table width="95%" height="133" cellpadding="3" cellspacing="0" >
                                  
                                    <tr>
                                      <td ><!-- Table Begins-->
                                          <table width="105%" border="0" cellpadding="3" cellspacing="0">
                                            <tr>
                                              <td align="left" class="cent_bold" colspan="4"><strong style="color:#1E5477; font-size:16px;"><?php echo $fast_facts; ?></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="3%">&nbsp;</td>
                                              <td width="37%" align="left" class="seller"><font class="redbold">*</font><strong><?php echo $off_show_name; ?></strong></td>
                                              <td width="8%"><div align="center">:</div></td>
                                              <td width="52%"><div align="left">
                                                  <input name="showname" type="text" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $event_date; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <table width="100%" border="0">
                                                    <tr>
                                                      <td width="7%" class="text"><?php echo $from; ?>                                                        </th>                                                      </td>
                                                      <td width="13%"><select name="from_year">
                                                          <option value=""><?php echo $year; ?></option>
                                                          <?php 
															for($i=date("Y")-1;$i<=date("Y")+3;$i++)
															{?>
                                                          <option><?php echo $i;?>
                                                          <?php }?>
                                                         
                                                          </option>
                                                      </select>
                                                      </td>
                                                      <td width="19%"><select name="from_month">
                                                          <option value=""><?php echo $month; ?></option>
                                                          <option value="01" >January</option>
                                                          <option value="02" >February</option>
                                                          <option value="03" >March</option>
                                                          <option value="04" >Apirl</option>
                                                          <option value="05" >May</option>
                                                          <option value="06" >June</option>
                                                          <option value="07" >July</option>
                                                          <option value="08" >August</option>
                                                          <option value="09" >September</option>
                                                          <option value="10" >October</option>
                                                          <option value="11" >November</option>
                                                          <option value="12" >December</option>
                                                        </select>
                                                      </td>
                                                      <td width="61%"><select name="from_day">
                                                          <option value=""><?php echo $day; ?></option>
                                                          <?php for($i=01;$i<=31;$i++)
															{?>
                                                          <option><?php echo $i;?>
                                                          <?php }?>
                                                       
                                                          </option>
                                                      </select></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="7%" class="text">--<?php echo to; ?>--</td>
                                                      <td width="13%"><select name="to_year">
                                                          <option value=""><?php echo $year; ?></option>
                                                          <?php 
															for($i=date("Y")-1;$i<=date("Y")+3;$i++)
															{?>
                                                          <option><?php echo $i;?>
                                                          <?php }?>
                                                        
                                                          </option>
                                                      </select>
                                                      </td>
                                                      <td width="19%"><select name="to_month">
                                                         <option value=""><?php echo $month; ?></option>
                                                          <option value="01" >January</option>
                                                          <option value="02" >February</option>
                                                          <option value="03" >March</option>
                                                          <option value="04" >Apirl</option>
                                                          <option value="05" >May</option>
                                                          <option value="06" >June</option>
                                                          <option value="07" >July</option>
                                                          <option value="08" >August</option>
                                                          <option value="09" >September</option>
                                                          <option value="10" >October</option>
                                                          <option value="11" >November</option>
                                                          <option value="12" >December</option>
                                                        </select>
                                                      </td>
                                                      <td width="61%"><select name="to_day">
                                                          <option value=""><?php echo $day; ?></option>
                                                          <?php for($i=01;$i<=31;$i++)
															{?>
                                                          <option><?php echo $i;?>
                                                          <?php }?>
                                                          <!--<option value="01" >01</option>
		                                                      
	                                                        <option value="02" >02</option>
	                                                        <option value="03" >03</option>
	                                                        <option value="04" >04</option>
	                                                        <option value="05" >05</option>
	                                                        <option value="06" >06</option>
	                                                        <option value="07" >07</option>
		                                                      
	                                                        <option value="08" >08</option>
	                                                        <option value="09" >09</option>
	                                                        <option value="10" >10</option>
	                                                        <option value="11" >11</option>
	                                                        <option value="12" >12</option>
	                                                        <option value="13" >13</option>
		                                                      
	                                                        <option value="14" >14</option>
	                                                        <option value="15" >15</option>
	                                                        <option value="16" >16</option>
	                                                        <option value="17" >17</option>
	                                                        <option value="18" >18</option>
	                                                        <option value="19" >19</option>
		                                                      
	                                                        <option value="20" >20</option>
	                                                        <option value="21" >21</option>
	                                                        <option value="22" >22</option>
	                                                        <option value="23" >23</option>
	                                                        <option value="24" >24</option>
	                                                        <option value="25" >25</option>
		                                                      
	                                                        <option value="26" >26</option>
	                                                        <option value="27" >27</option>
	                                                        <option value="28" >28</option>
	                                                        <option value="29" >29</option>
	                                                        <option value="30" >30</option>
	                                                        <option value="31" >31</option>-->
                                                          </option>
                                                      </select>
                                                      </td>
                                                    </tr>
                                                  </table>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $hours; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td class="text"><div align="left">
											  	<div style="float:left;">
                                                  <select name="fromtime">
                                                    <option value=""><?php echo $sel; ?></option>
                                                    <option value="01:00" >1:00</option>
                                                    <option value="02:00" >2:00</option>
                                                    <option value="03:00" >3:00</option>
                                                    <option value="04:00" >4:00</option>
                                                    <option value="05:00" >5:00</option>
                                                    <option value="06:00" >6:00</option>
                                                    <option value="07:00" >7:00</option>
                                                    <option value="08:00" >8:00</option>
                                                    <option value="09:00" >9:00</option>
                                                    <option value="10:00" >10:00</option>
                                                    <option value="11:00" >11:00</option>
                                                    <option value="12:00" >12:00</option>
                                                  </select>
                                                  <?php //echo $tradeshows_am;?>
											    </div>
												  <a href="javascript:void(0)" onclick="change_time('from')" title="Click to change AM or PM" class="news">
												  	<div id="from_am" style="display:block; float:left;">&nbsp; AM &nbsp;</div>
													<div id="from_pm" style="display:none; float:left;">&nbsp; PM &nbsp;</div>
												  </a>
												  <input type="hidden" name="from_am_pm" id="from_am_pm" value="AM" />
                                                  <!--</div>
						                          
								                        <div align="left">-->
												  
												  <div style="float:left;"><strong>--<?php echo $to; ?>-- </strong>&nbsp;
                                                  <select name="totime">
                                                    <option value=""><?php echo $sel; ?></option>
                                                    
                                                    <option value="01:00" >1:00</option>
                                                    <option value="02:00" >2:00</option>
                                                    <option value="03:00" >3:00</option>
                                                    <option value="04:00" >4:00</option>
                                                    <option value="05:00" >5:00</option>
                                                    <option value="06:00" >6:00</option>
                                                    <option value="07:00" >7:00</option>
                                                    <option value="08:00" >8:00</option>
                                                    <option value="09:00" >9:00</option>
                                                    <option value="10:00" >10:00</option>
                                                    <option value="11:00" >11:00</option>
                                                    <option value="12:00" >12:00</option>
                                                  </select>
											    </div>
												 <a href="javascript:void(0)" onclick="change_time('to')" title="Click to change AM or PM" class="news">
												  	<div id="to_am" style="display:block; float:left;">&nbsp; AM &nbsp;</div>
													<div id="to_pm" style="display:none; float:left;">&nbsp; PM &nbsp;</div>
											    </a>
												  <input type="hidden" name="to_am_pm" id="to_am_pm" value="AM" />
                                                <?php //echo $tradeshows_pm;?> </div>
                                                  <!--<label for="toam"></label> <label for="topm">
								                        <div align="left">/div>
						                        </label> -->
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $venue; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="venue" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $address; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="address" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $location; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <select name="country" class="text">
                                                    <option value=""><?php echo $tradeshows_selcoun;?></option>
                                                    <?php
								  $res1= "select * from country";
								  $sql=mysqli_query($con,$res1);
								  
								  while($result1=mysqli_fetch_array($sql)) 
								  {
								   ?>
                                                    <option value="<?php echo $result1['country_name']; ?>"><?php echo $result1['country_name'];?></option>
                                                    <?php
								  }	
									?>
                                                  </select>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $logo; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="file" name="uploadedfile" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" valign="top" class="seller"><font class="redbold">*</font><strong><?php echo $event_scale_info; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <table width="100%" border="0">
                                                    <tr>
                                                      <td width="35%" class="text"> <?php echo $no_of_ex; ?>                                                        </th>                                                      </td>
                                                      <td width="24%"><input type="text" name="exhibitors_no" size="10" /></td>
                                                      <!-- <td width="14%" class="sellertext">History record:</td>
                                <td width="25%"><input type="text" name="exhibitors_history" /></td>-->
                                                      <td width="14%" class="text"><?php echo $year_of; ?> </td>
                                                      <td width="27%"><!--<select name="exhibitors_year">
                                                          <option value=""><?php echo $tradeshows_sel;?></option>
                                                         <?php 
														 $yr=date("Y");
														 for($yrnew=$yr-10;$yrnew <=$yr;$yrnew++) { ?>
														  <option value="<?php echo $yrnew;?>" ><?php echo $yrnew;?></option>
                                                         <?php } ?>
                                                        </select>-->
														<select name="exhibitors_year">
                                                          <option value=""><?php echo $sel; ?></option>
                                                          <?php 
															for($i=date("Y")-5;$i<=date("Y")+3;$i++)
															{?>
                                                          <option><?php echo $i;?>
                                                          <?php }?>
                                                         
                                                          </option>
                                                      </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td class="text"><?php echo $no_of_atten; ?>
</th>                                                      </td>
                                                      <td><input type="text" name="attendees_no" size="10" /></td>
                                                      <!--<td class="sellertext">History record:</td>
                                <td><input type="text" name="attendees_history" /></td>-->
                                                      <td class="text"><?php echo $year_of; ?></td>
                                                      <td>
													  <!--<select name="attendees_year" size="1">
                                                          <option value=""><?php echo $tradeshows_sel;?></option>
                                                           <?php 
														 $yr=date("Y");
														 for($yrnew=$yr-10;$yrnew <=$yr;$yrnew++) { ?>
														  <option value="<?php echo $yrnew;?>" ><?php echo $yrnew;?></option>
                                                         <?php } ?>
                                                        </select>-->
														<select name="attendees_year">
                                                          <option value=""><?php echo $sel; ?></option>
                                                          <?php 
															for($i=date("Y")-5;$i<=date("Y")+3;$i++)
															{?>
                                                          <option><?php echo $i;?>
                                                          <?php }?>
                                                         
                                                          </option>
                                                      </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td class="text"><?php echo $ex_floor_size; ?>
</th>                                                      </td>
                                                      <td><input type="text" name="exhibition_no" size="10" value=""/></td>
                                                      <!--<td class="sellertext">History record:</td>
                                <td><input type="text" name="exhibition_history" /></td>-->
                                                      <td class="text"><?php echo $year_of; ?></td>
                                                      <td>
													    <!--<select name="exhibition_year">
                                                          <option value=""><?php echo $tradeshows_sel;?></option>
                                                          <option value="1999">1999</option>
                                                          <option value="2000">2000</option>
                                                          <option value="2001">2001</option>
                                                          <option value="2002">2002</option>
                                                          <option value="2003">2003</option>
                                                          <option value="2004">2004</option>
                                                          <option value="2005">2005</option>
                                                          <option value="2006">2006</option>
                                                          <option value="2007">2007</option>
                                                          <option value="2008">2008</option>
                                                        </select>-->
														<select name="exhibition_year">
                                                          <option value=""><?php echo $sel; ?></option>
                                                          <?php 
															for($i=date("Y")-5;$i<=date("Y")+3;$i++)
															{?>
                                                          <option><?php echo $i;?>
                                                          <?php }?>
                                                         
                                                          </option>
                                                      </select>
                                                      </td>
                                                    </tr>
                                                  </table>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $phone; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="phone" value=""/>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $fax; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="fax" value=""/>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="cent_bold" colspan="4"><strong style="color:#1E5477; font-size:16px;"><?php echo $show_info; ?></strong></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $summary; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <textarea name="summary" cols="40" rows="4"></textarea>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $general_info; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <textarea name="generalinformation" cols="40" rows="4"></textarea>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $industry_focus; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <select name="industry" class="text">
                                                    <option value=""><?php echo $sel; ?></option>
                                                    <?php
								  $res2= "select * from category where parent_id=''";
								  $sql2=mysqli_query($con,$res2);
								  
								  while($result2=mysqli_fetch_array($sql2)) 
								  {
								   ?>
                                                    <option value="<?php echo $result2['category']; ?>"><?php echo $result2['category'];?></option>
                                                    <?php
								  }	
									?>
                                                  </select>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $pro_ser_focus; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="products" value="" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $attenace_info; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="attendee_information" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $exhibitor_info; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="exhibitor_information" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="cent_bold" colspan="4" ><strong style="color:#1E5477; font-size:16px;"><?php echo $show_organizer_info; ?></strong></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $show_org; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="show_organizer" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $contact_person; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="contact_person" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $job_title; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <select name="jobtitle">
                                                    <option value=""><?php echo $sel_job_title; ?></option>
                                                    <option value="Director/CEO/General Manager"  ><?php echo $director_ceo; ?></option>
                                                    <option value="Owner/Entrepreneur"  ><?php echo $owner_enter; ?></option>
                                                    <option value="Marketing"  ><?php echo $marketing; ?></option>
                                                    <option value="Sales"  ><?php echo $sales; ?></option>
                                                    <option value="Purchasing"  ><?php echo $purchasing; ?></option>
                                                    <option value="Technical &amp; Engineering"  ><?php echo $technical_engineering; ?></option>
                                                    <option value="Administrative"  ><?php echo $atministrative; ?></option>
                                                  </select>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $busi_mail; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="business_email" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $busi_phone; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="businessphone" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $fax_number; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="faxnumber" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $busi_address; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <textarea name="businessaddress" cols="40" rows="3"></textarea>
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><strong>&nbsp;&nbsp;&nbsp;<?php echo $city; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="city" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><strong>&nbsp;&nbsp;&nbsp;<?php echo $state; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="state" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $zip_postal; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <input type="text" name="zip" />
                                              </div></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td align="left" class="seller"><font class="redbold">*</font><strong><?php echo $country_teritory; ?></strong></td>
                                              <td><div align="center">:</div></td>
                                              <td><div align="left">
                                                  <select name="country2" class="text">
                                                    <option value=""><?php echo $sel; ?></option>
                                                    <?php
								  $res4= "select * from country";
								  $sql4=mysqli_query($con,$res4);
								  
								  while($result4=mysqli_fetch_array($sql4)) 
								  {
								   ?>
                                                    <option value="<?php echo $result4['country_name']; ?>"><?php echo $result4['country_name'];?></option>
                                                    <?php
								  }	
									?>
                                                  </select>
                                              </div></td>
                                            </tr>
                                            <!-- <tr>
							<td align="right" class="seller"><font color="#FF0000">*</font> Confirm Text</td>
							<td>&nbsp;</td>
							<td><input type="text" name="textfield96" /></td>
						  </tr> 
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="sellercomments">Please type in the text you see into the field above. <br />
This prevents fraud. If you cannot see this image, <br />
<a href="" class="gboldli">click   	              here</a>.</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="sellercomments"> If the words are correct and you still cannot complete the process,   	              you may have encountered a cookie error. Please <a href="" class="gboldli">click here.</a></td>
						  </tr>-->
                                            <tr height="3">
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4" align="center"><input type="submit" class="search_bg" name="submit" value="<?php echo $submit; ?>" />
                                              </td>
                                            </tr>
                                          </table>
                                        <!-- Table Ends-->
                                      </td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table>
                          </form></td>
                        </tr>
                    </table>
<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


<div class="body-cont4"> 






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
