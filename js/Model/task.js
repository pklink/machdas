$(function() {

    Selleck.Model.Task = Backbone.Model.extend({

        defaults: {
            'name'   : '',
            'marked' : false
        },


        urlRoot: $('#add-task').attr('action')

    });

});