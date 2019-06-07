
var windowh = $(window).height();

$("document").ready(function(){
	resizeW();
	reynoToggleIn('#consulting');
	reynoToggleIn('#cyber');
	reynoToggleIn('#security');
	reynoToggleIn('#products');
	// Menu
	$("#service").click(function()
	{
		var data = $(this).attr('data-toggle');
		var target = $(this).attr('data-target');
		if(data == 0)
		{
			$(this).attr('data-toggle',1);
			$(this).addClass('active');
			$("ul.level[target='"+target+"']").addClass('active');
		}else{
			$(this).attr('data-toggle',0);
			$(this).removeClass('active');
			$("ul.level[target='"+target+"']").removeClass('active');
		}
	});
	$(".hide-service").click(function(){
		var data = $("#service").attr('data-toggle');
		var target = $("#service").attr('data-target');
		if(data != 0)
		{
			$("#service").attr('data-toggle',0);
			$("#service").removeClass('active');
			$("ul.level[target='"+target+"']").removeClass('active');
		}
	});
	$("ul.level li").on("mouseover",function(){
		$(this).children('ul.level').addClass('active');
	}).on("mouseout",function(){
		$(this).children('ul.level').removeClass('active');
	});

	// Scroll To Animation
	//-------------------------------------------------------------------------------

	var scrollTo = $(".scroll-to");

	scrollTo.click( function(event) {
		$('.modal').modal('hide');
		var position = $(document).scrollTop();
		var scrollOffset = 100;

		var marker = $(this).attr('href');
		$('html, body').animate({ scrollTop: $(marker).offset().top - scrollOffset}, 'slow');

		return false;
	});

	$(".next").click(function(){
		var target = $(this).attr('data-target');
		var dataLength = Number($(this).attr('data-length'));
		var page = Number($(target).attr('page'));
		var max = Number($(target).attr('max'));
		if(page<max){
			$(target).attr('page',page+1);
			$(target).css('margin-left','-'+dataLength*(page+1)+'%');
			$(target).children().children('.con-img').removeClass('animated').removeClass('wobble');
		}else{
			$(target).children().children('.con-img').addClass('animated').addClass('wobble');
		}
	});
	$(".prev").click(function(){
		var target = $(this).attr('data-target');
		var dataLength = Number($(this).attr('data-length'));
		var page = Number($(target).attr('page'));
		var max = Number($(target).attr('max'));
		if(page>0){
			$(target).attr('page',page-1);
			$(target).css('margin-left','-'+dataLength*(page-1)+'%');
			$(target).children().children('.item').removeClass('animated').removeClass('wobble');
		}else{
			$(target).children().children('.item').addClass('animated').addClass('wobble');
		}
	});

	$("#menu-mob").click(function(){
		var data = $(this).attr('data-toggle');
		if(data == 0)
		{
			$(this).attr('data-toggle',1);
			$("#header1").addClass('active');
		}else{
			$(this).attr('data-toggle',0);
			$("#header1").removeClass('active');
		}
	});

});
$(window).resize(function(){
	resizeW();
});
$(window).scroll(function(){
	var scw = $(window).scrollTop();
	var num = $("#header1 .menu-contain li").length;
	for (var i = 0; i < num; i++) {
		var location = $("#header1 .menu-contain li a:eq("+i+")").attr("href");
		if(i+1 == num){
			var location2 = $(location).offset().top + $(location).height();
		}else{
			var location2 = $("#header1 .menu-contain li a:eq("+(i+1)+")").attr("href");
			location2 = $(location2).offset().top-300;
		}
		if(scw >= $(location).offset().top-300 && scw < location2)
		{
			$("#header1 .menu-contain li a:eq("+i+")").parent('li').addClass('active');
		}else{
			$("#header1 .menu-contain li a:eq("+i+")").parent('li').removeClass('active');
		}
	};
	if(windoww > 1000){
		if(scw+150 >= windowh){
			$("#header1").addClass('active');
			$("#header2").fadeOut();
		}else{
			$("#header2").show();
			$("#header1").removeClass('active');
		}		
	}
	// parallax
	var sctop = $("#blogs").offset().top;
	$("#blogs").css("background-position","0px -"+(scw-sctop+500)/2+"px");
});
function resizeW() {
	windowh = $(window).height();
	windoww = $(window).width();
	$("#space-header").css('margin-top',windowh+'px');
	if(windoww < 1000)
	{
		$("#header1").addClass('active');
	}
}
function searchActive(){
	var data = $("#search input[type='text']").val();
	if(data != "")
	{
		$("#search").attr('data-toggle',1);
		$("#search").addClass("active");
	}else{
		$("#search").attr('data-toggle',0);
		$("#search").removeClass("active");
	}
}