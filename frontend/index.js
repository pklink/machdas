import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './components/app'
import Cards from './components/app/cards'
import Card from './components/app/cards/card'
import Help from './components/app/help'
import { cardService } from './services/resources'

// register plugins
Vue.use(VueRouter)

// create & configure router
const router = new VueRouter()

router.map({
    '/cards': {
        name: 'cards',
        component: Cards,
        subRoutes: {
            '/': {
                component: {
                    init() {
                        // redirect to first card
                        cardService.query().then(response => {
                            this.$route.router.go({ name: 'card', params: { id: response[0].id } })
                        })
                    }
                }
            },
            '/:id': {
                name: 'card',
                component: Card
            }
        }
    },
    '/help': {
        name: 'help',
        component: Help
    }
})

// default redirect to `/cards`
router.redirect({
    '/': '/cards'
})

// start app
router.start(App, '#app')

