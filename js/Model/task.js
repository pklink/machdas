$(function() {

    Selleck.Model.Task = Backbone.Model.extend({

        defaults: {
            'name'   : '',
            'marked' : false
        },


        events: {
            'sync': 'alert'
        },

        urlRoot: $('#form').attr('action'),

    });

});