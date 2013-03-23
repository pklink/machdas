$(function() {

    Selleck.Model.Task = Backbone.Model.extend({

        events: {
            'sync': 'alert'
        },

        defaults: {
            'name'   : '',
            'marked' : false
        },

        urlRoot: $('#form').attr('action'),

        alert: function() {
            alert('asdasd#');
        }

    });

});