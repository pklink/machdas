<template>
    <div class="item">
        <div class="ui transparent icon input">
            <input type="text" placeholder="Add card" @keyup.enter="save" @keyup.esc="cancel" v-model="model.name" v-focus-model="isFocused">
            <i class="plus icon"></i>
        </div>
    </div>
</template>

<script type="text/babel">
    import { focusModel } from 'vue-focus'
    import cardService from '../../../../services/card'
    import eventEmitter from '../../../../services/event-emitter'

    export default {

        directives: {
            focusModel
        },

        init() {
            eventEmitter.on('cards.new', () => {
                this.isFocused = true
            })
        },

        data() {
            return {
                isFocused: false,
                model: {
                    name: ''
                }
            }
        },

        methods: {
            save() {
                // save card
                cardService.create(this.model).then((response) => {
                    // route to new card
                    this.$route.router.go({ name: 'card', params: { id: response.id } })

                    // clear field
                    this.model.name = ''
                })
            },
            cancel() {
                this.model.name = ''
                this.isFocused  = false
            }
        }

    }
</script>