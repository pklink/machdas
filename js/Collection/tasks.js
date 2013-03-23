$(function() {

    var Tasks = Backbone.Collection.extend({

        model: Selleck.Model.Task,

        url: function() {
            return $('#tasks-url').val();
        }

    });

    Selleck.Collection.Tasks = new Tasks();

});

