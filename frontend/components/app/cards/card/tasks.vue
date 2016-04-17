<template>
    <div class="ui large divided selection list">
        <task v-for="model in models" :model="model"></task>
        <p class="ui message" v-if="models.length == 0">No tasks found</p>
    </div>
</template>

<script type="text/babel">
    import Task from './tasks/task'
    import eventEmitter from '../../../../services/event-emitter'

    export default {

        props:    ['models'],
        components: {
            task: Task
        },

        init() {
            this.removeModelCallback = (model) => {
                this.models.$remove(model)
            }
        },

        ready() {
            eventEmitter.on('tasks.deleted', this.removeModelCallback)
        },

        destroyed() {
            eventEmitter.off('tasks.deleted', this.removeModelCallback)
        }

    }
</script>