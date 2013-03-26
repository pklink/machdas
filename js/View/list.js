$(function() {

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
            this.listenTo(Dingbat.Collection.Tasks, 'add', this.addTask);
            this.listenTo(Dingbat.Collection.Tasks, 'add', this.hideNoTasksMessage);
            this.listenTo(Dingbat.Collection.Tasks, 'remove', this.showNoTasksMessage);
            this.listenTo(Dingbat.Collection.Tasks, 'sync', this.showList);

            Dingbat.Collection.Tasks.fetch();
        },


        hideNoTasksMessage: function() {
            this.$('.no-tasks').slideUp();
        },


        showList: function() {
            this.$el.slideDown();
            this.isStarted = true;
        },


        showNoTasksMessage: function() {
            if (Dingbat.Collection.Tasks.length == 0) {
                this.$('.no-tasks').slideDown();
            }
        }

    });

})

