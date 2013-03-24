$(function() {

    Selleck.View.Task = Backbone.View.extend({

        tagName: 'div',


        template: _.template($('#task-template').html()),


        model: null,


        events: {
            'click .update':   'showForm',
            'dblclick label':   'showForm',
            'click .cancel':   'hideForm',
            'click .delete':   'delete',
            'click .checkbox': 'toggleMarked',
            'keyup :text': 'cancel',
            'submit form': 'update'
        },


        cancel: function(event) {
            if (event.which == 27) {
                this.hideForm();
            }
        },

        update: function() {
            var value = this.$(':text:first').val();
            this.model.set('name', value).save();
            this.$('.name').text(value);
            this.hideForm();
            return false;
        },


        hideForm: function() {
            this.$(':text').hide();
            this.$('.cancel').hide();
            this.$('.update').show();
            this.$('label').show();
        },


        showForm: function() {
            this.$('label').hide();
            this.$('.update').hide();
            this.$(':text').val(this.$('.name').text()).show();
            this.$(':text').focus();
            this.$('.cancel').show();
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
            this.hideForm();

            if (this.model.get('marked') == 1) {
                this.mark();
            }

            return this;
        }

    });

})

