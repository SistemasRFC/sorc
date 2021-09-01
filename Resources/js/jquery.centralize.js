$.fn.centralize = function(){
	v_width  = $("body").width();
	v_height = $("body").height();
	v_top = ((v_height/2)-($(this).height()/2));
	v_left= ((v_width/2)-($(this).width()/2));
	$(this).css({left:v_left,top:v_top});
	window.scrollTo(0,0);
}

$.fn.janela = function(data){
	$(this).hide();
	$(this).centralize();
	$(this).fadeIn(3000);
}