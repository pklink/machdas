$(function() {

    var Tasks = Backbone.Collection.extend({

        model: Selleck.Model.Task,

        url: 'api.php/tasks'

    });


    Selleck.Collection.Tasks = new Tasks();

});

