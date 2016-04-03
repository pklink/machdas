import Vue from "vue";
import Menu from "./cards/menu";
import {CardsResource} from "../services/resources";

export default Vue.extend({

    template: require('./views/cards.html'),
    components: {
        menu: Menu
    },


    route: {
        data: function() {
            if (this.$route.params.id == undefined) {
                // redirect to first card
                return CardsResource.query().then(response => {
                    this.$route.router.go({ name: 'card', params: { id: response.data[0].id } });
                });
            }
        }
    }


});