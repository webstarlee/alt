$(window).scroll( function() {
    calculator_background_height();
});

$( window ).resize(function() {
    calculator_background_height();
});

$( window ).ready(function() {
    $('.gallery-single-img-a').on('click', function(){
        var current_img = $(this);
        // console.log(current_img[0]);
        var top_parent = current_img.parent().parent().parent().parent();
        top_parent.find('.gallery-single-img-div').each(function() {
            var $this = $(this);
            if($this.hasClass('active'))
            {
                $this.removeClass('active');
            }
        });
        
        var set_session_url = current_img.data('set_url');
        $.ajax({
            url: set_session_url,
            type: 'get',
            success: function(result){
                console.log(result);
            },
            error: function(error){
                console.log(error);
            }
        });

        var current_active_div = current_img.parent();
        current_active_div.addClass('active');
    });

    calculator_background_height();
});

var origine_height = $('.survey-background-div').outerHeight();
var current_scrollTop = $(window).scrollTop();
var stop_scrollTop = 0;

function calculator_background_height() {

    var scroll_top = $(window).scrollTop();
    var window_width = $(window).width();
    var header_height = $('.templatemo-top-menu').outerHeight();
    var menu_height = $('.menu-container-div').outerHeight();
    var fixed_height = menu_height + header_height + 5;
    var current_height = $('.survey-background-div').outerHeight();
    if (current_scrollTop <= scroll_top) {
        if (current_height > fixed_height) {
            var remain_height = origine_height - fixed_height;
            if (scroll_top < remain_height ) {
                var final_height = origine_height - scroll_top;
                $('.survey-background-div').css({'height': final_height});
                stop_scrollTop = scroll_top;
            }else {
                $('.survey-background-div').css({'height': fixed_height});

                stop_scrollTop = remain_height;
            }
        }
    }
    else {
        if (scroll_top < stop_scrollTop) {
            if (scroll_top > 0 ) {
                var decrease_final_height = origine_height - scroll_top;
                $('.survey-background-div').css({'height': decrease_final_height});
                // stop_scrollTop = scroll_top;
            }else {
                $('.survey-background-div').css({'height': origine_height});

                // stop_scrollTop = remain_height;
            }
        }
    }

    current_scrollTop = scroll_top;
}
