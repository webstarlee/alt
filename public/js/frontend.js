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
})
$('.survey-select-number').each(function() {
    var $this = $(this);
    $(this).on('click', function(e) {
        // var pos_top = $(this).offsetX;
        // console.log($this.position());
        var eTop = $this.offset().top; //get the offset top of the element
        console.log(eTop - $(window).scrollTop());
    })
})
