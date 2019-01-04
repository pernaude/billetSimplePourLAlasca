$(function(){

_actualChapRequest = 0;
_actualChapId = 0;
_ifACtiveReader = false;
_menuSmallDisplay = false;
reshapeScreen();
$(window).resize(function(){
	reshapeScreen();
	resetMenuForWideScreen();
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
$(".menuUniBloc a").click(function(){
	resetMenuForWideScreen();
})
$("#back-list-lk, #fadeTrapBox").click(function(){
	hideChaptersList();
});
$("#mobileMenuExpander, #logoLk").click(function(){
	showOrHideMenuForMobile();
});
$("#back-chap-lk").click(function(){
	hideChaptersList();
	showChaptersList();
});
$(".chapTrackerLk").click(function(){
	var chapIdTk = $(this).attr('id').replace(/(chap\-select\-)(last\-)?(l|ll|r|u|c)\-/,'');
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
	hideChaptersList();
	openDashBoard();
	$('html').css({'overflow-y' : 'hidden'});
});
$(document).on('click','.reportThisCommentLk',function(){
	$(".sendCommentForm").slideUp(100);
	var getTheIdOfComment = $(this).attr('id').replace('reportThisCommentLk','sendCommentForm');
	$("#"+getTheIdOfComment).slideDown(100);
});
$(document).on('submit','#contactForm',function(e){
	$(".contactErrorDisplay, .contactNoErrorDisplay").slideUp(100);
	e.preventDefault();
	var inputVal = false;
	$("#contactForm .putShapeAll").each(function(ind){
		if($(this).val().trim() == ''){
			$(".contactErrorDisplay").slideDown(100);
			inputVal = true;
		}
	});
	if(!inputVal){
	$(this).find('.loaderInside').fadeIn(100);	
	var formIdTk = $(this).attr("id");
	var dataInForm = $(this).serialize();
	sendRequestToServer(formIdTk, dataInForm);

	}
});
$(document).on('submit','.sendCommentForm',function(e){
	e.preventDefault();
	if(_getUserAct){
	var getTheIdOfComment = parseInt($(this).attr('id').replace('sendCommentForm-',''));
	var getReportText = $(this).find('textarea').val().trim();
	if(getTheIdOfComment > 0 && getReportText.length > 2){
	    $(this).find('.loaderForReportSent').css({'display':'inline-block'});
	    $(this).parent().find('.loaderFloawSet').fadeIn(0);
	    sendReq('settings/ajax/modif_or_delete_chap.php?reportId='+getTheIdOfComment+'&reportContent='+getReportText, sendReport);
    }
    }else{
    	alert('Vous devez être connecté pour signaler un commentaire');
    }

});
$(document).on('submit','#passUpdateForm',function(e){
    e.preventDefault();
	if(_getUserAct){		
	var formIdTk = $(this).attr("id");
	var dataInForm = $(this).serialize();
	resetFormShape(formIdTk);
	sendRequestToServer(formIdTk, dataInForm);
	}
});
$(document).on('click', "#updatePicButt",function(e){
	$("#pic").trigger("click");
});
$("#pic").change(function(e){
	$("#picChangerForm").submit();
	loadImg(e, "dpDisplaySrc", "picChangerForm");
});
$("#profilePicCover").click(function(e){
	$("#picDisplayBox").fadeIn(100);
});
$(".quitTriggerBg").click(function(e){
	$("#picDisplayBox").fadeOut(100);
});
$(document).on("click",".leaveReport",function(e){
	$(".sendCommentForm").slideUp(100);
	$(".sendCommentForm textarea").val('');
});
$("#picChangerForm").submit(function(e){
	$(".waitingForceLoader").fadeIn(0);
	var formIdTk = $(this).attr("id");
	var dataInForm = new FormData($(this)[0]);
	$.ajax({
        url         : '',
        data        : dataInForm ? dataInForm : $(this).serialize(),
        cache       : false,
        contentType : false,
        processData : false,
        type        : 'POST',
        success     : function(data, textStatus, jqXHR){
            // Callback code
            var dataConvert = JSON.parse(data);
            if(dataConvert.error == 0){
            $("#picContainerDisplay .waitingForceLoader").hide(0);
            $("#picContainerDisplay .annonceDoneSuccess").html('Photo changé avec succès').fadeIn(100).animate({top : "50px"}, 1000).delay(2000).fadeOut(100);
            if(dataConvert.pic !== ''){
            	$("#profilePicCover img").attr("src","src/images/users/squared/"+dataConvert.pic);
            }
        }
    }
    });
	e.preventDefault();
});
});
function loadImg(evt, loadBox, formIdGot) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById(loadBox).src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    }
}
function resetFormShape(formName){
	$("#"+formName+" .waitingForceLoader").fadeIn(100);
	resetForm();
}
function sendReport(responseGet){
	var responseJson = JSON.parse(responseGet);
    if(responseJson.error !== "undefined" && responseJson.report_id !== "undefined" && responseJson.error == 0 && responseJson.report_id > 0){
    	$("#sendCommentForm-"+responseJson.report_id).find('.loaderForReportSent').css({'display':'none'});
	    $("#sendCommentForm-"+responseJson.report_id).parent().find('.loaderFloawSet').fadeOut(0);
	    $("#sendCommentForm-"+responseJson.report_id).find('textarea').val('');
	    $("#nbCommentAssocOnIt").html(parseInt($("#nbCommentAssocOnIt").html())-1);
	    $("#commentLine-"+responseJson.report_id).html("<div class='successReturnReported'>Votre remarque a bien été pris en compte</div>").fadeIn(1000).delay(3000).fadeOut(1000);
    }
}
function showOrHideMenuForMobile(){
	if(_menuSmallDisplay){
		_menuSmallDisplay = false;
		$("#menuWrapper").fadeOut(100);
		$("html").css({"overflow-y":"auto"});
	}else{
		_menuSmallDisplay = true;
		$("#menuWrapper").fadeIn(100);
		$("html").css({"overflow-y":"hidden"});
	}
}
function resetMenuForWideScreen(){
	_menuSmallDisplay = false;
	$("html").css({"overflow-y":"auto"});
	if($(window).width() > 768){
		$("#menuWrapper").fadeIn(100);
	}else{
		$("#menuWrapper").fadeOut(100);
	}
}
function openDashBoard(){
	$('html').css({"overflow-y":"auto"});
	$("#dashboard").fadeIn(500);
}
function sendRequestToServer(formSetName, dataInForm){
	$.ajax({
    type: 'POST',
    url: $("#"+formSetName).attr('action'),
    data: dataInForm
}).done(function(response){
	if(formSetName == 'commentAddingForm'){
		actionAjaxComment(0, response, formSetName);
	}else if(formSetName == 'contactForm'){
		$("#"+formSetName).find('.loaderInside').fadeOut(100);
		$("#"+formSetName).find('.putShapeAll').val('');
        $(".contactNoErrorDisplay").slideDown(100);
	}else if(formSetName == 'picChangerForm'){
		alert(response);
		$("#picContainerDisplay .waitingForceLoader").fadeOut(100);
	}else{
		actionAjaxSuite(0, response, formSetName);
	}
}).fail(function(data){
	if(formSetName == 'commentAddingForm'){
		actionAjaxComment(1, data.responseText, formSetName);
	}else if(formSetName == 'contactForm'){
		$("#"+formSetName).find('.loaderInside').fadeOut(100);
		$("#"+formSetName).find('.putShapeAll').val('');
        $("#"+formSetName).find(".contactErrorDisplay").slideDown(100);
	}else if(formSetName == 'picChangerForm'){
		$("#"+formSetName).find(' ~ .waitingForceLoader').fadeOut(100);
	}else{
		actionAjaxSuite(1, data.responseText, formSetName);
	}
});
}
function actionAjaxComment(ifError, response, formSetName){
    if(ifError == 0){
    	$("#noErrorTopComment").slideDown(100);
    	$(".waitingForceLoader").fadeOut(100);
    	$("#commentSent").val('');
    }
	}
