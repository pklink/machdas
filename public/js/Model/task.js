$(function() {
    'use strict';

    Dingbat.Model.Task = Backbone.Model.extend({

        defaults: {
            'name':     '',
            'marked':   false,
            'priority': 'normal',
            'cardId':   ''
        },


        urlRoot: 'api/index.php/tasks',


        /**
         * @type {Dingbat.View.Task}
         */
        view: null,


        initialize: function() {
            this.listenTo(this, 'change:name', this.setPriority);
            this.listenTo(this, 'change:name', this.setMarked);
        },


        setMarked: function() {
            var name = this.get('name');

            if (name.search(/@done/) != -1) {
                this.set('marked', 1);
                this.set('name', $.trim(name.replace(/@done/, '')));
            }
        },


        setPriority: function() {
            var name = this.get('name');

            if (name.search(/@high/) != -1) {
                this.set('priority', 'high');
                this.set('name', $.trim(name.replace(/@high/, '')));
            }
            else if (name.search(/@normal/) != -1) {
                this.set('priority', 'normal');
                this.set('name', $.trim(name.replace(/@normal/, '')));
            }
            else if (name.search(/@low/) != -1) {
                this.set('priority', 'low');
                this.set('name', $.trim(name.replace(/@low/, '')));
            }

            this.listenToOnce(this, 'change:name', this.setPriority);
        },


        validate: function(attributes) {
            if (attributes.name.length < 1) {
                return "no name is given";
            }
        }

    });

});