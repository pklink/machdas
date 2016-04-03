import Vue from "vue";
import {TasksResource} from "../../../services/resources";

export default Vue.extend({

    template: require('./views/task.html'),
    props:    ['model'],

    data: function() {
        return {
            isChecked: false
        }
    },

    methods: {
        toggle: function() {
            this.model.marked = !this.model.marked;
            TasksResource.update({ id: this.model.id }, this.model);
        }
    }

});