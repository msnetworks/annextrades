$(document).ready(function() {

	// Credentials
	var baseUrl = "https://annextrades.com:8080/send-msg";
	console.log('ms hello');
	//---------------------------------- Add dynamic html bot content(Widget style) ----------------------------
	// You can also add the html content in html page and still it will work!
	var mybot = 
				'<div class="col-md-12 text-center"><h4 class="chat-reps"><font><img src="https://annextrades.com/assets/images/chatgirl.png" style="width: 40px; border-radius: 50px;">&nbsp;&nbsp; <b>Hi, need some help?</b></font></h4></div>'+
				'<div class="col-md-12 text-center"><button style="background-color: #37479a; font-weight: 700;" class="profile_div1 btn btn-primary">CHAT NOW</button></div>'+
				'<div class="separator">or Call us</div>'+
				'<div class="number text-center"><a style="color: #37479a;" href="tel:+18886142950">1 (888) 614-2950</a></div>'+
				'<div class="chatCont" id="chatCont">'+
					'<div class="bot_profile">'+
						'<!--img src="assets/img/bot2.svg" class="bot_p_img"-->'+
						'<div class="close">'+
							'<i class="fa fa-times" aria-hidden="true"></i>'+
						'</div>'+
					'</div><!--bot_profile end-->'+
					'<div id="result_div" class="resultDiv"></div>'+
					'<div class="chatForm" id="chat-div">'+
						'<div class="spinner">'+
							'<div class="bounce1"></div>'+
							'<div class="bounce2"></div>'+
							'<div class="bounce3"></div>'+
						'</div>'+
						'<input type="text" id="chat-input" autocomplete="off" placeholder="Type here"'+ 'class="form-control bot-txt"/>'+
					'</div>'+
				'</div><!--chatCont end-->'+

				'<div class="profile_div" >'+
					'<div class="row">'+
						'<div class="col-hgt">'+
							'<img src="https://annextrades.com/assets/images/annexis-emblem.png" class="img-circle img-profile">'+
						'</div><!--col-hgt end-->'+
						'<div class="col-hgt">'+
							'<div class="chat-txt">'+
								'Let\'\s Chat!'+
							'</div>'+
						'</div><!--col-hgt end-->'+
					'</div><!--row end-->'+
				'</div><!--profile_div end-->';

	$("mybot").html(mybot);
	// ------------------------------------------ Toggle chatbot -----------------------------------------------
	$('.profile_div').click(function() {
		$('.profile_div1').hide();
		$('.profile_div').toggle();
		$('.chatCont').toggle();
		$('.bot_profile').toggle();
		$('.chatForm').toggle();
		document.getElementById('chat-input').focus();
	});

	$('.close').click(function() {
		$('.profile_div1').show();
		$('.profile_div').toggle();
		$('.chatCont').toggle();
		$('.bot_profile').toggle();
		$('.chatForm').toggle();
	});

	$('.profile_div1').click(function() {
		$('.profile_div1').hide();
		$('.profile_div').toggle();
		$('.chatCont').toggle();
		$('.bot_profile').toggle();
		$('.chatForm').toggle();
		document.getElementById('chat-input').focus();
	});


	// Session Init (is important so that each user interaction is unique)--------------------------------------
	/* window.onbeforeunload = function(){
		sessionStorage.setItem("session", window.location.href);
	}
	window.onload = function(){
		if(window.location.href == sessionStorage.getItem("session")){
			sessionStorage.clear();
		}
	} */
	var session = function() {
		// Retrieve the object from storage
		if(sessionStorage.getItem('session')) {
			var retrievedSession = sessionStorage.getItem('session');
		} else {
			// Random Number Generator
			var randomNo = Math.floor((Math.random() * 1000) + 1);
			// get Timestamp
			var timestamp = Date.now();
			// get Day
			var date = new Date();
			var weekday = new Array(7);
			weekday[0] = "Sunday";
			weekday[1] = "Monday";
			weekday[2] = "Tuesday";
			weekday[3] = "Wednesday";
			weekday[4] = "Thursday";
			weekday[5] = "Friday";
			weekday[6] = "Saturday";
			var day = weekday[date.getDay()];
			// Join random number+day+timestamp
			var session_id = randomNo+day+timestamp;
			// Put the object into storage
			sessionStorage.setItem('session', session_id);
			var retrievedSession = sessionStorage.getItem('session');
		}
		return retrievedSession;
		// console.log('session: ', retrievedSession);
	}

	// Call Session init
	
	var mysession = session();


	// on input/text enter--------------------------------------------------------------------------------------
	window.onload = function(e){
		var text = 'hello';
		send(text);
		e.preventDefault();
		return false;
	}
	$('#chat-input').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		var text = $("#chat-input").val();
		if (keyCode === 13) {
			if(text == "" ||  $.trim(text) == '') {
				e.preventDefault();
				return false;
			} else {
				$("#chat-input").blur();
				setUserResponse(text);
				send(text);
				e.preventDefault();
				return false;
			}
		}
	});


	//------------------------------------------- Send request to API.AI ---------------------------------------
		
	function send(text) {
		$.ajax({
		  type: "POST",
		  url: baseUrl,
		  data: { text, mysession },
		  success: function (data) {
			console.log(data);
			main(data.reply);

		  },
		  error: function (e) {
			console.log(e);
		  },
		});
	  }

	//------------------------------------------- Main function ------------------------------------------------
	/* function main(data) {
		var action = data.result.action;
		var speech = data.result.fulfillment.speech;
		// use incomplete if u use required in api.ai questions in intent
		// check if actionIncomplete = false
		var incomplete = data.result.actionIncomplete;
		if(data.result.fulfillment.messages) { // check if messages are there
			if(data.result.fulfillment.messages.length > 0) { //check if quick replies are there
				var suggestions = data.result.fulfillment.messages[1];
			}
		}
		switch(action) {
			// case 'your.action': // set in api.ai
			// Perform operation/json api call based on action
			// Also check if (incomplete = false) if there are many required parameters in an intent
			// if(suggestions) { // check if quick replies are there in api.ai
			//   addSuggestion(suggestions);
			// }
			// break;
			default:
				setBotResponse(speech);
				if(suggestions) { // check if quick replies are there in api.ai
					addSuggestion(suggestions);
				}
				break;
		}
	} */

	function main(text) {
		var textdata = text.split('<br>');
		textdata.forEach(t => {
			setTimeout(() => {
				setBotResponse(t);
			}, 200);
		});
		console.log(text);
		if (text == 'Welcome to ANNEXTrades!<br>Hello, my name is Jack, I am a representative from USA<br>Does your business offer products or services?'){
		addSuggestion(['products', 'services']);
		}
		if (text == 'Are you currently selling in USA?') {
		addSuggestion(['yes', 'no']);	
		}
		if (text == 'We can assist you with this as you know US is decreasing dependency in China and more on India.<br>we are experiencing an exciting new international trade market. Businesses in the USA are depending less on China and are seeking more suppliers from India. We are offering a 14 Day Free Trial, you become a supplier on our USA Based B2B platform to support USA market demands. No start-up cost, No Contracts, No Obligation<br>Are you interested to get started?') {
			addSuggestion(['yeah sure', 'no']);
		}
		if (text == 'We are a USA Based B2B platform and can get you access to USA buyer for your books<br>we are experiencing an exciting new international trade market. Businesses in the USA are depending less on China and are seeking more suppliers from India. We are offering a 14 Day Free Trial, you become a supplier on our USA Based B2B platform to support USA market demands. No start-up cost, No Contracts, No Obligation<br>Are you interested to get started?') {
			addSuggestion(['yeah sure', 'no']);
		}
		if(text == 'Thank you.<br> Please login to email account provided to complete your verification to get started .'){
			setTimeout(() => {
				x = 'Did you get the Invitition on email?'
				setBotResponse(x);
			}, 5000);
		}
	}

	//------------------------------------ Set bot response in result_div -------------------------------------
	function setBotResponse(val) {
		setTimeout(function(){
			/* if($.trim(val) == '') {
				val = 'I couldn\'t get that. Let\' try something else!'
				var BotResponse = '<p style="margin-left: 30px;" class="botResult">'+val+'</p><div class="clearfix"></div>';
				$(BotResponse).appendTo('#result_div');
			} else { */
				val = val.replace(new RegExp('\r?\n','g'), '<br />');
				var BotResponse = '<img src="https://annextrades.com/assets/images/chatgirl.png" style="float: left; width: 30px; border-radius: 30px;"><p style="margin-left: 20px;" class="botResult">'+val+'</p><div class="clearfix"></div>';
				$(BotResponse).appendTo('#result_div');
			/* } */
			scrollToBottomOfResults();
			hideSpinner();
		}, 500);
	}


	//------------------------------------- Set user response in result_div ------------------------------------
	function setUserResponse(val) {
		var UserResponse = '<!--img src="https://annextrades.com/assets/images/annexis-emblem.png" style="float: right; width: 30px; border-radius: 30px;"--><p style="margin-right: 20px;" class="userEnteredText">'+val+'</p><div class="clearfix"></div>';
		$(UserResponse).appendTo('#result_div');
		$("#chat-input").val('');
		scrollToBottomOfResults();
		showSpinner();
		$('.suggestion').remove();
	}


	//---------------------------------- Scroll to the bottom of the results div -------------------------------
	function scrollToBottomOfResults() {
		var terminalResultsDiv = document.getElementById('result_div');
		terminalResultsDiv.scrollTop = terminalResultsDiv.scrollHeight;
	}


	//---------------------------------------- Ascii Spinner ---------------------------------------------------
	function showSpinner() {
		$('.spinner').show();
	}
	function hideSpinner() {
		$('.spinner').hide();
	}


	//------------------------------------------- Suggestions --------------------------------------------------
	function addSuggestion(textToAdd) {
		setTimeout(function() {
			var suggestions = textToAdd;
			var suggLength = textToAdd.length;
			$('<p style="margin-left: 30px;" class="suggestion"></p>').appendTo('#result_div');
			$('<div class="sugg-title">Suggestions: </div>').appendTo('.suggestion');
			// Loop through suggestions
			for(i=0;i<suggLength;i++) {
				$('<span class="sugg-options">'+suggestions[i]+'</span>').appendTo('.suggestion');
			}
			scrollToBottomOfResults();
		}, 1000);
	}

	// on click of suggestions get value and send to API.AI
	$(document).on("click", ".suggestion span", function() {
		var text = this.innerText;
		setUserResponse(text);
		send(text);
		$('.suggestion').remove();
	});
	// Suggestions end -----------------------------------------------------------------------------------------
});
