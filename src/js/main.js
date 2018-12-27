$(function(){


reshapeScreen();



$(window).resize(function(){
	reshapeScreen();
})
});


function reshapeScreen(){
var screenWidth = $(window).width();
var screenHeight = $(window).height();
var headerHeight = $("#header").height();
var centerLineHeight = $("#titleBookAnnonce").height();

$("#homeDisplay").css({"height":screenHeight+"px"});
$("#reaminingDisplay").css({"marginTop":screenHeight+"px"});
$("#titleBookAnnonce").css({"marginTop":(((screenHeight-centerLineHeight)/2)+20)+"px"});
}