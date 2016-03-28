$(function() {
    'use strict';

    Dingbat.Router = Backbone.Router.extend({

        routes: {
            "cards/:id": "setCard",
            '*action'  : 'default'
        },


        default: function() {
            this.setCard( Dingbat.App.Cards.at(0).id );
        },


        setCard: function(id) {
            var card = Dingbat.App.Cards.get(id);

            if (_.isObject(card)) {
                card.view.activate();
            }
            else {
                Dingbat.App.Router.navigate('/', {trigger: true});
            }
        }

    });

});