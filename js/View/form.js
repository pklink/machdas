$(function() {

    Selleck.View.Form = Backbone.View.extend({

        el: '#form',


        events: {
            'submit': 'add'
        },


        add: function() {
            // create model
            var model = new Selleck.Model.Task();

            // add eventhandler
            this.listenToOnce(model, 'request', this.disable);
            this.listenToOnce(model, 'sync', this.enable);
            this.listenToOnce(model, 'sync', this.addToCollection);

            // save model
            model.set('name', this.$('input[name=name]').val());
            model.save();

            return false;
        },


        addToCollection: function(model) {
            Selleck.Collection.Tasks.add(model);
        },


        disable: function() {
            this.$('input').attr('disabled', 'disabled');
        },


        enable: function() {
            this.$('input').removeAttr('disabled');
            this.$(':text').val('').focus();
        }

    });

})

