$(function() {

    Dingbat.Model.Card = Backbone.Model.extend({

        defaults: {
            'name':     ''
        },


        urlRoot: 'api.php/card',


        initialize: function() {
        }

    });

});