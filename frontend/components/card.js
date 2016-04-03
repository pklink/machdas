import Vue from "vue";
import {TasksResource} from "../services/resources";
import Add from "./card/add";
import Tasks from "./card/tasks";

export default Vue.extend({

    template: require('./views/card.html'),
    components: {
        tasks: Tasks,
        add: Add
    },

    init: function() {
        this.$on('tasks.+', (model) => {
            this.models.push(model);
        });
    },

    data: function() {
        return {
            models: []
        }
    },

    route: {

        data: function() {
            let params = {
                id: this.$route.params.id,
                'order-by': 'priority,desc'
            };
            return TasksResource.queryByCardId(params).then(response => {
                return { models: response.data }
            });
        },

        canReuse: false

    }

});