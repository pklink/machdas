import Vue from "vue";
import {TasksResource} from "../../services/resources";

export default Vue.extend({

    template: require('./views/add.html'),

    methods: {
        save: function() {
            // create model
            let model = {
                name: this.task,
                priority: 'normal'
            };

            // save task
            TasksResource.save({id: this.$route.params.id }, model).then((response) => {
                // fire event
                this.$dispatch('tasks.+', response.data);

                // clear task
                this.task = null;
            });
        }
    },

    data: function() {
        return {
            task: null
        }
    }

});