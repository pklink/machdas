$(function() {

    Dingbat.View.Card = Backbone.View.extend({

        events: {
        },


        model: null,


        tagName: 'li',


        template: _.template($('#card-template').html()),


        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        }

    });

})

