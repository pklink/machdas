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
        List: null,


        /**
         * @type Dingbat.View.Sidebar
         */
        Sidebar: null,


        /**
         * @type Dingbat.Collection.Cards
         */
        Cards: null,


        /**
         * @type Dingbat.Collection.Tasks
         */
        Tasks: null,


        /**
         * @type Dingbat.Collection.List
         */
        CardTasks: null,


        /**
         * @type {Dingbat.Router}
         */
        Router: null,


        loadCards: function() {
            this.Cards.fetch();
        },


        run: function() {
            // create collections
            this.Cards     = new Dingbat.Collection.Cards();
            this.Tasks     = new Dingbat.Collection.Tasks();
            this.CardTasks = new Dingbat.Collection.List();

            // create views
            this.Form       = new Dingbat.View.Form();
            this.List       = new Dingbat.View.List();
            this.Footer     = new Dingbat.View.Footer();
            this.Navigation = new Dingbat.View.Navigation();
            this.Sidebar    = new Dingbat.View.Sidebar();

            // set listener
            this.Navigation.setListener();
            this.CardTasks.setListener();
            this.List.setListener();

            // set views to layout/application
            this.setView('.form', this.Form);
            this.setView('.list', this.List);
            this.setView('footer', this.Footer);
            this.setView('.navigation', this.Navigation);

            // hide views
            this.Navigation.$el.hide();
            this.Form.$el.hide();
            this.List.$el.hide();
            this.Footer.$el.hide();

            this.listenToOnce(this.Tasks, 'sync', this.loadCards);
            this.listenToOnce(this.Cards, 'sync', this.showApp);
            this.listenToOnce(this.Cards, 'sync', this.startRouter);

            // load tasks
            this.Tasks.fetch();
        },


        showApp: function() {
            this.$('#app-loader').hide();
            this.Navigation.$el.fadeIn();
            this.Form.$el.slideDown();
            this.List.$el.fadeIn();
            this.Footer.$el.fadeIn();
            this.Sidebar.render().$el.appendTo('body').hide().fadeIn();
        },


        startRouter: function() {
            this.Router = new Dingbat.Router();
            Backbone.history.start();
        }


    });

    Dingbat.App = new App();
    Dingbat.App.run();

})

