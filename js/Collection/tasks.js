$(function() {

    var Tasks = Backbone.Collection.extend({

        model: Selleck.Model.Task,

        url: $('#tasks-url').val()

    });


    Selleck.Collection.Tasks = new Tasks();

});

