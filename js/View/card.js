$(function() {

    Dingbat.View.Card = Backbone.View.extend({

        events: {
        },


        model: null,


        tagName: 'li',


        template: _.template($('#card-template').html()),


        events: {
            'click a': 'activate'
        },


        activate: function() {
            Dingbat.View.App.navigation.setActiveCard(this);
            this.$el.attr('class', 'active');
        },


        deactivate: function() {
            this.$el.removeAttr('class');
        },


        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        }

    });

})

