<template>
    <div class="four wide column">
        <menu></menu>
    </div>

    <div class="twelve wide column">
        <router-view></router-view>
    </div>
</template>

<script>
    import Menu from './cards/menu'

    export default {

        components: {
            menu: Menu
        }

    }
</script>