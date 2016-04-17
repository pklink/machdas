<template>
    <div class="ui icon fluid input" :class="{ transparent: transparent, small: transparent, large: !transparent }">
        <input type="text" placeholder="describe your task and press enter"
               @keyup.enter="save" @keyup.esc="cancel" v-model="task" v-focus-model="isFocused">
        <i class="plus icon" id="add-task-input-icon"></i>
    </div>
</template>

<style>
    #add-task-input-icon {
        right: 4px;
    }
</style>

<script type="text/babel">
    import { focusModel } from 'vue-focus'
    import taskService from '../../../../../services/task'
    import Utils from '../../../../../services/utils'
    import eventEmitter from '../../../../../services/event-emitter'

    export default {

        props: ['transparent'],

        directives: {
            focusModel
        },

        init() {
            this.setFocusCallback = () => {
                this.isFocused = true
            }
        },

        ready() {
            eventEmitter.on('tasks.new', this.setFocusCallback)
        },

        destroyed() {
            eventEmitter.off('tasks.new', this.setFocusCallback)
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
                taskService.create(this.$route.params.id, model).then(() => {
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
