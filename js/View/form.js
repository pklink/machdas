$(function() {
    'use strict';

    Dingbat.View.Form = Backbone.Layout.extend({

        template: '#form-template',


        events: {
            'submit'        : 'add',
            'keydown :text' : 'cancel'
        },


        add: function() {
            // create model
            var model = new Dingbat.Model.Task();

            // add eventhandler
            this.listenToOnce(model, 'request', this.disable);
            this.listenToOnce(model, 'sync', this.enable);
            this.listenToOnce(model, 'sync', this.addToCollection);
            this.listenToOnce(model, 'invalid', this.shake);

            // save model
            model.set('name', this.$(':text.name').val());
            model.set('cardId', Dingbat.App.Navigation.getActiveCard().model.get('id'));
            model.save();

            return false;
        },


        addToCollection: function(model) {
            Dingbat.App.Tasks.add(model);
        },


        /**
         * @param {Event} event
         */
        cancel: function(event) {
            if (event.which == 27) {
                this.$(':text').val('');
            }
        },


        disable: function() {
            this.$('input').attr('disabled', 'disabled');
        },


        enable: function() {
            this.$('input').removeAttr('disabled');
            this.$(':text').val('').focus();
        },


        shake: function() {
            this.$el.effect({
                effect: 'shake',
                distance: 3,
                times: 2
            });
        }

    });

})

