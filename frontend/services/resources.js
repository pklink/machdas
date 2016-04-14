import Vue from 'vue';
import VueResource from 'vue-resource';

Vue.use(VueResource);
export const CardsResource = Vue.resource('api/index.php/cards{/id}');
export const TasksResource = Vue.resource('api/index.php/tasks{/id}', null, {
    save: {
        method: 'POST',
        url: 'api/index.php/cards/{id}/tasks'
    },
    queryByCardId: {
        method: 'GET',
        url: 'api/index.php/cards/{id}/tasks'
    }
});
