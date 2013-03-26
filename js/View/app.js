$(function() {

    var App = Backbone.Layout.extend({

        template: '#app',


        form: null,


        footer: null,


        list: null,


        sidebar: new Selleck.View.Sidebar(),


        views: {
            '.form':  new Selleck.View.Form(),
            '.list':  new Selleck.View.List(),
            'footer': new Selleck.View.Footer()
        },


        initialize:  function() {
            // save views
            this.form = this.getView('.form');
            this.footer = this.getView('footer');
            this.list = this.getView('.list');

            // hide views
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
            this.sidebar.render().$el.appendTo('body').hide().fadeIn();
        }

    });

    Selleck.View.App = new App();

})

