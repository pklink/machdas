$(function() {

    Selleck.View.List = Backbone.View.extend({

        el: '#list',

        isStarted: false,

        addTask: function(task) {
            var view = new Selleck.View.Task({model: task});
            this.$el.prepend(view.render().$el.hide());

            if (this.isStarted) {
                view.$el.slideDown();
            }
            else {
                view.$el.show();
            }
        },


        initialize:  function() {
            this.listenTo(Selleck.Collection.Tasks, 'add', this.addTask);
            this.listenTo(Selleck.Collection.Tasks, 'add', this.hideNoTasksMessage);
            this.listenTo(Selleck.Collection.Tasks, 'remove', this.showNoTasksMessage);
            this.listenTo(Selleck.Collection.Tasks, 'sync', this.showList);

            Selleck.Collection.Tasks.fetch();
        },


        hideNoTasksMessage: function() {
            this.$('.no-tasks').slideUp();
        },


        showList: function() {
            this.$el.slideDown();
            this.isStarted = true;
        },


        showNoTasksMessage: function() {
            if (Selleck.Collection.Tasks.length == 0) {
                this.$('.no-tasks').slideDown();
            }
        }

    });

})

