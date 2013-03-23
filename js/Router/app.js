$(function() {

    var App = Backbone.Router.extend({

        routes: {
            'bla': 'bla',
            'blub/:bla': 'blub'
        },

        initialize: function(options) {
        },

        bla: function() {
            alert('bla');
        },

        blub: function(bla) {
            alert(bla);
        }

    });

    Selleck.Router.App = new App();

});