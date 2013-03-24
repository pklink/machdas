$(function() {

    Selleck.View.List = Backbone.View.extend({

        el: '#list',


        addTask: function(task) {
            var view = new Selleck.View.Task({model: task});
            this.$el.prepend(view.render().$el.hide());
            view.$el.show();
        },


        initialize:  function() {
            this.listenTo(Selleck.Collection.Tasks, 'add', this.addTask);

            var view = this;
            Selleck.Collection.Tasks.once('sync', function() {
                view.$('.loading').hide();
            });

            Selleck.Collection.Tasks.fetch();
        }

    });

})

