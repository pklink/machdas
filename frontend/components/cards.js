import Vue from "vue";
import {CardsResource} from "../services/resources";

export default Vue.extend({

    route: {
        activate: function() {
            // redirect to first card
            return CardsResource.query().then(response => {
                this.$route.router.go({ name: 'card', params: { id: response.data[0].id } });
            });
        }
    }


});