<template>
    <div class="four wide column">
        <menu :tasks-count="tasksCount" :models="cards"></menu>
    </div>

    <div class="twelve wide column">
        <router-view></router-view>
    </div>
</template>

<script type="text/babel">
    import Menu from './cards/menu'
    import cardService from '../../services/card'
    import taskService from '../../services/task'

    export default {

        components: {
            menu: Menu
        },

        data() {
            return {
                tasksCount: {},
                cards: {}
            }
        },

        route: {
            data() {
                return {
                    tasksCount: taskService.countByCards(),
                    cards:      cardService.query()
                }
            }
        }

    }
</script>