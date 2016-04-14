import Vue from 'vue'
import { focusModel } from 'vue-focus'
import { TasksResource } from '../../services/resources'
import Utils from '../../services/utils'

export default Vue.extend({

    template: require('./views/add.html'),

    directives: {
        focusModel
    },

    init() {
        this.$on('tasks.new', () => {
            this.isFocused = true
        })
    },

    methods: {
        save() {
            // create model
            const model = {
                name: this.task,
                priority: 'normal'
            }

            // parse models name
            Utils.parseTask(model)

            // save task
            TasksResource.save({ id: this.$route.params.id }, model).then((response) => {
                // fire event
                this.$dispatch('tasks.+', response.data)

                // clear task
                this.task = null
            })
        },
        cancel() {
            this.isFocused = false
            this.task = ''
        }
    },

    data() {
        return {
            task: '',
            isFocused: true
        }
    }

})
