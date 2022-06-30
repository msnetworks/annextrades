/* ----------------------------------------------------- 
	Project Name: I-Net Massmail
	Javascript Creator: K.N.Sathish
	Created Date: 26/06/2007
	Version: 1.0.0
	Copyrights: © copyright 2007. I-Net Solution.
-------------------------------------------------------*/
/*---------------------------------------------------
	Switching Divs
----------------------------------------------------*/

function getMyStyle(objectId) {
  if(document.getElementById && document.getElementById(objectId)) {
		return document.getElementById(objectId).style;
   } else if (document.all && document.all(objectId)) {  
		return document.all(objectId).style;
   } else if (document.layers && document.layers[objectId]) { 
		return document.layers[objectId];
   } else {
		return false;
   }
}

function switchDiv(divID1, divID2, divID3){
	  var myStyle1 = getMyStyle(divID1);
	  var myStyle2 = getMyStyle(divID2);
	  
	  
	  if (myStyle1){
		switchMyDisplay(divID1, "block");
		switchMyDisplay(divID2, "none");
		
		}
	  else if(myStyle2) {
		switchMyDisplay(divID1, "none");
		switchMyDisplay(divID2, "block");
		
	  }
	 
}

function switchMyDisplay(objectId, newDisplay) {
	var styleObject = getMyStyle(objectId);
	if (styleObject) {
		styleObject.display = newDisplay;
		return true;
	} else {
		return false;
	}
}

/*---------------------------------------------------
	Swapping Tabs
----------------------------------------------------*/

var focus_id = null;
function swapTabs(id, oldclass, newclass) {	
	if (document.getElementById) {
		if(focus_id != null) {
			document.getElementById(focus_id).className = oldclass;
		}
		if(focus_id = "tab1") {
			document.getElementById(focus_id).className = oldclass;
		}
		if(focus_id = "tab2") {
			document.getElementById(focus_id).className = oldclass;
		}
		
		document.getElementById(id).className = newclass;
		document.getElementById(id).style.cursor = "hand";
		focus_id = id;
	}
}


