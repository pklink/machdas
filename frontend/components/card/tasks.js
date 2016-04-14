import Vue from 'vue';
import Task from './tasks/task';

export default Vue.extend({

    template: require('./views/tasks.html'),
    props:    ['models'],
    components: {
        task: Task
    },

    init() {
        this.$on('tasks.-', model => {
            this.models.splice(this.models.indexOf(model), 1);
        });
    }

});
