$(function() {

    Selleck.View.Task = Backbone.View.extend({

        events: {
            'click .update':   'showForm',
            'dblclick label':  'showForm',
            'click .cancel':   'hideForm',
            'click .delete':   'delete',
            'click .checkbox': 'toggleMarked',
            'keyup :text':     'cancel',
            'submit form':     'update'
        },


        model: null,


        tagName: 'div',


        template: _.template($('#task-template').html()),


        cancel: function(event) {
            if (event.which == 27) {
                this.hideForm();
            }
        },


        delete: function() {
            this.model.destroy();

            this.$el.slideUp(function() {
                this.remove();
            })
        },


        hideForm: function() {
            this.$(':text').hide();
            this.$('.cancel').hide();
            this.$('.update').show();
            this.$('label').show();
        },


        mark:  function() {
            this.model.set('marked', 1);

            this.$('.checkbox').addClass('checked');
            this.$('.name').wrap('<del />');
        },


        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            this.hideForm();

            if (this.model.get('marked') == 1) {
                this.mark();
            }

            return this;
        },


        showForm: function() {
            this.$('label').hide();
            this.$('.update').hide();
            this.$(':text').val(this.$('.name').text()).show();
            this.$(':text').focus();
            this.$('.cancel').show();
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


        unmark: function() {
            this.model.set('marked', 0);

            this.$('.checkbox').removeClass('checked');
            this.$('.name').unwrap();
        },


        update: function() {
            var value = this.$(':text:first').val();

            if (this.model.set('name', value).save()) {
                this.$('.name').text(value);
                this.hideForm();
            }

            return false;
        }

    });

})

