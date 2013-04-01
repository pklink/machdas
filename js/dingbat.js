var Dingbat = {
    View:       {},
    Model:      {},
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

    Dingbat.App.$el.appendTo('body');
    Dingbat.App.render();
});