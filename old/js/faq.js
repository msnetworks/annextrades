// JavaScript Document

function getsubquestion(val)
{
	strUrl = "getsubquestions.php?id="+val;
//	alert(strUrl);
	editDescription(strUrl);
}

function getanswers(val)
{
	strUrl = "getanswers.php?id="+val;
//	alert(strUrl);
	getAnswer(strUrl);
}
function editDescription(url)
{
xmlHttp.open("GET",url,true);
	xmlHttp.onreadystatechange = function() 
	{		
		if(xmlHttp.readyState==4)
		{
			if(xmlHttp.responseText!='')
			{
				document.getElementById('subquestions').innerHTML=xmlHttp.responseText;
			}
			else
			{					
				alert('Something Missing! Particulars Not Added');
			}
		}
	}
	xmlHttp.send(null);
}


function getAnswer(url)
{

xmlHttp.open("GET",url,true);
	xmlHttp.onreadystatechange = function() 
	{		
		if(xmlHttp.readyState==4)
		{
		
		
			if(xmlHttp.responseText!='')
			{
			
				document.getElementById('answers').innerHTML=xmlHttp.responseText;
				
        		
			}
			else
			{					
				alert('Something Missing! Particulars Not Added');
			}
		}
	}
	xmlHttp.send(null);

}		
