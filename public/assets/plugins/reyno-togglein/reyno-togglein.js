function reynoToggleIn(param)
{
	var len = $(param+" li").length;
	for (var i = 0; i < len; i++) {
		$(param+" li:eq("+i+")").css('transition-delay',(0.1*i)+"s");
	}
}
function reynoPaginate(param)
{
	var len = $(param+" li").length;
	var limit = $(param).attr('rey-limit');
	var currentPage = $(param).attr('rey-page');
	var height = $(param).attr('rey-height');
	var start = 0;
	var page = Math.ceil(len/limit);
	console.log(currentPage);
	$(".reyno-pagination-page[for='"+param+"']").append(
		'<li class="disabled"><a for="prev" href="javascript:;">Prev</a></li>'
		);
	for (var i = 0; i < page; i++) {
		var k = 0;
		for(var j = i*limit;j<(i+1)*limit;j++)
		{
			$(param+" li:eq("+j+")").css('transition-delay',(0.1*k)+"s").css('margin-top',k*height+'px');
			if(currentPage-1 == i){
				$(param+" li:eq("+j+")").addClass('active');
			}
			k++;
		}
		if(i==currentPage-1){
			$(".reyno-pagination-page[for='"+param+"']").append(
				'<li class="active"><a href="javascript:;" onclick="reynoGoPage(\''+param+'\','+(i+1)+')" page="'+(i+1)+'">'+(i+1)+'</a></li>'
				);
		}else{
			$(".reyno-pagination-page[for='"+param+"']").append(
				'<li><a href="javascript:;" onclick="reynoGoPage(\''+param+'\','+(i+1)+')" page="'+(i+1)+'">'+(i+1)+'</a></li>'
				);
		}
	}
	$(".reyno-pagination-page[for='"+param+"']").append(
		'<li><a href="javascript:;" for="next" onclick="reynoGoPage(\''+param+'\','+(Number(currentPage)+1)+')">Next</a></li>'
		);

}
function reynoGoPage(param,page)
{
	$(param+' li').removeClass('active');
	$(".reyno-pagination-page[for='"+param+"'] li").removeClass('active')
	var len = $(param+" li").length;
	var limit = $(param).attr('rey-limit');
	var page_len = Math.ceil(len/limit);
	for (var i = 0; i < page_len; i++) {
		if(i+1 == page)
		{
			$(".reyno-pagination-page[for='"+param+"'] li a[page='"+(i+1)+"']").parent().addClass('active');
		}
		var k = 0;
		for(var j = i*limit;j<(i+1)*limit;j++)
		{
			if(page-1 == i){
				$(param+" li:eq("+j+")").addClass('active');
			}
			k++;
		}
	}
	if(page == page_len)
	{
		$(".reyno-pagination-page[for='"+param+"'] li a[for='next']").parent().removeAttr('onclick').addClass('disabled');
		$(".reyno-pagination-page[for='"+param+"'] li a[for='prev']").attr('onclick','reynoGoPage(\''+param+'\','+(page-1)+')').parent().removeClass('disabled');
	}else if(page==1)
	{
		$(".reyno-pagination-page[for='"+param+"'] li a[for='prev']").parent().removeAttr('onclick').addClass('disabled');
		$(".reyno-pagination-page[for='"+param+"'] li a[for='next']").attr('onclick','reynoGoPage(\''+param+'\','+(page+1)+')').parent().removeClass('disabled');
	}else{
		$(".reyno-pagination-page[for='"+param+"'] li a[for='next']").attr('onclick','reynoGoPage(\''+param+'\','+(page+1)+')').parent().removeClass('disabled');
		$(".reyno-pagination-page[for='"+param+"'] li a[for='prev']").attr('onclick','reynoGoPage(\''+param+'\','+(page-1)+')').parent().removeClass('disabled');
	}

}
