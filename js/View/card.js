$(function() {
    'use strict';

    Dingbat.View.Card = Backbone.View.extend({

        model: null,


        tagName: 'li',


        template: _.template($('#card-template').html()),


        events: {
            'click a'      : 'activate',
            'dblclick a'   : 'update',
            'submit form'  : 'rename',
            'keydown input': 'cancel'
        },


        activate: function() {
            Dingbat.App.Navigation.setActiveCard(this);
            this.$el.attr('class', 'active');
        },


        cancel: function(event) {
            if (event.which == 27) {
                this.render();
            }
        },


        deactivate: function() {
            this.$el.removeAttr('class');
        },


        rename: function() {
            // get name
            var name = this.$el.find('input').val();

            // save name to model
            this.model.save({name: name}, {
                success: $.proxy(function(model, response) {
                    this.render();
                }, this),
                error: function(model, xhr) {
                    alert("Error: " + xhr.status + " - " + xhr.statusText);
                }
            });
        },


        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        },


        update: function() {
            var form  = $('<form />');
            var input = $('<input />').val(this.model.get('name'));
            this.$el.find('a').replaceWith(form.html(input));
            input.focus();
        }

    });

})

