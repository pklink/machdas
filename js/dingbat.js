var Dingbat = {
    View:       {},
    Model:      {},
    Router:     {},
    Collection: {}
};

$(function() {
    'use strict';

    $(document).ajaxStart(function() {
        $('#ajax-loader').fadeIn();
    })
    $(document).ajaxComplete(function() {
        $('#ajax-loader').fadeOut();
    });

    Dingbat.View.App.$el.appendTo('body');
    Dingbat.View.App.render();
});