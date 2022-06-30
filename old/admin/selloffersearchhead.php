<script language="JavaScript1.2" src="../script/cal2.js"></script>
<script language="JavaScript1.2">
//Define calendar(s): addCalendar ("Unique Calendar Name", "Window title", "Form element's name", Form name")
addCalendar("Calendar1", "Select Date", "fromdate", "searchform");
addCalendar("Calendar2", "Select Date", "todate", "searchform");

 setWidth(90, 1, 15, 1);

setFormat("yyyy-mm-dd");

</script>
<script language="javascript">
function trimAll(sString){
	while (sString.substring(0,1) == ' '){
		sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' '){
		sString = sString.substring(0,sString.length-1);
	}
	return sString;
}

function validatesearch()
{
	var keyword=document.searchform.keyword.value;
	var fromdate=document.searchform.fromdate.value;
	var todate=document.searchform.todate.value;
	if((trimAll(keyword)=="") && (fromdate=="") && (fromdate==""))
	{
		alert("Enter Keyword or From Date and To Date");
		document.searchform.keyword.value='';
		document.searchform.keyword.focus();
		return false;
	}
}
</script>
<form name="searchform" method="post" action="selloffersearch.php" onSubmit="return validatesearch();">
						<table width="538" align="center" style="border:1px solid #000000;">
							<tr><td width="249" height="27" colspan="2" align="center" class="adminheaderlink">Search</td>
							</tr>
							<tr>
							  <td height="31" align="right" class="normal">Product Name :&nbsp;&nbsp; </td>
							  <td><input type="text" name="keyword" /><input type="hidden" name="uid" value="<?php echo $uid;?>"></td></tr>
							<!--<tr><td colspan="2" class="normal">Expire Date </td></tr>
							<tr><td height="32" class="normal">From : <input name="fromdate" type="text"  readonly="true" class="textBox1" />
							<img src="../images/cal.gif" border="0" onclick="javascript:showCal('Calendar1')" /></td>
							  <td class="normal">To : <input name="todate" type="text"  readonly="true" class="textBox1" />
							  <img src="../images/cal.gif" border="0" onclick="javascript:showCal('Calendar2')" /></td></tr>-->
							  <tr><td colspan="2" class="normal">Show : <input type="radio" name="show" value="all" checked="checked" />All <input type="radio" name="show" value="1" />Pending
							  <input type="radio" name="show" value="3" />Editing Required<input type="radio" name="show" value="2" />Approved 
							  <input type="radio" name="show" value="0" />Expired</td></tr>
							<tr><td height="34" colspan="2" align="center"><input type="submit" name="search" value="Search" /></td></tr>
					  </table>
					  </form>