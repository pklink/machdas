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
            eventEmitter.on('cards.created', (model) => {
                // add card to models
                this.models.push(model)
            })
            eventEmitter.on('tasks.created', model => {
                // increment tasks count
                this.tasksCount.find(count => count.card === model.cardId).count++
            })
        }

    }
</script>