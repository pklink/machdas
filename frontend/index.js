import Vue from "vue";
import VueRouter from "vue-router";
import App from "./components/app";
import Cards from "./components/cards";
import Card from "./components/card";

// register plugins
Vue.use(VueRouter);

// create & configure router
var router = new VueRouter();

router.map({
    '/cards': {
        name: 'cards',
        component: Cards,
        subRoutes: {
            '/:id': {
                name: 'card',
                component: Card
            }
        }
    }
});

// start app
router.start(App, '#app');

