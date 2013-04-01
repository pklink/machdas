$(function() {
    'use strict';

    Dingbat.View.List = Backbone.Layout.extend({

        template: '#list-template',


        isStarted: false,


        addTask: function(task) {
            var view = new Dingbat.View.Task({model: task});
            view.render().$el.hide().prependTo(this.$('form.list'));

            if (this.isStarted) {
                view.$el.slideDown();
            }
            else {
                view.$el.show();
            }
        },


        initialize:  function() {
            this.listenTo(Dingbat.App.Tasks, 'add', this.addTask);
            this.listenTo(Dingbat.App.Tasks, 'add', this.hideNoTasksMessage);
            this.listenTo(Dingbat.App.Tasks, 'remove', this.showNoTasksMessage);
            this.listenTo(Dingbat.App.Tasks, 'sync', this.showList);

            Dingbat.App.Tasks.fetch();
        },


        hideNoTasksMessage: function() {
            this.$('.no-tasks').slideUp();
        },


        showList: function() {
            this.$el.slideDown();
            this.isStarted = true;
        },


        showNoTasksMessage: function() {
            if (Dingbat.App.Tasks.length == 0) {
                this.$('.no-tasks').slideDown();
            }
        }

    });

})

