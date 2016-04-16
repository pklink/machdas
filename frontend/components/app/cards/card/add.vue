<template>
    <div class="ui large fluid input">
        <input type="text" placeholder="describe your task and press enter" @keyup.enter="save" @keyup.esc="cancel" v-model="task" v-focus-model="isFocused">
    </div>
</template>

<script type="text/babel">
    import { focusModel } from 'vue-focus'
    import { taskService } from '../../../../services/resources'
    import Utils from '../../../../services/utils'

    export default {

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
                taskService.save(this.$route.params.id, model).then((response) => {
                    // fire event
                    this.$dispatch('tasks.+', response)

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

    }
</script>
