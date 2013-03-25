$(function() {

    Selleck.View.Form = Backbone.Layout.extend({

        template: '#form-template',


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
            this.listenToOnce(model, 'invalid', this.shake);

            // save model
            model.set('name', this.$(':text.name').val());
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
        },


        shake: function() {
            this.$el.effect({
                effect: 'shake',
                easing: 'easeInOutCirc',
                distance: 3,
                times: 2
            });
        }

    });

})

