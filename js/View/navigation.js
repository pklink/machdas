$(function() {

    Dingbat.View.Navigation = Backbone.Layout.extend({

        template: '#navigation-template',


        events: {
            'click .cancel': 'hideForm',
            'click .add'   : 'showForm',
            'submit form'  : 'createCard'
        },


        addCard: function(card) {
            var view = new Dingbat.View.Card({model: card});
            view.render().$el.appendTo(this.$('.list')).hide().fadeIn();
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


        showForm: function() {
            this.$('input').css('visibility', 'visible');
            this.$('input').animate({
                'opacity':1
            }, 200).focus();
            this.$('.add').hide();
            this.$('.cancel').fadeIn();
        },


        initialize: function() {
            this.listenTo(Dingbat.Collection.Cards, 'add', this.addCard);

            Dingbat.Collection.Cards.fetch();
        }

    });

})

