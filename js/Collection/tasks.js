$(function() {
    'use strict';

    var Tasks = Backbone.Collection.extend({

        model: Dingbat.Model.Task,

        url: 'api.php/tasks'

    });


    Dingbat.Collection.Tasks = new Tasks();

});

