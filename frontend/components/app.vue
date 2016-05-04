<template>
    <div>
        <div class="sixteen wide column">
            <div class="ui secondary pointing menu">
                <a class="item" v-link="{ name: 'cards', activeClass: 'active' }">Cards</a>
                <a class="item" v-link="{ name: 'help', activeClass: 'active' }">Help</a>
            </div>
        </div>

        <router-view></router-view>

        <div class="sixteen wide right aligned column">
            <div class="ui divider"></div>
            <small class="secondary">this is <a href="https://github.com/pklink/machdas">machdas 0.7.2</a></small>
        </div>
    </div>
</template>

<script type="text/babel">
    import key from 'keymaster'
    import eventEmitter from '../services/event-emitter'

    export default {

        ready() {
            // create new task
            key('n', () => {
                eventEmitter.emit('tasks.new')
                return false
            })

            // create new card
            key('c', () => {
                eventEmitter.emit('cards.new')
                return false
            })

            // go to help
            key('h', () => {
                this.$route.router.go({ name: 'help' })
            })
        }

    }
</script>
