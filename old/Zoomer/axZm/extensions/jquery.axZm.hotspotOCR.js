/**
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.hotspotOCR.js
* Copyright: Copyright (c) 2010-2016 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 1.3
* Extension Date: 2016-03-03
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
* Example: http://www.ajax-zoom.com/examples/example34.php
*/

;(function($){
	$.azOcrData = {};
	
	if (!Array.prototype.indexOf){
	  Array.prototype.indexOf = function(elt /*, from*/)
	  {
	    var len = this.length >>> 0;

	    var from = Number(arguments[1]) || 0;
	    from = (from < 0)
	         ? Math.ceil(from)
	         : Math.floor(from);
	    if (from < 0)
	      from += len;

	    for (; from < len; from++)
	    {
	      if (from in this &&
	          this[from] === elt)
	        return from;
	    }
	    return -1;
	  };
	}
	
	// Add a button to show / hide navi layer to the left in this page layout
	var addHideDiv = function(){
		$('<div />')
		.addClass('zoomToHotspotMenuSlideAway')
		.html('<div class="zoomToHotspotMenuSlideAwayInner">H<br>I<br>D<br>E</div>')
		.bind('click', function(){
			var curLeft =  parseInt($('#nav').css('left'));
			$.fn.axZm.resizeStart(3000); 
			
			if (curLeft == 0){
				$('#nav').animate({
					left: -($('#nav').outerWidth())
				},{
					queue: false, 
					duration: 300,
					complete: function(){
						$('.zoomToHotspotMenuSlideAway').html('<div class="zoomToHotspotMenuSlideAwayInner">S<br>H<br>O<br>W</div>');
						adjustHeight();
						$.fn.axZm.resizeStart(1); 
					}
				});

				$('#footer').animate({
					width: $(window).width() - parseInt($('#footer').css('paddingRight'))
				},{
					queue: false, 
					duration: 300
				});
				
				$('#content').animate({
					width: $(window).width()
				},{
					queue: false, 
					duration: 300
				});
				
				// $('#nav').css('left', -($('#nav').outerWidth()))
				// $(this).html('<div class="zoomToHotspotMenuSlideAwayInner">S<br>H<br>O<br>W</div>');
				// adjustHeight();
				// $.fn.axZm.resizeStart(1); 
			}else{
				$('#nav').animate({
					left: 0
				},{
					queue: false, 
					duration: 300,
					complete: function(){
						$('.zoomToHotspotMenuSlideAway').html('<div class="zoomToHotspotMenuSlideAwayInner">H<br>I<br>D<br>E</div>');
						adjustHeight();
						$.fn.axZm.resizeStart(1); 
					}
				});
				
				
				$('#footer').animate({
					width: $(window).width() - $('#nav').outerWidth() - parseInt($('#footer').css('paddingRight'))
				},{
					queue: false, 
					duration: 300
				});
				
				$('#content').animate({
					width: $(window).width() - $('#nav').outerWidth()
				},{
					queue: false, 
					duration: 300
				});
				
				// $('#nav').css('left', 0);
				// $(this).html('<div class="zoomToHotspotMenuSlideAwayInner">H<br>I<br>D<br>E</div>');
				// adjustHeight();
				// $.fn.axZm.resizeStart(1); 
			}
		})
		.appendTo('#nav');
	};
	
	// Prepare an array for autosuggest
	var processOCRjson = function(data, kk){
		$.each(data, function (key, value){
			var newItem = {};
			newItem.value = key;
			newItem.name = key + ' (' + value.length +')';
			if (kk == 'jsonObject'){
				$.azOcrData.autoSuggestData.push(newItem);
			}else{
				$.azOcrData.aS[kk].push(newItem);
			}
		});
	};
	
	// Filter ocr words for current page
	var prepareOnPageSearch = function(pp){
		var page = pp ? pp : $.axZm.zoomID;
		if (!$.azOcrData.pS){
			$.azOcrData.pS = {}; // filtered $.azOcrData.jsonObject
			$.azOcrData.aS = {}; // filtered autosuggest array
		}
		
		if (!$.azOcrData.pS[page]){
			$.azOcrData.pS[page] = {};
			$.azOcrData.aS[page] = [];
			
			// could be also done with zoomLoadOCR.php by passing "pageNumber" parameter
			$.each($.azOcrData.jsonObject, function(w, a){ // a is array
				$.each(a, function(k, p){
					if (p.P == page){
						if (!$.azOcrData.pS[page][w]){
							$.azOcrData.pS[page][w] = [];
						}
						$.azOcrData.pS[page][w].push(p);
					}
				});
			});
			
			processOCRjson($.azOcrData.pS[page], page);
		}
		
		return true;
	};
	
	// Toggle gallery and one page search
	var pageSearchToggle = function(inpID){
 		var checked = $('#'+inpID).axZmGetPropType('checked');
 		
 		$('#hotspotCoord').empty();
 		$('#axZm_zoomFullGalleryInner li, #axZm_zoomGallery li').css('display', 'block');
 		$.fn.axZm.removeAllHotspots();
 		
 		if (checked){
 			if (prepareOnPageSearch($.axZm.zoomID)){
 				$.azOcrData.pageSearch = true;
 				initAutoSuggest($.azOcrData.aS[$.axZm.zoomID]);
			}
		}else{
			$.azOcrData.pageSearch = false;
			initAutoSuggest();
		}
	 	
	};
	
	// Init autosuggest
	var initAutoSuggest = function(data, preFill){
		// Save autosuggest field
		if (!$.azOcrData.autoSuggestSave){
			$.azOcrData.autoSuggestSave = $('#hotspotList').html();
		}
		
		// Rest autosuggest field
		$('#hotspotList').html($.azOcrData.autoSuggestSave);
		
		var newPrefill = [];
		
		// Check prefill, it is buggy in autoSuggest itself
		if (preFill){
			var words = preFill.split(',');
			
			// Remove empty spaces
			$.each(words, function(a,b){words[a] = $.trim(b)});
			
			$.each($.azOcrData.autoSuggestData, function(n, o){
				if ($.inArray(o.value, words) != -1){
					newPrefill.push(o);
				}
			})
		}
		
		// Init autosuggest
		$('#autoSuggestField')
		.val('') // clean field
		.attr('disabled', false)
		.autoSuggest(data ? data : $.azOcrData.autoSuggestData, {
			
			selectedItemProp: "name", 
			searchObjProps: "value", 
			startText: "Your searchword",
			emptyText: "No results found",
			limitText: "No more selections are allowed",
			minChars: 1, 
			keyDelay: 400,
			selectionLimit: 10, // max selected search results
			retrieveLimit: 15, // max autosuggest results in dropdown
			asHtmlID: 123,
			// matchFirstLetters option was added by AJAX-ZOOM to only match first letters
			matchFirstLetters: true,
			preFill: !$.isEmptyObject(newPrefill) ? newPrefill : null,
			selectionAdded: function(elem){
				handleAutoSuggest();
			},
			selectionRemoved: function(elem){
				handleAutoSuggest();
				elem.remove();
			},
			start: function(){
				if (preFill){
					setTimeout(handleAutoSuggest, 1);
				}
			}
		});
	};
	
	// Executed after a word from autosuggest has been selected or removed
	var handleAutoSuggest = function(){
		
		var selValue = $('#as-values-123').val();
		if (!selValue){return;}
		// get the selected keys
		var selKeys = cleanArray($('#as-values-123').val().split(','));

		// remove menu buttons for zooming to specified hotpot
		$('#hotspotCoord').empty();
		
		// remove all hotspots from the player
		$.fn.axZm.removeAllHotspots();
		
		// count matches
		var countMatches = selKeys.length;

		// hide / show thumbs in the galleries
		if (countMatches <= 0){
			$('#axZm_zoomFullGalleryInner li, #axZm_zoomGallery li').css('display', 'block'); 
			$('#someTextLeft').css('display', 'block');
		}else{
			$('#axZm_zoomFullGalleryInner li, #axZm_zoomGallery li').css('display', 'none');
			$('#someTextLeft').css('display', 'none');
		}
		
		var emptySel = false;
		if (!$.azOcrData.foundPages || $.azOcrData.foundPages.length == 0){
			emptySel = true;
		}
		
		// redefine found pages
		$.azOcrData.foundPages = [];
		
		var colorClass = 'zoomToHotspotMenuEven',
			firstMatch = true;
		
		// iterate over each found words
		$.each(selKeys, function(i, val){
			
			if (colorClass == 'zoomToHotspotMenuOdd'){
				colorClass = 'zoomToHotspotMenuEven';
			}else{
				colorClass = 'zoomToHotspotMenuOdd';
			}
			
			var firstEll = true,
				lastVal = null,
				lastPage = null;
			
			// iterate over each position of the word
			$.each($.azOcrData.pageSearch ? $.azOcrData.pS[$.axZm.zoomID][val] : $.azOcrData.jsonObject[val], function(k, v){
				
				// need to make sure that hotspot id has valid characters
				var idPrefix = filterID(val);
				
				var posObj = {};
				/*
				posObj[parseInt(v.P)] = {
					left: parseInt(v.x),
					top: parseInt(v.y),
					width: parseInt(v.W),
					height: parseInt(v.H)
				};
				*/
				
				// could also make it a little bigger
				posObj[parseInt(v.P)] = {
					left: parseInt(v.x)-2,
					top: parseInt(v.y)-2,
					width: parseInt(v.W)+4,
					height: parseInt(v.H)+4
				};
				

				// Add found ID to the $.azOcrData.foundPages
				$.azOcrData.foundPages.push(parseInt(v.P));

				// Enable vertical gallery thumb
				$('#axZm_zoomGalImg_'+v.P).css('display', 'block');
				if (firstMatch){
					firstMatch = false;
				}
				$('#axZm_zoomFullGalImg_'+v.P).css('display', 'block');
 
 				////////////////////////////////////////
				// Add simple menu under dropdown box //
				////////////////////////////////////////
				/*
				var leftNumber = k+1;
				if (leftNumber < 10){leftNumber = '0'+leftNumber;}

				$('<div />')
				.html(leftNumber+'. '+val+' (page: '+v.P+')')
				.addClass(colorClass)
				.css((firstEll && !firstMatch) ? {marginTop: 10} : {})
				.data('hotspotLink', val+'_'+k)
				.bind('click', function(){
					// Use AJAX-ZOOM API to zoom to hotspot when clicked on the link
					$.fn.axZm.zoomToHotspot(idPrefix+'_'+k, {
						zoomToRect: 20, 
						switchQuick: true,
						zoomID: parseInt(v.P),
						speed: 300,
						speedZoomed: 300
					});
				})
				.bind('mouseover', function(){
					$(this).addClass('mousehover');
				})
				.bind('mouseout', function(){
					$(this).removeClass('mousehover');
				})
				.appendTo('#hotspotCoord');
				*/
				
				////////////////////////////////////////////////
				// Add a more complex menu under dropdown box //
				////////////////////////////////////////////////
				
				// Title with word name
				if (lastVal != val){
					lastVal = val;
					$('<div />').addClass('zoomToHotspotTitle').html(val).appendTo('#hotspotCoord');
				}
				
				// Page number
				if (lastPage != v.P){
					lastPage = v.P;
					$('<div />').addClass('zoomToHotspotPage').html('Page - '+v.P).appendTo('#hotspotCoord');
				}
				
				
				
				var leftNumber = k+1;
				if (leftNumber < 10){leftNumber = '0'+leftNumber;}
				
				// Results (only numbers, yould be whatever ofcourse)
				$('<div />')
				.addClass('zoomToHotspotLink')
				.html(leftNumber)
				//.css((firstEll && !firstMatch) ? {marginTop: 10} : {})
				.data('hotspotLink', idPrefix+'_'+k)
				.bind('click', function(){
					// Use AJAX-ZOOM API to zoom to hotspot when clicked on the link
					$.fn.axZm.zoomToHotspot(idPrefix+'_'+k, {
						zoomToRect: 20, 
						switchQuick: true,
						zoomID: parseInt(v.P),
						speed: 300,
						speedZoomed: 300,
						callback: function(){
							// Set color of all hotspots to green
							$('.axZmHotspotText').css({
								backgroundColor: '#008000'
							});
							
							// Set color of the hotspot selected to red
							$("#axZmHotspotText_"+idPrefix+"_"+k).animate({
								backgroundColor: '#7F0200'
							});
						}
					});
				})
				.bind('mouseover', function(){
					$(this).addClass('mousehover');
				})
				.bind('mouseout', function(){
					$(this).removeClass('mousehover');
				})
				.appendTo('#hotspotCoord');

				firstEll = false;
				
				// Use AJAX-ZOOM API to create hotspots on the fly
				$.fn.axZm.createNewHotspot({
					name: idPrefix+'_'+k, // can be whatever
					autoPos: false, // we habe positins for this frame
					draggable: false, // draggable is not needed here
					noInit: true, // do not init hotspots right now (is done later with $.fn.axZm.initHotspots();)
					autoTitle: false, // do not set "alt" title for the hotspot
					posObj: posObj,
					settings: {
						shape: 'rect',
						padding: 2,
						opacity: 1,
						opacityOnHover: 1,
						backColor: '',
						borderWidth: 1,
						borderStyle: 'dotted',
						borderColor: 'red',
						hotspotText: '',
						hotspotTextCss: {
							padding: 0,
							width: '100%',
							height: '100%',
							backgroundColor: '#008000', // green color
							opacity: 0.35
						},
						altTitle: 'Hotspot name: \"'+idPrefix+'_'+k+'\"<br> \
									Image name: '+$.axZm.zoomGA[v.P]['img']+'<br> \
									Position: left: '+parseInt(v.x)+', top: '+parseInt(v.y)+', width: '+parseInt(v.W)+', height: '+parseInt(v.H)+'',
						labelTitle: '['+leftNumber+'] '+val,
						labelGravity: 'topRight',
						
						onRender: function(){
							$("#axZmLabel_"+idPrefix+"_"+k).css({pointerEvents: 'auto'}).bind('click', function(){
								$.fn.axZm.zoomToHotspot(idPrefix+'_'+k, {zoomToRect: 20, zoomID: parseInt(v.P)});
							});								
						},
						click: function(){
							// When clicking on the hotspot zoom to it but keep it fully visible (zoomToRect: 20), 20 is the margin
							$.fn.axZm.zoomToHotspot(idPrefix+'_'+k, {
								zoomToRect: 20, 
								zoomID: parseInt(v.P)
							});
							
							// Set color of all hotspots to green
							$('.axZmHotspotText').css({
								backgroundColor: '#008000'
							});
							
							// Set color of the hotspot selected to red
							$("#axZmHotspotText_"+idPrefix+"_"+k).animate({
								backgroundColor: '#7F0200'
							});
						}
					}
				});
				
			});
			
			// Initialize / redraw hotspots
			$.fn.axZm.initHotspots();
			
			if (emptySel && $.azOcrData.foundPages.length>0){
				$.fn.axZm.zoomSwitch($.azOcrData.foundPages[0]);
			}
			
		});
		
			
		// Remove duplicates from found pages
		$.azOcrData.foundPages = $($.azOcrData.foundPages).filter(function(elem, pos) {
			return $.azOcrData.foundPages.indexOf(elem) == pos;
		});

		// Sort array
		$.azOcrData.foundPages.sort(function(a, b) {
			return a - b;
		});
 
		adjustHeight();
	};

	// Load OCR data
	var loadOCRjson = function(url, ocrFilesPath, preFill){
		$.ajax({
			type: "POST",
			dataType: "json",
			cache: false,
			url: url, // path to the file which returns data for the hotspots
			data: ocrFilesPath,
			success: function(data){

				// Error handling
				if ($.type(data) != 'object'){
					$('#autoSuggestField').val('Error loading OCR data');
					return;
				}else if (data.azErr){
					$.fn.axZm.zoomAlert(data.azErr.join('<br><br>'),'<span style="color: red">Error loading OCR data</span>', null, false);
					$('#autoSuggestField').val('Error loading OCR data');
					return;
				}
				
				
				$('#autoSuggestPageSearch').attr('checked', false);
				$.azOcrData.jsonObject = data;
				$.azOcrData.autoSuggestData = [];
				processOCRjson(data, 'jsonObject');
				initAutoSuggest(null, preFill);
			}
		});
	};
	
	// Change images and ocr data without reloading the page
	var changeOCRcontent = function(parameter, ocrFilesPath, ocrSchema, preFill){
		// Empty search results from the prev set of images
		$('#hotspotCoord').empty();
		
		$('#someTextLeft').css('display', 'block');
		
		// Remove all hotspots
		$.fn.axZm.removeAllHotspots();
		
		if ($.azOcrData && $.azOcrData.autoSuggestSave){
			$.azOcrData.pS = {}; 
			$.azOcrData.aS = {};  
			$('#hotspotList').html($.azOcrData.autoSuggestSave);
		}
		
		
		// e.g. zoomDir=../pic/newspaper/pic
		// zoomDir=../examples/data/example34/pic
		$.fn.axZm.loadAjaxSet(parameter+'&'+ajaxZoom.example, null, function(){
			// callback which will load OCR for the set of images

			if (ocrFilesPath){
				if (!ocrSchema){
					ocrSchema = ajaxZoom.ocrSchema;
				}
				
				loadOCRjson(
					ajaxZoom.path+'zoomLoadOCR.php', // path to the file which returns data for the hotspots
					// e.g. ../pic/newspaper/xml
					// zoomDir=../examples/data/example34/pic
					'ocrFilesPath='+ocrFilesPath+'&ocrSchema='+ocrSchema,
					preFill
				);
			}
		});
	};

	// Filter images where a word has been found and hide where not
	var filterFullGallery = function(){
		setTimeout(function(){
			if ($.azOcrData.foundPages && $.azOcrData.foundPages.length > 0){
				$('#axZm_zoomFullGalleryInner').children().each(function(i) { 
					var thisID = $(this).attr('id').split('_')[1];
					if ($.inArray(parseInt(thisID), $.azOcrData.foundPages) == -1){
						$(this).css('display', 'none');
					}
				});
			}
		}, 1);			
	};
	
	// Filter images when clicked on prev / next buttons
	// This function is attached to AJAX-ZOOM onBeforePrevNext callback 
	var filterPrevNext = function(arr){
		if ($.azOcrData.foundPages && $.azOcrData.foundPages.length > 0){
			var direction = arr[0],
				nextImage = arr[1];
			
			// Find current image or select first
			if ($.inArray($.axZm.zoomID, $.azOcrData.foundPages) == -1){
				return $.azOcrData.foundPages[0];
			}else{
				var curIndex = $.inArray($.axZm.zoomID, $.azOcrData.foundPages);
				if (direction == 'next'){
					var loadIndex = curIndex + 1;
					if ($.azOcrData.foundPages[loadIndex]){
						return $.azOcrData.foundPages[loadIndex];
					}else{
						return $.azOcrData.foundPages[0];
					}
				}else{
					var loadIndex = curIndex - 1;
					if ($.azOcrData.foundPages[loadIndex]){
						return $.azOcrData.foundPages[loadIndex];
					}else{
						return $.azOcrData.foundPages[$.azOcrData.foundPages.length-1];
					}
				}
			}
		}else{
			return false;
		}
	};

	// Utility function
	var	cleanArray = function(actual){
		var newArray = [];
		for(var i = 0; i<actual.length; i++){
			if (actual[i]){
				newArray.push(actual[i]);
			}
		}
		return newArray;
	};
	
	// Utility function
	var versioncompare = function(version1, version2){
		if (version1 == version2) {return 0;}
		var v1 = $.map(version1.split('.'), function(v){
			return parseInt(v, 10);
		}),v2 = $.map(version2.split('.'), function(v){
			return parseInt(v, 10);
		});

		var len = Math.max(v1.length, v2.length);
		for (var i = 0; i < len; i++) {
			v1[i] = v1[i] || 0;
			v2[i] = v2[i] || 0;
			if (v1[i] == v2[i]) {
				continue;
			}
			return v1[i] > v2[i] ? 1 : -1;
		}
		return 0;
	};
	
	// Utility function
	var filterID = function(val){
		var r = val.replace(/[^a-zA-Z_0-9-]/g, '');
		
		if (r == ''){
			r += new Date().getTime() + '_' + Math.floor(Math.random()*100000000);
		} else if (r != val){
			r += '_'+ new Date().getTime() + '_' + Math.floor(Math.random()*100000000);
		}
		return r;
	};
	
	// Utility function
	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	
	// Utility function
	$.fn.axZmGetPropType = function(type){
		var oldJQuery = versioncompare('1.6', $.fn.jquery) > 0 ? true : false;
		if (oldJQuery){return $(this).attr(type);}else{return $(this).prop(type);}
	};
	
	// Make some functions available in the global scope
	$.azOcr = {
		addHideDiv: addHideDiv,
		pageSearchToggle: function(a){pageSearchToggle(a)},
		filterPrevNext: function(a){return filterPrevNext(a)},
		filterFullGallery: filterFullGallery,
		loadOCRjson: function(a, b, c){loadOCRjson(a, b, c)},
		handleAutoSuggest: handleAutoSuggest,
		changeOCRcontent: function(a, b, c, d){changeOCRcontent(a, b, c, d)},
		getParameterByName: function(a){return getParameterByName(a)}
	};

})(jQuery);