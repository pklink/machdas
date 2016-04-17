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
            eventEmitter.on('tasks.deleted', model => {
                this.models.$remove(model)
            })
        }

    }
</script>