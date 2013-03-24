$(function() {

    Selleck.View.App = Backbone.View.extend({

        el: '#content',


        form: new Selleck.View.Form(),


        footer: new Selleck.View.Footer(),


        list: new Selleck.View.List(),


        initialize:  function() {
            this.form.$el.hide();
            this.list.$el.hide();
            this.footer.$el.hide();

            this.listenToOnce(Selleck.Collection.Tasks, 'sync', this.showApp);
        },


        showApp: function() {
            this.$('#app-loader').hide();
            this.form.$el.slideDown();
            this.list.$el.fadeIn();
            this.footer.$el.fadeIn();
        }

    });

})

