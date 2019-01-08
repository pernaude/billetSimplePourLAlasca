$(function(){


$("#menuSelect-1-container").fadeIn(200);
$("#actualMenuShow").click(function(){
	$("#admin-header").fadeIn(200);
	$("#menuSingleBloc").animate({left:"0"}, 500);
});

$(".menusetLk, .menusetBigLk").click(function(){
	var attrFetch = $(this).attr("id").replace('Big','');
	$("#screenShow").html($("#"+attrFetch).html());
	$(".boxPartUnik").hide(0,function(){
		adminResetForm();
		if(parseInt(attrFetch.replace('menuSelect-', '')) == 2){
		$("#hiddenActOnChapOnForm").val('a');
		$("#hiddenUpdateChap").val(0);	
	}
	$("#"+attrFetch+"-container").fadeIn(200);
	});
	closeMenu();
});
$("#sortFortForClose, #closeButtShow").click(function(){
	closeMenu(); 
});

  tinymce.init({
    selector: '#editContent',
    height : "350"
  });

$("#form-add-chapter").submit(function(e){
	e.preventDefault();
	adminResetForm();
	var form = $(this);
	var dataInForm = $(this).serialize();
	showLoading();
	sendRequestToServerAdmin("form-add-chapter", dataInForm, "form");
});
$("#form-add-user").submit(function(e){
	e.preventDefault();
	adminResetForm();
	var form = $(this);
	var dataInForm = $(this).serialize();
	showLoading();
	sendRequestToServerAdmin("form-add-user", dataInForm, "form");
});

$(".putDisplayNeet").keyup(function(){
	adminResetForm();
});


$(".actionOnChap").click(function(){

triggerActionOnChap($(this));

});

$(".actionConfirmButt").click(function(){
	cancelAction();
});

$(".lineDisplayReportLk").click(function(){
$(".bottomReportOpenerBox").slideUp(100);
$(this).find("~ .bottomReportOpenerBox").slideDown(100);
});

$(".actionReportButt").click(function(){
	if($(this).hasClass("deleteActionOnComment")){
		var commentIdGot = parseInt($(this).attr("id").replace("deleteThisCommentButt-", ""));
		var actOnCom = "d";
	}else if($(this).hasClass("cancelActionOnComment")){
		var commentIdGot = parseInt($(this).attr("id").replace("cancelThisCommentReportButt-", ""));
		var actOnCom = "c";
	}
	if(commentIdGot !== "undefined" && commentIdGot !== "IsN"){
        sendReq('settings/ajax/modif_or_delete_chap.php?act='+actOnCom+'&comId='+commentIdGot, afterGetRequest);
	}
});


$("#adminConnectUserForm").submit(function(e){
	$("#picDisplayBox .waitingForceLoader").fadeIn(0);
	var formIdTk = "adminConnectUserForm";
	var dataInForm = new FormData($(this)[0]);
	$.ajax({
        url         : '',
        data        : dataInForm ? dataInForm : $(this).serialize(),
        cache       : false,
        contentType : false,
        processData : false,
        type        : 'POST',
        success     : function(data, textStatus, jqXHR){
            window.location = "";
    },
    error : function(xhr){
    	$("#adminConnectUserForm .waitingForceLoader").fadeOut(100);
    	$("#adminConnectUserForm .errorTriggered").slideDown(100);
    	var errorTab = xhr.responseText.split(',');
	    for(var i = 0; i < errorTab.length; i++){
		var subjectTaken = errorTab[i]
		subjectTaken = subjectTaken.trim();
		if(subjectTaken !== ''){
			$("#"+subjectTaken+"-error").slideDown(100);
			var errorTabForBottomLine = subjectTaken.split('-');
			if(errorTabForBottomLine[0] !== ''){
			$("#"+errorTabForBottomLine[0]).css({"borderBottom":"1px solid #f00"});
		}
    	console.log(xhr.responseText);
    }
    }
}
    });
	e.preventDefault();
});
})



function afterGetRequest(responseGot){
	var resPonseGotTriggered = JSON.parse(responseGot);
	var resultUnknown = false;
	if(resPonseGotTriggered.error !== "undefined"){
		if(resPonseGotTriggered.error == 0){
			if(resPonseGotTriggered.act == "d"){
				var msgToShow = "Commentaire supprimé avec succès";
			}else if(resPonseGotTriggered.act == "c"){
				var msgToShow = "Commentaire réaffiché avec succès";
            }
            showActionMessage('success', msgToShow, true, "lineSHowReported-"+resPonseGotTriggered.report_comment_id, "nbReportedComment");
		}else{
			var resultUnknown = true;
		}
	}else{
			var resultUnknown = true;
		}

	if(resultUnknown){
		showActionMessage('error');
	}
}
function adminResetForm(){
	$(".errorGet, .noErrorCl").slideUp(50);
	$(".putDisplayNeet").css({"borderBottom":"1px solid #c0c0c0"});
}

