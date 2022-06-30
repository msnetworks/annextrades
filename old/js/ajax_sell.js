
	
	
	<script type="text/javascript">
	
	$(document).ready(function(){
		
	//Display Loading Image
	function Display_Load2()
	{
	    $("#loading2").fadeIn(900,0);
		$("#loading2").html("<img src='bigLoader.gif' />");
	}
	//Hide Loading Image
	function Hide_Load2()
	{
		$("#loading2").fadeOut('slow');
	};
	

   //Default Starting Page Results
   
	$("#pagination2 span:first").css({'color' : '#FF0084'}).css({'border' : 'none'});
	
	Display_Load2();
	
	$("#content2").load("pagination_data2.php?page=1", Hide_Load2());



	//Pagination Click
	$("#pagination2 span").click(function(){
			
		Display_Load2();
		
		//CSS Styles
		$("#pagination2 span")
		.css({'border' : 'solid #dddddd 1px'})
		.css({'color' : '#0063DC'});
		
		$(this)
		.css({'color' : '#FF0084'})
		.css({'border' : 'none'});

		//Loading Data
		var pageNum2 = this.id;
		
		$("#content2").load("pagination_data2.php?page=" + pageNum2, Hide_Load2());
	});
	
	
});
	</script>
	
	<script type="text/javascript">
	
	$(document).ready(function(){
		
	//Display Loading Image
	function Display_Load1()
	{
	    $("#loading1").fadeIn(900,0);
		$("#loading1").html("<img src='bigLoader.gif' />");
	}
	//Hide Loading Image
	function Hide_Load1()
	{
		$("#loading1").fadeOut('slow');
	};
	

   //Default Starting Page Results
   
	$("#pagination1 span:first").css({'color' : '#FF0084'}).css({'border' : 'none'});
	
	Display_Load1();
	
	$("#content1").load("pagination_data1.php?page=1", Hide_Load1());



	//Pagination Click
	$("#pagination1 span").click(function(){
			
		Display_Load1();
		
		//CSS Styles
		$("#pagination1 span")
		.css({'border' : 'solid #dddddd 1px'})
		.css({'color' : '#0063DC'});
		
		$(this)
		.css({'color' : '#FF0084'})
		.css({'border' : 'none'});

		//Loading Data
		var pageNum1 = this.id;
		
		$("#content1").load("pagination_data1.php?page=" + pageNum1, Hide_Load1());
	});
	
	
});
	</script>
	
<script type="text/javascript">
	
	$(document).ready(function(){
		
	//Display Loading Image
	function Display_Load3()
	{
	    $("#loading3").fadeIn(900,0);
		$("#loading3").html("<img src='bigLoader.gif' />");
	}
	//Hide Loading Image
	function Hide_Load3()
	{
		$("#loading3").fadeOut('slow');	
	};
	

   //Default Starting Page Results
   
	$("#pagination3 span:first").css({'color' : '#FF0084'}).css({'border' : 'none'});
	
	Display_Load3();
	
	$("#content3").load("pagination_data3.php?page=1", Hide_Load3());



	//Pagination Click
	$("#pagination3 span").click(function(){
			
		Display_Load3();
		
		//CSS Styles
		$("#pagination3 span")
		.css({'border' : 'solid #dddddd 1px'})
		.css({'color' : '#0063DC'});
		
		$(this)
		.css({'color' : '#FF0084'})
		.css({'border' : 'none'});

		//Loading Data
		var pageNum3 = this.id;
		
		$("#content3").load("pagination_data3.php?page=" + pageNum3, Hide_Load3());
	});
	
	
});
</script>