function preview_film(url) {
    var film_height_set = $('#film_preview').outerWidth();

    $('.film-embeded-div').css('height',film_height_set/4*3);

    var html_iframe = '<iframe width="100%" height="100%" class="film-embedded-video" src=" ' + url +'?rel=0&amp;amp;showinfo=0&amp;autoplay=1&amp;loop=0" frameborder="0" allowfullscreen></iframe>';

    $('.film-embeded-div').html(html_iframe);

}
function break_video() {
    var html_iframe = '<iframe width="100%" height="100%" class="film-embedded-video" src="" frameborder="0" allowfullscreen></iframe>';
    $('.film-embeded-div').html(html_iframe);
}
