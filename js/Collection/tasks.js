$(function() {
    'use strict';

    Dingbat.Collection.Tasks = Backbone.Collection.extend({

        model: Dingbat.Model.Task,

        url: 'api.php/tasks'

    });

});

