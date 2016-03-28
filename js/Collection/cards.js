$(function() {
    'use strict';

    Dingbat.Collection.Cards = Backbone.Collection.extend({

        model: Dingbat.Model.Card,

        url: 'api/index.php/cards'

    });

});

