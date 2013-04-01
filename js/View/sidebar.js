$(function() {
    'use strict';

    Dingbat.View.Sidebar = Backbone.View.extend({

        template: _.template($('#sidebar-template').html()),

        events: {
            'click .icons': 'toggle'
        },

        isHidden: true,


        render: function() {
            this.$el.html(this.template());
            return this;
        },


        toggle: function() {
            var position = this.isHidden ? 0 : -175;

            this.$('#sidebar').animate({
                right: position
            });

            this.isHidden = !this.isHidden;
        }

    });

})

