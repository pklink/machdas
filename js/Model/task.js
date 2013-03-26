$(function() {

    Dingbat.Model.Task = Backbone.Model.extend({

        defaults: {
            'name':     '',
            'marked':   false,
            'priority': 1
        },


        priorityName: 'normal',


        urlRoot: 'api.php/task',

        initialize: function() {
            this.listenTo(this, 'change:priority', this.setPriorityName);
            this.listenToOnce(this, 'add', this.setPriorityName);
            this.listenTo(this, 'change:name', this.setPriority);
        },


        setPriority: function() {
            var name = this.get('name');

            if (name.search(/@high/) != -1) {
                this.set('priority', 2);
                this.set('name', $.trim(name.replace(/@high/, '')));
            }
            else if (name.search(/@normal/) != -1) {
                this.set('priority', 1);
                this.set('name', $.trim(name.replace(/@normal/, '')));
            }
            else if (name.search(/@low/) != -1) {
                this.set('priority', 0);
                this.set('name', $.trim(name.replace(/@low/, '')));
            }

            this.listenToOnce(this, 'change:name', this.setPriority);
        },


        setPriorityName: function() {
            if (this.get('priority') == 0) {
                this.priorityName = 'low';
            }

            else if (this.get('priority') == 1) {
                this.priorityName = 'normal';
            }

            else if (this.get('priority') == 2) {
                this.priorityName = 'high';
            }
        },


        validate: function(attributes, options) {
            if (attributes.name.length < 1) {
                return "no task is given";
            }
        }

    });

});