import Vue from "vue";
import {CardsResource} from "../../../services/resources";

export default Vue.extend({

    template: require('./views/add.html'),

    data: function() {
        return {
            model: {
                name: null
            }
        }
    },

    methods: {
        save: function() {
            // save card
            CardsResource.save(this.model).then((response) => {
                // fire event
                this.$dispatch('cards.+', response.data);

                // route to new card
                this.$route.router.go({ name: 'card', params: { id: response.data.id }});

                // clear field
                this.model.name = '';
            });
        }
    }

});