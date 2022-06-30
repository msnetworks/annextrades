function showemailAvailability(str)
{
xmlHttp=GetXmlHttpObject()
		 
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		var url="emailidrepeat.php"
		url=url+"?email="+str+"&cmail="+str
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
}

function stateChanged() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
  document.getElementById("rep_email").innerHTML=xmlHttp.responseText 
// alert(xmlHttp.responseText)
 } 
} 

function GetXmlHttpObject()
{ 
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
  objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp
}

/////////////////      username   ///////////

function usernameavaliabilityun(str)
{

	xmlHttpstr=GetXmlHttpObjectstr()
		if (xmlHttpstr==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		}
		
		var url="ajax_username.php"
		url=url+"?username="+str
		
		
		
		url=url+"&sid="+Math.random()
		xmlHttpstr.onreadystatechange=stateChangedstr;
		//alert(xmlHttpstr.responseText);
		
/*		if((xmlHttpstr.responseText=="<font color='red'>User name Already Exists</font>") || (xmlHttpstr.responseText=="<font color='red'>User name Must have 5 charaters</font>"))
		{
		alert('test');	
		}*/
		
		xmlHttpstr.open("GET",url,true)
		xmlHttpstr.send(null)
}

function stateChangedstr() 
{ 
 if (xmlHttpstr.readyState==4 || xmlHttpstr.readyState=="complete")
 { 
  document.getElementById("rep_email_avil").innerHTML=xmlHttpstr.responseText 
  if(xmlHttpstr.responseText == "<font color='red'>User name Already Exists</font>")
  { 
  document.getElementById('username').value = ""; }
 } 
} 

function GetXmlHttpObjectstr()
{ 
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
  objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp
}

/////////////////////////////////////////

function cmailavaliability(str)
{
	  
xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		}
		
		var url="ajaxcontacts.php"
		url=url+"?cmail="+str
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged1 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
}

function stateChanged1() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
  document.getElementById("rep_cmail").innerHTML=xmlHttp.responseText 
 } 
} 

function GetXmlHttpObject()
{ 
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
  objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp
}





