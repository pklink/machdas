<template>
    <add></add>
    <tasks :models="models"></tasks>
</template>

<script type="text/babel">
    import cardService from '../../../services/card'
    import taskService from '../../../services/task'
    import Add from './card/add'
    import Tasks from './card/tasks'
    import eventEmitter from '../../../services/event-emitter'

    export default {

        components: {
            tasks: Tasks,
            add: Add
        },

        init() {
            const refresh = () => this.refresh()
            eventEmitter.on('tasks.created', refresh)
            eventEmitter.on('tasks.updated', refresh)
        },

        data() {
            return {
                model:  {},
                models: []
            }
        },

        methods: {
            loadModels() {
                return taskService.queryByCardId(this.$route.params.id)
            },
            refresh() {
                this.loadModels().then(response => {
                    this.models = response
                })
            }
        },

        route: {

            data(transition) {
                const id = transition.to.params.id

                return {
                    model:  cardService.get(id),
                    models: taskService.queryByCardId(id)
                }
            },

            canReuse: false

        }

    }
</script>