function actionAjaxSuite(ifError, response, formSetName){
	$("#"+formSetName+" .waitingForceLoader").fadeOut(100);
	if(ifError == 0){
	$("#"+formSetName+" .putMiniShape").val('');
	if(formSetName == "createUserForm"){
	$("#noErrorTopCreate").slideDown(100);
	openRequiredForm("connect");
    }
    if(formSetName == "connectUserForm"){
    	window.location = "";
    }
    if(formSetName == "passUpdateForm"){
    	$("#passUpdateForm .noErrorTriggered").slideDown(100);
    }
    if(formSetName == "recoverUserForm"){
    	$("#"+formSetName+" .noErrorTriggered").slideDown(100);
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
		$("#nbCommentsDisplay").html('0 Commentaire');
		if(responseJson.comments.length !== "undefined"){
		if(responseJson.comments.length > 1){
		$("#nbCommentsDisplay").html('<span id="nbCommentAssocOnIt">'+responseJson.comments.length+'</span> commentaires');
	    }else if(responseJson.comments.length == 1){
	    $("#nbCommentsDisplay").html('<span id="nbCommentAssocOnIt">'+responseJson.comments.length+'</span> commentaire');
	    }
	    $("#commentStream").html('');
	    if(responseJson.comments.length > 0){
	    	for (i in responseJson.comments) {
	    		var commentIdActu = responseJson.comments[i]['comment_id'];
	    		var commentAuthorActu = responseJson.comments[i]['user_pseudo'];
	    		var commentContentActu = responseJson.comments[i]['comment_content'];
               var commentDateActu = responseJson.comments[i]['comment_add_date'];
               var commentDpActu = responseJson.comments[i]['user_dp'];
               $("#commentStream").append("<div class='commentLine' id='commentLine-"+commentIdActu+"'><div class='picOnlyCoverMini'><img src='"+commentDpActu+"' alt='Photo de profil'/></div><div class='arrangeRightCommentContent'><form method= 'post' class='sendCommentForm' id='sendCommentForm-"+commentIdActu+"'><div class='loaderFloawSet'></div><textarea class='commentTextArea' name='commentTextAreaNm' placeholder='Pourquoi signalez-vous ce commentaire?'></textarea><span class='leaveReport'><i class='fas fa-arrow-left'></i></span><span class='loaderForReportSent'></span><input type='submit' class='sendCommentButt' value='Signaler le commentaire'/></form><h4 class='commentAuthorHeader'><span class='nameOnlyLine'>"+commentAuthorActu+"</span><span class='dateOnlyLine'>"+commentDateActu+"</span> &nbsp; <a href='javascript:void(0);' class='reportThisCommentLk' id='reportThisCommentLk-"+commentIdActu+"'><i class='fas fa-flag'></i> <span class='hiddenRep'>Signaler</span></a></h4><p class='commentContentSort'>"+commentContentActu+"</p></div><div class='clear'></div></div>");
            };
	    }
	    }
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