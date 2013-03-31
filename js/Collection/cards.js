$(function() {

    var Cards = Backbone.Collection.extend({

        model: Dingbat.Model.Card,

        url: 'api.php/cards'

    });


    Dingbat.Collection.Cards = new Cards();

});

