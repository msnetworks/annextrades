 /*
 * AutoSuggest
 * Copyright 2009-2010 Drew Wilson
 * www.drewwilson.com
 * code.drewwilson.com/entry/autosuggest-jquery-plugin
 *
 * Forked by Wu Yuntao
 * github.com/wuyuntao/jquery-autosuggest
 *
 * Modified by AJAX-ZOOM !!!
 *
 * Version 1.6.2
 *
 * This Plug-In will auto-complete or auto-suggest completed search queries
 * for you as you type. You can add multiple selections and remove them on
 * the fly. It supports keybord navigation (UP + DOWN + RETURN), as well
 * as multiple AutoSuggest fields on the same page.
 *
 * Inspired by the Autocomplete plugin by: Joern Zaefferer
 * and the Facelist plugin by: Ian Tearle (iantearle.com)
 * 
 
 *
 * This AutoSuggest jQuery plug-in is dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

(function(c){c.fn.autoSuggest=function(n,C){function F(a){var c=0;for(k in a)a.hasOwnProperty(k)&&c++;return c}function K(){var b=a.extraParams;return c.isFunction(b)?b():b}var a=c.extend({asHtmlID:!1,startText:"Enter name here",usePlaceholder:!1,emptyText:"No results found",preFill:{},limitText:"No more selections are allowed",selectedItemProp:"value",selectedValuesProp:"value",searchObjProps:"value",queryParam:"q",retrieveLimit:!1,extraParams:"",matchCase:!1,minChars:1,keyDelay:400,resultsHighlight:!0,
neverSubmit:!1,selectionLimit:!1,showResultList:!0,showResultListWhenNoMatch:!1,canGenerateNewSelections:!0,matchFirstLetters:!1,start:function(){},selectionClick:function(){},selectionAdded:function(){},selectionRemoved:function(a){a.remove()},formatList:!1,beforeRetrieve:function(a){return a},retrieveComplete:function(a){return a},resultClick:function(){},resultsComplete:function(){}},C),d,x=null;"function"==typeof n?d=n:"string"==typeof n?d=function(b,J){var d="";a.retrieveLimit&&(d="&limit="+
encodeURIComponent(a.retrieveLimit));x=c.getJSON(n+"?"+a.queryParam+"="+encodeURIComponent(b)+d+K(),function(c){c=a.retrieveComplete.call(this,c);J(c,b)})}:"object"==typeof n&&0<F(n)&&(d=function(a,c){c(n,a)});if(d)return this.each(function(b){function n(){var c=j.val().replace(/[\\]+|[\/]+/g,"");c!=y&&(y=c,c.length>=a.minChars?(e.addClass("loading"),G(c)):(e.removeClass("loading"),g.hide()))}function G(c){a.beforeRetrieve&&(c=a.beforeRetrieve.call(this,c));z();d(c,C)}function C(r,b){a.matchCase||
(b=b.toLowerCase());b=b.replace("(","\\(","g").replace(")","\\)","g");var A=0;g.html(u.html("")).hide();for(var m=F(r),n=b.length,f=0;f<m;f++){var l=f;H++;var d=!1;if("value"==a.searchObjProps)var s=r[l].value;else for(var s="",p=a.searchObjProps.split(","),q=0;q<p.length;q++)var v=c.trim(p[q]),s=s+r[l][v]+" ";s&&(a.matchCase||(s=s.toLowerCase()),a.matchFirstLetters?s.substring(0,n)==b&&-1==h.val().search(","+r[l][a.selectedValuesProp]+",")&&(d=!0):-1!=s.search(b)&&-1==h.val().search(","+r[l][a.selectedValuesProp]+
",")&&(d=!0));if(d&&(d=c('<li class="as-result-item" id="as-result-item-'+l+'"></li>').click(function(){var b=c(this).data("data"),r=b.num;if(0>=c("#as-selection-"+r,e).length&&!B){var D=b.attributes;j.val("").focus();y="";w(D,r);a.resultClick.call(this,b);g.hide()}B=!1}).mousedown(function(){t=!1}).mouseover(function(){c("li",u).removeClass("active");c(this).addClass("active")}).data("data",{attributes:r[l],num:H}),l=c.extend({},r[l]),s=a.matchCase?RegExp("(?![^&;]+;)(?!<[^<>]*)("+b+")(?![^<>]*>)(?![^&;]+;)",
"g"):RegExp("(?![^&;]+;)(?!<[^<>]*)("+b+")(?![^<>]*>)(?![^&;]+;)","gi"),a.resultsHighlight&&0<b.length&&(l[a.selectedItemProp]=l[a.selectedItemProp].replace(s,"<em>$1</em>")),d=a.formatList?a.formatList.call(this,l,d):d.html(l[a.selectedItemProp]),u.append(d),delete l,A++,a.retrieveLimit&&a.retrieveLimit==A))break}e.removeClass("loading");0>=A&&u.html('<li class="as-message">'+a.emptyText+"</li>");u.css("width",e.outerWidth());(0<A||!a.showResultListWhenNoMatch)&&g.show();a.resultsComplete.call(this)}
function w(b,D){h.val((h.val()||",")+b[a.selectedValuesProp]+",");var d=c('<li class="as-selection-item" id="as-selection-'+D+'" data-value="'+b[a.selectedValuesProp]+'"></li>').click(function(){a.selectionClick.call(this,c(this));e.children().removeClass("selected");c(this).addClass("selected")}).mousedown(function(){t=!1}),g=c('<a class="as-close">&times;</a>').click(function(){h.val(h.val().replace(","+b[a.selectedValuesProp]+",",","));a.selectionRemoved.call(this,d);t=!0;j.focus();return!1});
p.before(d.html(b[a.selectedItemProp]).prepend(g));a.selectionAdded.call(this,p.prev(),b[a.selectedValuesProp]);return p.prev()}function I(a){if(0<c(":visible",g).length){var b=c("li",g),d="down"==a?b.eq(0):b.filter(":last"),e=c("li.active:first",g);0<e.length&&(d="down"==a?e.next():e.prev());b.removeClass("active");d.addClass("active")}}function z(){x&&(x.abort(),x=null)}if(a.asHtmlID)f=b=a.asHtmlID;else{b=b+""+Math.floor(100*Math.random());var f="as-input-"+b}a.start.call(this,{add:function(a){w(a,
"u"+c("li",e).length).addClass("blur")},remove:function(a){h.val(h.val().replace(","+a+",",","));e.find('li[data-value = "'+a+'"]').remove()}});var j=c(this);j.attr("autocomplete","off").addClass("as-input").attr("id",f);a.usePlaceholder?j.attr("placeholder",a.startText):j.val(a.startText);var t=!1;j.wrap('<ul class="as-selections" id="as-selections-'+b+'"></ul>').wrap('<li class="as-original" id="as-original-'+b+'"></li>');var e=c("#as-selections-"+b),p=c("#as-original-"+b),g=c('<div class="as-results" id="as-results-'+
b+'"></div>').hide(),u=c('<ul class="as-list"></ul>'),h=c('<input type="hidden" class="as-values" name="as_values_'+b+'" id="as-values-'+b+'" />'),m="";if("string"==typeof a.preFill){f=a.preFill.split(",");for(b=0;b<f.length;b++){var q={};q[a.selectedValuesProp]=f[b];""!=f[b]&&w(q,"000"+b)}m=a.preFill}else{m="";f=0;for(k in a.preFill)a.preFill.hasOwnProperty(k)&&f++;if(0<f)for(b=0;b<f;b++)q=a.preFill[b][a.selectedValuesProp],void 0==q&&(q=""),m=m+q+",",""!=q&&w(a.preFill[b],"000"+b)}""!=m&&(j.val(""),
","!=m.substring(m.length-1)&&(m+=","),h.val(","+m),c("li.as-selection-item",e).addClass("blur").removeClass("selected"));j.after(h);e.click(function(){t=!0;j.focus()}).mousedown(function(){t=!1}).after(g);var v=null,E=null,y="",B=!1;j.focus(function(){!a.usePlaceholder&&c(this).val()==a.startText&&""==h.val()?c(this).val(""):t&&(c("li.as-selection-item",e).removeClass("blur"),""!=c(this).val()&&(u.css("width",e.outerWidth()),g.show()));v&&clearInterval(v);v=setInterval(function(){a.showResultList&&
(a.selectionLimit&&c("li.as-selection-item",e).length>=a.selectionLimit?(u.html('<li class="as-message">'+a.limitText+"</li>"),g.show()):n())},a.keyDelay);t=!0;0==a.minChars&&G(c(this).val());return!0}).blur(function(){!a.usePlaceholder&&""==c(this).val()&&""==h.val()&&""==m&&0<a.minChars?c(this).val(a.startText):t&&(c("li.as-selection-item",e).addClass("blur").removeClass("selected"),g.hide());v&&clearInterval(v)}).keydown(function(b){first_focus=!1;switch(b.keyCode){case 38:b.preventDefault();I("up");
break;case 40:b.preventDefault();I("down");break;case 8:if(""==j.val()){var d=h.val().split(","),d=d[d.length-2];e.children().not(p.prev()).removeClass("selected");p.prev().hasClass("selected")?(h.val(h.val().replace(","+d+",",",")),a.selectionRemoved.call(this,p.prev())):(a.selectionClick.call(this,p.prev()),p.prev().addClass("selected"))}1==j.val().length&&(g.hide(),y="",z());0<c(":visible",g).length&&(E&&clearTimeout(E),E=setTimeout(function(){n()},a.keyDelay));break;case 9:case 188:if(a.canGenerateNewSelections){B=
!0;var d=j.val().replace(/(,)/g,""),f=c("li.active:first",g);if(""!==d&&0>h.val().search(","+d+",")&&d.length>=a.minChars&&0===f.length){b.preventDefault();b={};b[a.selectedItemProp]=d;b[a.selectedValuesProp]=d;d=c("li",e).length;w(b,"00"+(d+1));j.val("");z();break}}case 13:B=!1;f=c("li.active:first",g);0<f.length&&(f.click(),g.hide());(a.neverSubmit||0<f.length)&&b.preventDefault();break;case 27:case 16:case 20:z(),g.hide()}});var H=0})}})(jQuery);
