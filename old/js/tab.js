
function setTab04Syn ( i )
	{
		selectTab04Syn(i);
	}
	
	function selectTab04Syn ( i )
	{
		switch(i){
			case 1:
			document.getElementById("TabCon1").style.display="block";
			document.getElementById("TabCon2").style.display="none";
			document.getElementById("TabCon3").style.display="none";
			document.getElementById("TabCon4").style.display="none";
			document.getElementById("font1").className='col_01';
			//document.getElementById("font2").className='col_02';
			document.getElementById("font3").className='col_02';
			document.getElementById('bg').className='xixi11';
			break;
			case 2:
			document.getElementById("TabCon1").style.display="none";
			document.getElementById("TabCon2").style.display="block";
			document.getElementById("TabCon3").style.display="none";
			document.getElementById("TabCon4").style.display="none";
			document.getElementById("font1").className='col_02';
			document.getElementById("font2").className='col_01';
			document.getElementById("font3").className='col_02';
			document.getElementById('bg').className='xixi2';
			break; 
			case 3:
			document.getElementById("TabCon1").style.display="none";
			//document.getElementById("TabCon2").style.display="none";
			document.getElementById("TabCon3").style.display="block";
			document.getElementById("font1").className='col_02';
			//document.getElementById("font2").className='col_02';
			document.getElementById("font3").className='col_01';
			document.getElementById('bg').className='xixi22';
			break;
			
			case 4:
			document.getElementById("TabCon1").style.display="none";
			//document.getElementById("TabCon2").style.display="none";
			document.getElementById("TabCon4").style.display="block";
			document.getElementById("font1").className='col_02';
			//document.getElementById("font2").className='col_02';
			document.getElementById("font3").className='col_01';
			document.getElementById('bg').className='xixi23';
			break;
			
		}
	}

<!--
/**/
function rightTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"hover":"";
con.style.display=i==cursel?"block":"none";
}
}
//-->



<!--
/**/
function leftTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("leftcon_"+name+"_"+i);
menu.className=i==cursel?"left_hover":"";
con.style.display=i==cursel?"block":"none";
}
}
//-->


