<template>
    <div class="four wide column">
        <menu :models="cards"></menu>
    </div>

    <div class="twelve wide column">
        <router-view></router-view>
    </div>
</template>

<script>
    import Menu from './cards/menu'
    import cardService from '../../services/card'

    export default {

        components: {
            menu: Menu
        },

        data() {
            return {
                cards: {}
            }
        },

        route: {
            data() {
                return {
                    cards: cardService.query()
                }
            }
        }

    }
</script>