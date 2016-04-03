import Vue from "vue";
import VueRouter from "vue-router";
import App from "./components/app";
import Cards from "./components/cards";
import Card from "./components/card";
import {CardsResource} from "./services/resources";

// register plugins
Vue.use(VueRouter);

// create & configure router
var router = new VueRouter();

router.map({
    '/cards': {
        name: 'cards',
        component: Cards,
        subRoutes: {
            '/': {
                component: {
                    init: function() {
                        // redirect to first card
                        CardsResource.query().then(response => {
                            this.$route.router.go({ name: 'card', params: { id: response.data[0].id } });
                        });
                    }
                }
            },
            '/:id': {
                name: 'card',
                component: Card
            }
        }
    }
});

// start app
router.start(App, '#app');

