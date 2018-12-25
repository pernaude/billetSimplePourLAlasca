$(function(){


$("#menuSelect-1-container").fadeIn(200);
$("#actualMenuShow").click(function(){
	$("#header").fadeIn(200);
	$("#menuSingleBloc").animate({left:"0"}, 500);
});

$(".menusetLk, .menusetBigLk").click(function(){
	var attrFetch = $(this).attr("id").replace('Big','');
	$("#screenShow").html($("#"+attrFetch).html());
	$(".boxPartUnik").hide(0,function(){
		resetForm();
		$("#"+attrFetch+"-container").fadeIn(200);
	});
	closeMenu();
});
$("#sortFortForClose, #closeButtShow").click(function(){
	closeMenu(); 
});

  tinymce.init({
    selector: '#editContent'
  });

$("#form-add-chapter").submit(function(e){
	e.preventDefault();
	resetForm();
	var form = $(this);
	var dataInForm = $(this).serialize();
	showLoading();
	sendRequestToServer("form-add-chapter", dataInForm, "form");
});
$("#form-add-user").submit(function(e){
	e.preventDefault();
	resetForm();
	var form = $(this);
	var dataInForm = $(this).serialize();
	showLoading();
	sendRequestToServer("form-add-user", dataInForm, "form");
});

$(".putDisplayNeet").keyup(function(){
	resetForm();
});


$(".actionOnChap").click(function(){

triggerActionOnChap($(this));

});

$(".actionConfirmButt").click(function(){
	cancelAction();
});




})

function resetForm(){
	$(".errorGet, .noErrorCl").slideUp(50);
	$(".putDisplayNeet").css({"borderBottom":"1px solid #c0c0c0"});
}

function sendRequestToServer(formSetName, dataInForm, placeAction){
	$.ajax({
    type: 'POST',
    url: $("#"+formSetName).attr('action'),
    data: dataInForm
}).done(function(response){
	if(placeAction == "form"){
		actionAjaxSuite(0, response, formSetName);
	}

}).fail(function(data){
	if(placeAction == "form"){
		actionAjaxSuite(1, data.responseText, formSetName);
	}

});

}
function showLoading(){
	$("#messageDisplayCover, #messageDisplayLoad").fadeIn(100);
}
function fadeLoading(){
	$("#messageDisplayCover, #messageDisplayLoad").fadeOut(10);
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
function actionAjaxSuite(ifError, response, formSetName){
	if(ifError == 0){
		$("#"+formSetName+" .noErrorCl").slideDown(100);
	$("#"+formSetName+" .putDisplayNeet").val('');
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
		$("#header").fadeOut(200);
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
	var idFetch = actTaken.attr('id').replace('act-assoc-','');
	if(parseInt(idFetch) > 0){
	    if(actTaken.hasClass('actionButtSingle-modif')){
		    showAction("modif", "chap", idFetch);
	    }else if(actTaken.hasClass('actionButtSingle-del')){
		    showAction("suppr", "chap", idFetch);
	    }
    }

}