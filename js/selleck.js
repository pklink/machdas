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

    Selleck.View.App.$el.appendTo('body');
    Selleck.View.App.render();

});