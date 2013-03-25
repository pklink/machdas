$(function() {

    Selleck.Model.Task = Backbone.Model.extend({

        defaults: {
            'name'   : '',
            'marked' : false
        },


        urlRoot: $('#task-url').val(),


        validate: function(attributes, options) {
            if (attributes.name.length < 1) {
                return "no task is given";
            }
        }

    });

});