$(function() {
    'use strict';

    Dingbat.View.List = Backbone.Layout.extend({

        template: '#list-template',


        /**
         * @param {Dingbat.Model.Task} task
         */
        addTask: function(task) {
            // create view
            var view = new Dingbat.View.Task({model: task});

            // set view to model
            task.view = view;

            // render & show task
            view.render().$el.prependTo(this.$('form.list')).slideDown();
        },


        hideNoTasksMessage: function() {
            this.$('.no-tasks').slideUp();
        },


        hideTask: function(task) {
            task.view.hide();
        },


        setListener: function() {
            this.listenTo(Dingbat.App.CardTasks, 'add', this.addTask);
            this.listenTo(Dingbat.App.CardTasks, 'add', this.hideNoTasksMessage);
            this.listenTo(Dingbat.App.CardTasks, 'remove', this.hideTask);
            this.listenTo(Dingbat.App.CardTasks, 'remove', this.showNoTasksMessage);
        },


        showNoTasksMessage: function() {
            if (Dingbat.App.CardTasks.length == 0) {
                this.$('.no-tasks').slideDown();
            }
        }

    });

})

