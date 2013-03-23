$(function() {

    Selleck.View.List = Backbone.View.extend({

        el: '#list',

        initialize:  function(options) {
            this.listenTo(Selleck.Collection.Tasks, 'add', this.addTask);

            Selleck.Collection.Tasks.fetch();
        },



        addTask: function(task) {
            var view = new Selleck.View.Task({model: task});
            this.$el.prepend(view.render().$el.hide());
            view.$el.slideDown();
        }

    });

})

