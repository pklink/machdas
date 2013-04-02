$(function() {
    'use strict';

    Dingbat.Collection.List = Backbone.Collection.extend({

        model: Dingbat.Model.Task,


        /**
         * @param {Dingbat.Model.Task} task
         */
        addTask: function(task) {
            this.add(task);
        },


        /**
         * @param {Dingbat.Model.Task} model
         * @returns {*}
         */
        comparator: function(model) {
            return model.get('priority');
        },


        /**
         *
         * @param {Dingbat.View.Card} card
         */
        refresh: function(card) {
            var oldTasks = this.toArray();
            var newTasks = Dingbat.App.Tasks.where({cardId: card.model.id});

            // add new tasks
            _.each(newTasks, function(task) {
               this.addTask(task);
            }, this);

            // remove old tasks
            this.remove(oldTasks);

            this.trigger('refresh');
        },


        setAddTaskListener: function() {
            this.listenTo(Dingbat.App.Tasks, 'add', this.addTask);
        },


        setListener: function() {
            this.listenTo(Dingbat.App.Navigation, 'change:active', this.refresh);
            this.listenToOnce(Dingbat.App.Navigation, 'change:active', this.setAddTaskListener);
        }

    });

});

