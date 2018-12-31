$(function(){

_actualChapRequest = 0;
_actualChapId = 0;
_ifACtiveReader = false;
reshapeScreen();
$(window).resize(function(){
	reshapeScreen();
});
$(window).scroll(function(){
	var screenHeight = $(window).height();
	var headerHeight = $("#header").outerHeight();
	if($(this).scrollTop() >= (screenHeight-headerHeight)){
	$("#header").addClass('fadeBackGround');
    }else{
    $("#header").removeClass('fadeBackGround');	
    }
});
$("#back-list-lk, #fadeTrapBox").click(function(){
	hideChaptersList();
});
$("#back-chap-lk").click(function(){
	hideChaptersList();
	showChaptersList();
});
$(".chapTrackerLk").click(function(){
	var chapIdTk = $(this).attr('id').replace(/(chap\-select\-)(last\-)?(l|r|u|c)\-/,'');
	$("#theWaitingAnnonceBlock").fadeIn(10);
	sendReq('settings/ajax/modif_or_delete_chap.php?q='+chapIdTk+'&byN=0', funcAfterFetch);
});
$(".menuToFollow").click(function(){
	hideChaptersList();
	scrollToSection($(this));
});
$("#goToChapters").click(function(){
	hideChaptersList();
	showChaptersList();
});
$("#next-chap-lk").click(function(){
	reloadReq("n");
});
$("#previous-chap-lk").click(function(){
	reloadReq("p");
});
$(".createLkButt").click(function(){
	openRequiredForm("create");
});
$(".connectLkButt").click(function(){
	openRequiredForm("connect");
});
$(".recoverLkButt").click(function(){
	openRequiredForm("recover");
});
$("#theTriggerLeave, .closeTriggerPseudoButt").click(function(){
	$("#userBoxRun, #messageDisplayCover, #recoverUserBox, #createUserBox, #connectUserBox").fadeOut(10);
	$("#userBoxRun").css({"display":"none"}).removeClass('shakeBox');
	resetFormAndInput();
});
$(".formClTriggered").submit(function(e){
	e.preventDefault();
	loadForUserWait();
	var formIdTk = $(this).attr("id");
	var dataInForm = $(this).serialize();
    sendRequestToServer(formIdTk, dataInForm);
    resetForm();
});
$("#commentAddingForm").submit(function(e){
	e.preventDefault();
	$(".waitingForceLoader").fadeIn(100);
	var formIdTk = $(this).attr("id");
	var dataInForm = $(this).serialize();
	sendRequestToServer(formIdTk, dataInForm);
});
$(".goToDashBord").click(function(){
	openDashBoard();
	hideChaptersList();
})
});

function openDashBoard(){
	$("#dashboard").fadeIn(500);
	$('html').css({'overflow':'hidden'});
}
function sendRequestToServer(formSetName, dataInForm){
	$.ajax({
    type: 'POST',
    url: $("#"+formSetName).attr('action'),
    data: dataInForm
}).done(function(response){
	if(formSetName == 'commentAddingForm'){
		actionAjaxComment(0, response, formSetName);
	}else{
		actionAjaxSuite(0, response, formSetName);
	}
}).fail(function(data){
	if(formSetName == 'commentAddingForm'){
		actionAjaxComment(1, data.responseText, formSetName);
	}else{
		actionAjaxSuite(1, data.responseText, formSetName);
	}
});
}
function actionAjaxComment(ifError, response, formSetName){
	alert(response);
    if(ifError == 0){
    	$("#noErrorTopComment").slideDown(100);
    	$(".waitingForceLoader").fadeOut(100);
    	$("#commentSent").val('');
    }
	}
