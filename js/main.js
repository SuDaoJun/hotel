$(function(){
	// 轮播
	$(".page>ul>li").click(function() {
		 $(this).addClass("active").siblings().removeClass("active");
		 var index = $(this).index();
		 i=index;
		 $(".main-slider>ul>li").eq(index).fadeIn(1000).siblings().fadeOut(1000);
	});
	var i = 0;
	var size=$(".page>ul>li").size();
	var t = setInterval(move, 5000);
	function move() {
	    i++;
	    if (i == size) {
	        i = 0;
	    }
	    $(".page>ul>li").eq(i).addClass("active").siblings().removeClass("active");
	    $(".main-slider>ul>li").eq(i).fadeIn(1000).siblings().fadeOut(1000);
	}
	//回到顶部
	$('.go-up-box').on('click',function(){
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
    });
    
})
