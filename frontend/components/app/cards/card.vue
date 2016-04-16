<template>
    <add></add>
    <tasks :models="models"></tasks>
</template>

<script type="text/babel">
    import { cardService, taskService, TasksResource } from '../../../services/resources'
    import Add from './card/add'
    import Tasks from './card/tasks'

    export default {

        components: {
            tasks: Tasks,
            add: Add
        },

        init() {
            const refresh = () => this.refresh()
            this.$on('tasks.+', refresh)
            this.$on('tasks.updated', refresh)
        },

        data() {
            return {
                model:  {},
                models: []
            }
        },

        methods: {
            loadModels() {
                const params = {
                    id: this.$route.params.id,
                    'order-by': 'priority,desc'
                }

                return TasksResource.queryByCardId(params)
            },
            refresh() {
                this.loadModels().then(response => {
                    this.models = response.data
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