import Vue from "vue";
import Menu from "./cards/menu";

export default Vue.extend({

    template: require('./views/cards.html'),
    components: {
        menu: Menu
    }

});
