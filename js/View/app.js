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
        form: null,


        /**
         * @type Dingbat.View.Footer
         */
        footer: null,


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
            this.form       = new Dingbat.View.Form();
            this.list       = new Dingbat.View.List();
            this.footer     = new Dingbat.View.Footer();
            this.Navigation = new Dingbat.View.Navigation();
            this.sidebar    = new Dingbat.View.Sidebar();

            // set views to layout/application
            this.setView('.form', this.form);
            this.setView('.list', this.list);
            this.setView('footer', this.footer);
            this.setView('.navigation', this.Navigation);

            // hide views
            this.Navigation.$el.hide();
            this.form.$el.hide();
            this.list.$el.hide();
            this.footer.$el.hide();

            this.listenToOnce(Dingbat.Collection.Tasks, 'sync', this.showApp);
        },


        showApp: function() {
            this.$('#app-loader').hide();
            this.Navigation.$el.fadeIn();
            this.form.$el.slideDown();
            this.list.$el.fadeIn();
            this.footer.$el.fadeIn();
            this.sidebar.render().$el.appendTo('body').hide().fadeIn();
        }

    });

    Dingbat.View.App = new App();

})

