<template>
    <div class="ui large divided selection list">
        <task v-for="model in models" :model="model"></task>
        <p class="ui message" v-if="models.length == 0">No tasks found</p>
    </div>
</template>

<script type="text/babel">
    import Task from './tasks/task'

    export default {

        props:    ['models'],
        components: {
            task: Task
        },

        init() {
            this.$on('tasks.-', model => {
                this.models.splice(this.models.indexOf(model), 1)
            })
        }

    }
</script>