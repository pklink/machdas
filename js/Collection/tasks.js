$(function() {
    'use strict';

    Dingbat.Collection.Tasks = Backbone.Collection.extend({

        model: Dingbat.Model.Task,

        /**
         * @param {Dingbat.Model.Task} model
         * @returns {*}
         */
        comparator: function(model) {
            return model.get('priority');
        },

        url: 'api.php/tasks'

    });

});

