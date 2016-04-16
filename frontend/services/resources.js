import Vue from 'vue'
import VueResource from 'vue-resource'
import Promise from 'promise'

Vue.use(VueResource)

export const CardsResource = Vue.resource('api/index.php/cards{/id}')
export const TasksResource = Vue.resource('api/index.php/tasks{/id}', null, {
    save: {
        method: 'POST',
        url: 'api/index.php/cards/{id}/tasks'
    },
    queryByCardId: {
        method: 'GET',
        url: 'api/index.php/cards/{id}/tasks'
    }
})

export const cardService = {

    get(id) {
        return new Promise((resolve, reject) => {
            Vue.http.get(`api/index.php/cards/${id}`).then(response => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    }

}

export const taskService = {

    queryByCardId(id) {
        return new Promise((resolve, reject) => {
            Vue.http.get(`api/index.php/cards/${id}/tasks`).then(response => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    }

}
