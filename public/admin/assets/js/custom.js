$(document).ready(function(){
    $('.scroll-view').mCustomScrollbar({
        autoHideScrollbar: true,
        theme: 'minimal',
        mouseWheel:{ preventDefault: true }
    });
    var num = $(".level-2").length;
    var html = $(".level-2:eq("+(num-1)+")").html();
    for (var i = 0; i < num; i++) {
    	var div = $('.level-2:eq('+i+')');
    	var top = div.parent().offset().top;
    	var height = div.height();
    	var wheight = $("#nav").height();
    	if(wheight<(height+top)){
    		div.css('margin-top','-'+(height+50)+'px');
    		div.css('box-shadow','1px -1px 2px 0px rgba(0,0,0,0.3) inset');
    	};
    }
    $(".level-2 li").mouseover(function(){
    	var ul = $(this).children('ul');
    	if(ul.html())
    	{
    		ul.addClass('active');
    	}
    });
    $(".level-2 li").mouseout(function(){
    	var ul = $(this).children('ul');
    	if(ul.html())
    	{
    		ul.removeClass('active');
    	}
    });
    var footer = $(".footer");
    var footerTop = footer.offset().top;
    var height = footer.height();
    var wheight = $(window).height();
    if(wheight > (footerTop+height)){
        footer.css('position','absolute');
        footer.css('bottom','0px');
    }
});