function sendRequestToServerAdmin(formSetName, dataInForm, placeAction){
	$.ajax({
    type: 'POST',
    url: $("#"+formSetName).attr('action'),
    data: dataInForm
}).done(function(response){
	if(placeAction == "form"){
		actionAjaxSuiteAdmin(0, response, formSetName);
	}

}).fail(function(data){
	if(placeAction == "form"){
		actionAjaxSuiteAdmin(1, data.responseText, formSetName);
	}

});

}
function showLoading(){
	$("#messageDisplayCover, #messageDisplayLoad").fadeIn(100);
}
function fadeLoading(){
	$("#messageDisplayCover, #messageDisplayLoad").fadeOut(10);
}
function sendReqOnServ(url, callBackFunc) {
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
function actionAjaxSuiteAdmin(ifError, response, formSetName){
	if(ifError == 0){
		$("#"+formSetName+" .noErrorCl").slideDown(100);
	$("#"+formSetName+" .putDisplayNeet").val('');
	$("#hiddenActOnChapOnForm").val('a');
		$("#hiddenUpdateChap").val(0);
	tinymce.get("editContent").setContent('');
	}else if(ifError == 1){
			var errorTab = response.split('-');
	for(var i = 0; i < errorTab.length; i++){
		var subjectTaken = errorTab[i]
		subjectTaken = subjectTaken.trim();
		if(subjectTaken !== ''){
			$("#"+subjectTaken).css({"borderBottom":"1px solid #f00"});
			$("#"+subjectTaken+"-error").slideDown(100);
		}
	}
	}
	fadeLoading();

}
function closeMenu(){
	$("#menuSingleBloc").animate({left:"-100%"}, 500,function(){
		$("#admin-header").fadeOut(200);
	});
}
function showAction(actionStart, userOrChap, idAction){
	if($("#messageDisplayConfirm").hasClass("shakeBox")){
		$(this).removeClass("shakeBox");
	}
	
	if(actionStart == "modif"){
		showLoading();
		sendReq("settings/ajax/modif_or_delete_chap.php?q="+idAction, performBack);
	}else if (actionStart == "suppr") {
		if(userOrChap == "user"){
			$("#msg-user").show(0);
		}else if (userOrChap == "chap"){
			$("#msg-chap").show(0);
		}
	$("#messageDisplayCover").fadeIn(100);
	$("#messageDisplayConfirm").css({"display" : "inline-block"}).addClass("shakeBox");
	}
}
function performBack(reponseGot){
	console.log(reponseGot);alert(reponseGot);
	fadeLoading();
}
function cancelAction(){
	$("#messageDisplayCover, #messageDisplayConfirm, .actionMessage").fadeOut(100);
}
function triggerActionOnChap(actTaken){

	var chapIdGot = parseInt(actTaken.attr('id').replace('act-assoc-',''));
	if(chapIdGot !== "NaN" && chapIdGot > 0){
	    if(actTaken.hasClass('actionButtSingle-modif')){
		    var actOnChapUpdate = "m";
	    }else if(actTaken.hasClass('actionButtSingle-del')){
		    var actOnChapUpdate = "d";
	    }

	    if(chapIdGot !== "undefined"){
        sendReq('settings/ajax/modif_or_delete_chap.php?actOnChap='+actOnChapUpdate+'&chapUpdateId='+chapIdGot, traitChapEdit);
	}
    }

    

}

function showActionMessage(msgType, msg = '', ifHideBlock = false, lineToHide = '', countContenerId = ''){
	$("#messageDisplayActionCallbackResponse, #callBackMessageDisplay-noerror, #callBackMessageDisplay-error").clearQueue();
	$("#messageDisplayActionCallbackResponse").css({"top" : "200px"});
	if (msgType == 'error') {
		$("#callBackMessageDisplay-error").html("Impossible d'effectuer cet action").css({"display" : "inline-block"});
		$("#messageDisplayActionCallbackResponse").fadeIn(100).animate({top : '50px'}, 1000).delay(2000).fadeOut(100,function(){$("#callBackMessageDisplay-error").html('').hide(0);$("#messageDisplayActionCallbackResponse").css({"top" : "200px"});});
	}else if(msgType == 'success'){
		$("#callBackMessageDisplay-noerror").html(""+msg+"").css({"display" : "inline-block"});
        $("#messageDisplayActionCallbackResponse").fadeIn(100).animate({top : '50px'}, 1000).delay(2000).fadeOut(100,function(){$("#callBackMessageDisplay-noerror").html('').hide(0);$("#messageDisplayActionCallbackResponse").css({"top" : "200px"});});
        if(ifHideBlock){
        	if(lineToHide.trim() !== ''){
        	$("#"+lineToHide.trim()).fadeOut(100);
        }
        }
        if(countContenerId.trim() !== ''){
        var getOldNumberCount = parseInt($("#"+countContenerId.trim()).html());
			if(getOldNumberCount !== "NaN" && getOldNumberCount > 0){
				getOldNumberCount --;
				$("#"+countContenerId.trim()).html(getOldNumberCount);
			}
		}
	}
}
function traitChapEdit(responseGet){
	responJsoned = JSON.parse(responseGet);
	if(responJsoned.error !== "undefined"){
		if(responJsoned.error == 0){
			if(responJsoned.act == "d"){
            showActionMessage('success', 'Chapitre supprimé avec succès', true, "lineWrapperDisplay-"+responJsoned.chap_id, "nbChapExists");
            }else if(responJsoned.act == "m"){
            	adminResetForm();
            	$("#hiddenActOnChapOnForm").val("u");
            	$("#hiddenUpdateChap").val(responJsoned.chap_id);	
            	$("#editChapNumber").val(responJsoned.chapContent.number);
            	$("#editTitleChap").val(responJsoned.chapContent.title);
            	tinymce.get("editContent").setContent(responJsoned.chapContent.content);
            	$(".boxPartUnik").hide(0,function(){
		        $("#menuSelect-2-container").fadeIn(200);
	            });
            	
            }
    }else{
        	showActionMessage('error');
        }
    }else{
        	showActionMessage('error');
        }
}