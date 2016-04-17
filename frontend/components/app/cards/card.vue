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

        init() {
            this.refreshCallback = () => this.refresh()
        },

        components: {
            tasks: Tasks,
            add: Add
        },

        destroyed() {
            eventEmitter.off('tasks.created', this.refreshCallback)
            eventEmitter.off('tasks.updated', this.refreshCallback)
        },

        ready() {
            eventEmitter.on('tasks.created', this.refreshCallback)
            eventEmitter.on('tasks.updated', this.refreshCallback)
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

            canReuse: false,
            waitForData: true

        }

    }
</script>