function actionAjaxSuite(ifError, response, formSetName){
	if(ifError == 0){
	$("#"+formSetName+" .putMiniShape").val('');
	if(formSetName == "createUserForm"){
	$("#noErrorTopCreate").slideDown(100);
	openRequiredForm("connect");
    }
    if(formSetName == "connectUserForm"){
    	window.location = "";
    }
	}else if(ifError == 1){
		$("#"+formSetName+" .errorTriggered").slideDown(100);
		var errorTab = response.split(',');
	    for(var i = 0; i < errorTab.length; i++){
		var subjectTaken = errorTab[i]
		subjectTaken = subjectTaken.trim();
		if(subjectTaken !== ''){
			$("#"+subjectTaken+"-error").slideDown(100);
			var errorTabForBottomLine = subjectTaken.split('-');
			if(errorTabForBottomLine[0] !== ''){
			$("#"+errorTabForBottomLine[0]).css({"borderBottom":"1px solid #f00"});
		}
		}
	}
	}
    fadeLoadForUserWait();
}
function resetForm(){
	$(".errorTriggered, .noErrorTriggered").slideUp(50);
	$(".putMiniShape").css({"borderBottom":"1px solid #dedfde"});
	$('.errorDisplayMini').slideUp(100);
}
function resetFormAndInput(){
	resetForm();
	$(".putMiniShape").val('');
}
function loadForUserWait(){
	$("#messageDisplayLoad").fadeIn(100);
}
function fadeLoadForUserWait(){
	$("#messageDisplayLoad").fadeOut(100);
}
function reloadReq(directAssoc){
	if(directAssoc=="n" || directAssoc=="p"){
	$("#readBoardChapUnikReader").fadeOut(10);
	$("#theWaitingAnnonceBlock").fadeIn(100);
	sendReq('settings/ajax/modif_or_delete_chap.php?q='+_actualChapRequest+'&byN=1&direct='+directAssoc+'&chapId='+directAssoc, funcAfterFetch);
    }
}
function showChaptersList(){
	_ifACtiveReader = true;
	$('html').css({"overflow-y":"hidden"});
	$("#readBoard, #readBoardChapList, #contentBoard").fadeIn(100);
	reshapeScreen();
	$("#header").addClass('fadeBackGround');
}
function hideChaptersList(){
	_ifACtiveReader = false;
	$('html').css({"overflow-y":"auto"});
	$("#theWaitingAnnonceBlock, #readBoardChapUnikReader, #readBoard, #readBoardChapList, #contentBoard").fadeOut(100);
	reshapeScreen();
	$("#chapNumberInside, #chapTitleUnik, #chapUnikContentLine, #chapDateInside").html('');
	$("#chapComAssoc").val('');
}
function scrollToSection(lkClicked){
	var linkToScroll = lkClicked.attr("href");
	if(linkToScroll == "#"){
		linkToScroll = "html"
	}
	$('html, body').animate({
		scrollTop:$(linkToScroll).offset().top
    }, 'slow');
    $('#dashboard').hide(0);
}
function reshapeScreen(){
var screenWidth = $(window).width();
var screenHeight = $(window).height();
var headerHeight = $("#header").outerHeight();
var centerLineHeight = $("#titleBookAnnonce").outerHeight();
var topLineHeight = $("#readerTopAnnonce-list").outerHeight();
var topLineReaderHeight = $("#readerTopAnnonce-unik").outerHeight();
var topWaitLineReaderHeight = $("#readerTopAnnonce-wait").outerHeight();
if(_ifACtiveReader == false){
if($(window).scrollTop() >= (screenHeight-headerHeight)){
	$("#header").addClass('fadeBackGround');
}else{
    $("#header").removeClass('fadeBackGround');	
    }
}
$("#homeDisplay").css({"height":screenHeight+"px"});
$("#reaminingDisplay").css({"marginTop":screenHeight+"px"});
$("#titleBookAnnonce").css({"marginTop":(((screenHeight-centerLineHeight)/2))+"px"});
$("#readerContainer").css({"paddingTop":headerHeight+"px"});
$("#contentBoard").css({"height":(screenHeight-headerHeight)+"px"});
$(".readBoardOnlyContainer").css({"height":(screenHeight-(headerHeight+topLineHeight))+"px"});
$(".theContentDisplayUnikChap").css({"height":(screenHeight-(headerHeight+topLineReaderHeight))+"px"});
$(".theWaitingLoaderGlobal").css({"height":(screenHeight-(headerHeight+topWaitLineReaderHeight))+"px"});
$(".insideContent").css({"top":headerHeight+"px"});
}
function sendReq(url, callBackFunc) {
  var xhttp;
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      callBackFunc(this.response);
    }
 };
  xhttp.open("GET", url, true);
  xhttp.send();
}
function funcAfterFetch(responseTk){
	var responseJson = JSON.parse(responseTk); 
	if(responseJson.error == 0){
		showChaptersList();
		$("#chapNumberInside").html(responseJson.chapter.number);
		$("#chapTitleUnik").html(responseJson.chapter.title);
		$("#chapUnikContentLine").html(responseJson.chapter.content);
		$("#chapDateInside").html(responseJson.chapter.date);
		$("#readBoardChapUnikReader").fadeIn(10,function(){
			reshapeScreen();
			$("#header").addClass('fadeBackGround');
			$("#theWaitingAnnonceBlock").fadeOut(100);
		});
		_actualChapId = responseJson.chapter.id;
		_actualChapRequest = responseJson.chapter.number;
		$("#chapComAssoc").val(_actualChapId);
		$("#chapNbComAssoc").val(_actualChapRequest);
	}else{
	$("#readBoardChapUnikReader").fadeIn(10);
	$("#theWaitingAnnonceBlock").fadeOut(100);
	}

}
function openRequiredForm(formIndexTk){
	switch(formIndexTk){
		case "create":
		$("#recoverUserBox, #connectUserBox").hide(0);
		$("#userBoxRun, #messageDisplayCover, #createUserBox").fadeIn(10);
		$("#userBoxRun").css({"display":"inline-block"}).addClass('shakeBox');
		break;
		case "connect":
		$("#createUserBox, #recoverUserBox").hide(0);
		$("#userBoxRun, #messageDisplayCover, #connectUserBox").fadeIn(10);
		$("#userBoxRun").css({"display":"inline-block"}).addClass('shakeBox');
		break;
		case "recover":
		$("#createUserBox, #connectUserBox").hide(0);
		$("#userBoxRun, #messageDisplayCover, #recoverUserBox").fadeIn(10);
		$("#userBoxRun").css({"display":"inline-block"}).addClass('shakeBox');
		break;
	}
}