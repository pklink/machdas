import Vue from "vue";
import {focusModel} from "vue-focus";
import {TasksResource} from "../../services/resources";
import Utils from "../../services/utils";

export default Vue.extend({

    template: require('./views/add.html'),

    directives: {
        focusModel: focusModel
    },

    init: function () {
        this.$on('tasks.new', () => {
            this.isFocused = true;
        });
    },

    methods: {
        save: function() {
            // create model
            let model = {
                name: this.task,
                priority: 'normal'
            };

            // parse models name
            Utils.parseTask(model);

            // save task
            TasksResource.save({id: this.$route.params.id }, model).then((response) => {
                // fire event
                this.$dispatch('tasks.+', response.data);

                // clear task
                this.task = null;
            });
        },
        cancel: function() {
            this.isFocused = false;
            this.task = '';
        }
    },

    data: function() {
        return {
            task: '',
            isFocused: true
        }
    }

});