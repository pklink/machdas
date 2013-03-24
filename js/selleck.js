Selleck = {
    View:       {},
    Model:      {},
    Router:     {},
    Collection: {}
};

$(document).foundation();

$(function() {

    $(document).ajaxStart(function() {
        $('#ajax-loader').fadeIn();
    })
    $(document).ajaxComplete(function() {
        $('#ajax-loader').fadeOut();
    });

    new Selleck.View.App();

});