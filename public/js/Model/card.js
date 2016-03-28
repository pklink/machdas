$(function() {
    'use strict';

    Dingbat.Model.Card = Backbone.Model.extend({

        defaults: {
            'name':     ''
        },


        urlRoot: 'api/index.php/cards',


        /**
         * @type {Dingbat.View.Card}
         */
        view: null,


        validate: function(attributes) {
            if (attributes.name.length < 1) {
                return "no name is given";
            }
        }

    });

});