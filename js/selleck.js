Selleck = {
    View:       {},
    Model:      {},
    Router:     {},
    Collection: {}
};

$(document).foundation();

$(function() {

    $(document).ajaxStart(function() {
        $('#ajax-load').fadeIn();
    })
    $(document).ajaxComplete(function() {
        $('#ajax-load').fadeOut();
    });

    new Selleck.View.App();

});