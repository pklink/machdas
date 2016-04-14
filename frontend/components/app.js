import Vue from 'vue';
import key from 'keymaster';

export default Vue.extend({

    template: require('./views/app.html'),

    ready() {
        // create new task
        key('n', () => {
            this.$broadcast('tasks.new');
            return false;
        });

        // create new card
        key('c', () => {
            this.$broadcast('cards.new');
            return false;
        });

        // go to help
        key('h', () => {
            this.$route.router.go({ name: 'help' });
        });
    }

});
