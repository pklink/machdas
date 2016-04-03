import Vue from "vue";
import {TasksResource} from "../services/resources";
import Menu from "./card/menu";
import Tasks from "./card/tasks";

export default Vue.extend({

    template: require('./views/card.html'),
    components: {
        menu: Menu,
        tasks: Tasks
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
        }

    }

});