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
        view: null,


        validate: function(attributes, options) {
            if (attributes.name.length < 1) {
                return "no name is given";
            }
        }

    });

});