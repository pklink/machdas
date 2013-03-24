$(function() {

    Selleck.View.Content = Backbone.View.extend({

        el: '#content',


        initialize:  function() {
            new Selleck.View.Form();
            new Selleck.View.List();
        }

    });

})

