import Vue from 'vue';
import { CardsResource } from '../../services/resources';
import AddInput from './menu/add';

export default Vue.extend({

    template: require('./views/menu.html'),
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

})
