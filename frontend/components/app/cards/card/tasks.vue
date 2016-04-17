<template>
    <add :transparent="false" v-show="models.length == 0"></add>
    <div class="ui large divided selection list">
        <div class="item" v-show="models.length > 0">
            <div class="content">
                <add :transparent="true"></add>
            </div>
        </div>
        <task v-for="model in models" :model="model"></task>
    </div>
</template>

<script type="text/babel">
    import Task from './tasks/task'
    import Add from './tasks/add'
    import eventEmitter from '../../../../services/event-emitter'

    export default {

        props:    ['models'],
        components: {
            task: Task,
            add: Add
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