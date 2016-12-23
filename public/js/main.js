$(document).ready(function() {

    $('select.dropdown').dropdown();
    /*$.fn.api.settings.api = {
        'create article' : '/articles/create',
        'add comment' : '/comment/{slug}'
    };
    */



    $('.messages').show().transition({
        animation  : 'fade',
        duration   : '3s'
    }).transition({
        animation  : 'fade',
        duration   : '3s',
        onComplete : function() {
            $(this).remove();
        }

    });


});