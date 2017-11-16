$(function () {

  var isFirefox = typeof InstallTrigger !== 'undefined';
    if (isFirefox) {
        $('.login-container').css("height" , "100vh");
    }

  $('body').delegate('#terms-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var temsOfservice = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'terms':temsOfservice},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });

  $('body').delegate('#privacy-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var privacypolicy = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'privacy':privacypolicy},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });
  $('body').delegate('#about-us-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var aboutus = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'aboutus':aboutus},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });

  $('body').delegate('#how-it-work-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var howitwork = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'howitwork':howitwork},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });

  var html = '<button class="btn btn-sm green table-group-action-submit" data-toggle="modal" href="#responsive" style="margin-left:20px;"><i class="fa fa-film"></i> Add</button>';

  $('#sample_2_length').append(html);
});
