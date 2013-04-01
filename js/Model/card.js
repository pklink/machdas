$(function() {
    'use strict';

    Dingbat.Model.Card = Backbone.Model.extend({

        defaults: {
            'name':     ''
        },


        urlRoot: 'api.php/card',


        /**
         * @type {Dingbat.View.Card}
         */
        view: null

    });

});