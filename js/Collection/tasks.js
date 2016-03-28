$(function() {
    'use strict';

    Dingbat.Collection.Tasks = Backbone.Collection.extend({

        model: Dingbat.Model.Task,

        /**
         * @param {Dingbat.Model.Task} model
         * @returns {*}
         */
        comparator: function(model) {
            if (model.get('priority') == 'normal') {
                return 0;
            }
            else if (model.get('priority') == 'high') {
                return 1;
            }
            else {
                return -1;
            }
        },

        url: 'api/index.php/tasks'

    });

});

