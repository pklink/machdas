$(function() {

    Selleck.View.Task = Backbone.View.extend({

        tagName: 'div',


        template: _.template($('#task-template').html()),


        model: null,


        events: {
            'click .delete':   'delete',
            'click .checkbox': 'toggleMarked'
        },


        delete: function() {
            this.model.destroy();

            this.$el.slideUp(function() {
                this.remove();
            })
        },

        mark:  function() {
            this.model.set('marked', 1);

            this.$('.checkbox').addClass('checked');
            this.$('.name').wrap('<del />');
        },


        unmark:  function() {
            this.model.set('marked', 0);

            this.$('.checkbox').removeClass('checked');
            this.$('.name').unwrap();
        },


        toggleMarked: function() {
            if (this.model.get('marked') == 1) {
                this.unmark();
            }
            else {
                this.mark();
            }

            this.model.save();
        },


        render: function() {
            this.$el.html(this.template(this.model.toJSON()));

            if (this.model.get('marked') == 1) {
                this.mark();
            }

            return this;
        }

    });

})

