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
         *
         * @param {Dingbat.View.Card} card
         */
        refresh: function(card) {
            this.remove(this.toArray());

            var tasks = Dingbat.App.Tasks.where({cardId: card.model.id});

            _.each(tasks, function(task) {
               this.addTask(task);
            }, this);

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

