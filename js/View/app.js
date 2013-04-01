$(function() {
    'use strict';


    var App = Backbone.Layout.extend({

        template: '#app',


        /**
         * @type Dingbat.View.Navigation
         */
        Navigation: null,


        /**
         * @type Dingbat.View.Form
         */
        Form: null,


        /**
         * @type Dingbat.View.Footer
         */
        Footer: null,


        /**
         * @type Dingbat.View.List
         */
        list: null,


        /**
         * @type Dingbat.View.Sidebar
         */
        sidebar: null,


        initialize:  function() {
            // create views
            this.Form       = new Dingbat.View.Form();
            this.list       = new Dingbat.View.List();
            this.Footer     = new Dingbat.View.Footer();
            this.Navigation = new Dingbat.View.Navigation();
            this.sidebar    = new Dingbat.View.Sidebar();

            // set views to layout/application
            this.setView('.form', this.Form);
            this.setView('.list', this.list);
            this.setView('footer', this.Footer);
            this.setView('.navigation', this.Navigation);

            // hide views
            this.Navigation.$el.hide();
            this.Form.$el.hide();
            this.list.$el.hide();
            this.Footer.$el.hide();

            this.listenToOnce(Dingbat.Collection.Tasks, 'sync', this.showApp);
        },


        showApp: function() {
            this.$('#app-loader').hide();
            this.Navigation.$el.fadeIn();
            this.Form.$el.slideDown();
            this.list.$el.fadeIn();
            this.Footer.$el.fadeIn();
            this.sidebar.render().$el.appendTo('body').hide().fadeIn();
        }

    });

    Dingbat.View.App = new App();

})

