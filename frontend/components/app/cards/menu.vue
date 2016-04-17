<template>
    <div class="ui vertical pointing menu">
        <a class="item"
           v-link="{ name: 'card', params: { id: model.id }, activeClass: 'active' }"
           v-for="model in models">
            {{ model.name }} <div class="ui teal label">{{ getCount(model.id) }}</div>
        </a>
        <add :models="models"></add>
    </div>

</template>

<script type="text/babel">
    import AddInput from './menu/add'
    import eventEmitter from '../../../services/event-emitter'

    export default {

        props:    ['tasksCount', 'models'],

        components: {
            add: AddInput
        },

        methods: {
            getCount(id) {
                const taskCount = this.tasksCount.find(count => count.card === id)
                return taskCount === undefined ? 0 : taskCount.count
            }
        },

        init() {
            this.addModelCallback = (model) => {
                this.models.push(model)
            }
            this.incrementTasksCounterCallback = (model) => {
                this.tasksCount.find(count => count.card === model.cardId).count++
            }
            this.decrementTasksCounterCallback = (model) => {
                this.tasksCount.find(count => count.card === model.cardId).count--
            }
        },

        ready() {
            eventEmitter.on('cards.created', this.addModelCallback)
            eventEmitter.on('tasks.created', this.incrementTasksCounterCallback)
            eventEmitter.on('tasks.deleted', this.decrementTasksCounterCallback)
        },

        destroyed() {
            eventEmitter.off('cards.created', this.addModelCallback)
            eventEmitter.off('tasks.created', this.incrementTasksCounterCallback)
            eventEmitter.off('tasks.deleted', this.decrementTasksCounterCallback)
        }

    }
</script>