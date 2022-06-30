function FUNCTION1(value)
{
//alert("hai"); 	
 xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		var url="ajaxcat.php"
		url=url+"?id="+value
		
		url=url+"&sid="+Math.random()
//		alert(url);
		xmlHttp.onreadystatechange=stateChanged123 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
} 

function stateChanged123() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
  document.getElementById("subcat12").innerHTML=xmlHttp.responseText 
 } 
} 
function FUNCTION112(value)
{
	
 xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		var url="ajaxcat.php"
		url=url+"?id="+value
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged1234 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
}

function stateChanged1234() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
  document.getElementById("subcat121").innerHTML=xmlHttp.responseText 
 } 
} 

function delete_pro(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_pro.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_pro
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_pro() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content").innerHTML=xmlHttp.responseText 
 } 
}


function delete_pro1(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_pro1.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_pro1
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
	
 
}
//s="+str+"&cat="+cat
function stateChanged_pro1() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content1").innerHTML=xmlHttp.responseText 
 } 
}

function delete_pro2(value,page)
{
	
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_pro2.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_pro2
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)	
		
		return true;
	}
	else
	{
		return false;
	}
	
	
 
}
//s="+str+"&cat="+cat
function stateChanged_pro2() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content2").innerHTML=xmlHttp.responseText 
 } 
}

function delete_pro3(value,page)
{
	//alert(value);
	//alert(page);
	
	

	if(confirm('Are you sure want to delete this record?'))
	{
	 xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_pro3.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_pro3
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)	
		
		return true;
	}
	else
	{
		return false;
	}
}
//s="+str+"&cat="+cat
function stateChanged_pro3() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content3").innerHTML=xmlHttp.responseText 
 } 
}





function delete_fun(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_sel
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_sel() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content").innerHTML=xmlHttp.responseText 
 } 
}


function delete_fun1(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process1.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_sel1
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_sel1() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content1").innerHTML=xmlHttp.responseText 
 } 
}

function delete_fun3(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process2.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_sel3
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_sel3() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content2").innerHTML=xmlHttp.responseText 
 } 
}


function delete_fun4(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process3.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_sel4
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_sel4() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content3").innerHTML=xmlHttp.responseText 
 } 
}

function delete_buy(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	 xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_buy.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_buy 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}

}
//s="+str+"&cat="+cat
function stateChanged_buy() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content").innerHTML=xmlHttp.responseText 
 } 
}

function delete_buy(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_buy.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_buy 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}



function stateChanged_buy() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content").innerHTML=xmlHttp.responseText 
 } 
}

function delete_new(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_buy1.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_buy1 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_buy1() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content1").innerHTML=xmlHttp.responseText 
 } 
}

function delete_new1(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_buy2.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_buy2 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_buy2() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content2").innerHTML=xmlHttp.responseText 
 } 
}
function delete_new2(value,page)
{
	if(confirm('Are you sure want to delete this record?'))
	{
	xmlHttp=GetXmlHttpObject1()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		
		var url="process_buy3.php"
		url=url+"?id="+value+"&page="+page
		
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged_buy3 
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
		return true;
	}
	else
	{
		return false;
	}
 
}
//s="+str+"&cat="+cat
function stateChanged_buy3() 
{ 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 //window.location.href = "selling_leads.php";
  document.getElementById("content3").innerHTML=xmlHttp.responseText 
 } 
}

function GetXmlHttpObject1()
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


