$(function() {
    'use strict';

    Dingbat.View.Navigation = Backbone.Layout.extend({

        template: '#navigation-template',


        activeCard: null,


        events: {
            'click .cancel' : 'hideForm',
            'click .add'    : 'showForm',
            'submit form'   : 'createCard',
            'keydown input' : 'cancel'
        },


        /**
         * @param {Dingbat.Model.Card} model
         */
        addCard: function(model) {
            // create card-view
            var view = new Dingbat.View.Card({model: model});

            // set view to model
            model.view = view;

            // render view
            view.render().$el.appendTo(this.$('.list')).hide().fadeIn();
        },


        /**
         * @param {Dingbat.Model.Card} model
         */
        addCardToCollection: function(model) {
            Dingbat.App.Cards.add(model);

            // "redirect" to card
            Dingbat.App.Router.navigate('card/' + model.id, {trigger: true});

            // focus task-form
            Dingbat.App.Form.$(':text').focus();
        },


        /**
         * @param {Event} event
         */
        cancel: function(event) {
            if (event.which == 27) {
                this.hideForm();
            }
        },


        createCard: function() {
            // create model
            var model = new Dingbat.Model.Card();

            // add model to collection and layout after saving
            this.listenToOnce(model, 'sync', this.addCardToCollection);
            this.listenToOnce(model, 'sync', this.hideForm);
            this.listenToOnce(model, 'invalid', this.error);

            // set properties and save
            model.set('name', this.$('input').val());
            model.save();

            return false;
        },


        getActiveCard: function() {
            return this.activeCard;
        },


        hideForm: function() {
            this.$('input').val('');
            this.$('input').animate({
                'opacity':0
            }, 200, 'swing', function() {
                $(this).css('visibility', 'hidden');
            });
            this.$('.cancel').hide();
            this.$('.add').fadeIn();
        },


        /**
         * @param {Dingbat.View.Card} view
         */
        setActiveCard: function(view) {
            if (this.activeCard != null) {
                if (view.model.id == this.activeCard.model.id) {
                    return false;
                }

                this.activeCard.deactivate();
            }

            this.activeCard = view;
            this.trigger('change:active', view);
        },


        setListener: function() {
            this.listenTo(Dingbat.App.Cards, 'add', this.addCard);
        },


        error: function() {
            this.$(':text').parent().shake();
        },


        showForm: function() {
            this.$('input').css('visibility', 'visible');
            this.$('input').animate({
                'opacity':1
            }, 200).focus();
            this.$('.add').hide();
            this.$('.cancel').fadeIn();
        }

    });

})

