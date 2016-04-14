import Vue from 'vue';
import { focusModel } from 'vue-focus';
import { CardsResource } from '../../../services/resources';

export default Vue.extend({

    template: require('./views/add.html'),

    directives: {
        focusModel
    },

    init() {
        this.$on('cards.new', () => {
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
            CardsResource.save(this.model).then((response) => {
                // fire event
                this.$dispatch('cards.+', response.data)

                // route to new card
                this.$route.router.go({ name: 'card', params: { id: response.data.id } })

                // clear field
                this.model.name = ''
            })
        },
        cancel() {
            this.model.name = ''
            this.isFocused  = false
        }
    }

})
