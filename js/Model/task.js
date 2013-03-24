$(function() {

    Selleck.Model.Task = Backbone.Model.extend({

        defaults: {
            'name'   : '',
            'marked' : false
        },


        urlRoot: $('#add-task').attr('action'),


        validate: function(attributes, options) {
            if (attributes.name.length < 1) {
                return "no task is given";
            }
        }

    });

});