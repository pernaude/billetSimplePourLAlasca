$(function(){


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
})
$(".chapTrackerLk").click(function(){
	var chapIdTk = $(this).attr('id').replace('chap-select-l-','').replace('chap-select-r-','');
	$("#theWaitingAnnonceBlock").fadeIn(10);
	sendReq('settings/ajax/modif_or_delete_chap.php?q='+chapIdTk, funcAfterFetch);
});
$(".menuToFollow").click(function(){
	hideChaptersList();
	scrollToSection($(this));
});
$("#goToChapters").click(function(){
	hideChaptersList();
	showChaptersList();
});
});

function showChaptersList(){
	$('body').css({"overflow-y":"hidden"});
	$("#readBoard, #readBoardChapList, #contentBoard").fadeIn(100);
	reshapeScreen();
	$("#header").addClass('fadeBackGround');
}
function hideChaptersList(){
	$('body').css({"overflow-y":"auto"});
	$("#theWaitingAnnonceBlock, #readBoardChapUnikReader, #readBoard, #readBoardChapList, #contentBoard").fadeOut(100);
	reshapeScreen();
}
function scrollToSection(lkClicked){
	var linkToScroll = lkClicked.attr("href");
	if(linkToScroll == "#"){
		linkToScroll = "html"
	}
	$('html, body').animate({
		scrollTop:$(linkToScroll).offset().top
    }, 'slow');
}
function reshapeScreen(){
var screenWidth = $(window).width();
var screenHeight = $(window).height();
var headerHeight = $("#header").outerHeight();
var centerLineHeight = $("#titleBookAnnonce").outerHeight();
var topLineHeight = $("#readerTopAnnonce-list").outerHeight();
var topLineReaderHeight = $("#readerTopAnnonce-unik").outerHeight();
var topWaitLineReaderHeight = $("#readerTopAnnonce-wait").outerHeight();

if($(window).scrollTop() >= (screenHeight-headerHeight)){
	$("#header").addClass('fadeBackGround');
}else{
    $("#header").removeClass('fadeBackGround');	
    }
$("#homeDisplay").css({"height":screenHeight+"px"});
$("#reaminingDisplay").css({"marginTop":screenHeight+"px"});
$("#titleBookAnnonce").css({"marginTop":(((screenHeight-centerLineHeight)/2))+"px"});
$("#readerContainer").css({"paddingTop":headerHeight+"px"});
$("#contentBoard").css({"height":(screenHeight-headerHeight)+"px"});
$(".readBoardOnlyContainer").css({"height":(screenHeight-(headerHeight+topLineHeight))+"px"});
$(".theContentDisplayUnikChap").css({"height":(screenHeight-(headerHeight+topLineReaderHeight))+"px"});
$(".theWaitingLoaderGlobal").css({"height":(screenHeight-(headerHeight+topWaitLineReaderHeight))+"px"});
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
		$("#chapNumberInside").html(responseJson.chapter.number);
		$("#chapTitleUnik").html(responseJson.chapter.title);
		$("#chapUnikContentLine").html(responseJson.chapter.content);
		$("#chapDateInside").html(responseJson.chapter.date);
		$("#readBoardChapUnikReader").fadeIn(10,function(){
			reshapeScreen();
			$("#header").addClass('fadeBackGround');
			$("#theWaitingAnnonceBlock").fadeOut(100);
		});
	}
}