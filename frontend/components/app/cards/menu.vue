<template>
    <div class="ui vertical pointing menu">
        <a class="item"
           v-link="{ name: 'card', params: { id: model.id }, activeClass: 'active' }"
           v-for="model in models">
            {{ model.name }}
        </a>
        <add :models="models"></add>
    </div>

</template>

<script type="text/babel">
    import { CardsResource } from '../../../services/resources'
    import AddInput from './menu/add'

    export default {

        props:    ['models'],

        components: {
            add: AddInput
        },

        init() {
            this.$on('cards.+', (model) => {
                this.models.push(model)
            })
        },

        data() {
            return CardsResource.query().then(response => {
                this.models = response.data
            })
        }

    }
</script>