$(function() {

    var Tasks = Backbone.Collection.extend({

        model: Selleck.Model.Task,

        url: 'index.php/tasks'

    });


    Selleck.Collection.Tasks = new Tasks();

});

