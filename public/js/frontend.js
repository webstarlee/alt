$('.gallery-single-img-a').on('click', function(){
    console.log("hello");
    var current_img = $(this);
    var top_parent = current_img.parent().parent().parent().parent();
    top_parent.find('.gallery-single-img-div').each(function() {
        var $this = $(this);
        if($this.hasClass('active'))
        {
            $this.removeClass('active');
        }
    });

    var current_active_div = current_img.parent();
    current_active_div.addClass('active');
});

$(window).scroll( function() {
    var scroll_top = $(window).scrollTop();
    var window_width = $(window).width();
    var header_height = $('.templatemo-top-menu').outerHeight();
    var menu_height = $('.menu-container-div').outerHeight();
    var fixed_height = menu_height + header_height + 5;

    if (window_width >= 768) {
        if (scroll_top > 100) {
            $('.survey-background-div').css({'height': fixed_height});
        }else {
            $('.survey-background-div').css({'height': '25vh'});
        }
    }else if (window_width < 767 && window_width >= 500) {
        if (scroll_top > 100) {
            $('.survey-background-div').css({'height': fixed_height});
        }else {
            $('.survey-background-div').css({'height': '25vh'});
        }
    }
    else if (window_width < 499) {
        if (scroll_top > 100) {
            $('.survey-background-div').css({'height': fixed_height});
        }else {
            $('.survey-background-div').css({'height': '25vh'});
        }
    }
})
