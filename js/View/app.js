$(function() {

    var app = Backbone.Layout.extend({

        template: '#app',


        form: null,


        footer: null,


        list: null,


        views: {
            '.form':  new Selleck.View.Form(),
            '.list':  new Selleck.View.List(),
            'footer': new Selleck.View.Footer()
        },


        initialize:  function() {
            this.form = this.getView('.form');
            this.footer = this.getView('footer');
            this.list = this.getView('.list');

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

    Selleck.View.App = new app();

})

