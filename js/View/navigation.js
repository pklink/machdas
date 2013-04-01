$(function() {
    'use strict';

    Dingbat.View.Navigation = Backbone.Layout.extend({

        template: '#navigation-template',


        activeCard: null,


        events: {
            'click .cancel': 'hideForm',
            'click .add'   : 'showForm',
            'submit form'  : 'createCard',
            'keyup input'  : 'cancel'
        },


        /**
         *
         * @param {Dingbat.Model.Card} card
         */
        addCard: function(card) {
            // create card-view
            var view = new Dingbat.View.Card({model: card});

            // set view to model
            card.view = view;

            // render view
            view.render().$el.appendTo(this.$('.list')).hide().fadeIn();
        },


        cancel: function(event) {
            if (event.which == 27) {
                this.hideForm();
            }
        },


        createCard: function() {
            // create model
            var model = new Dingbat.Model.Card();

            // add model to collection after saving
            this.listenToOnce(model, 'sync', this.addCard);

            // set properties and save
            model.set('name', this.$('input').val());
            model.save();

            // hide form
            this.hideForm();

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
         *
         * @param {Dingbat.View.Card} card
         */
        setActiveCard: function(card) {
            if (this.activeCard != null) {
                if (card.model.id == this.activeCard.model.id) {
                    return false;
                }

                this.activeCard.deactivate();
            }

            this.activeCard = card;
            this.trigger('change:active', card);
        },


        setListener: function() {
            this.listenTo(Dingbat.App.Cards, 'add', this.addCard);
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

