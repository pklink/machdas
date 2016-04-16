import Vue from 'vue'
import VueResource from 'vue-resource'
import Promise from 'promise'

Vue.use(VueResource)

export const cardService = {

    get(id) {
        return new Promise((resolve, reject) => {
            Vue.http.get(`api/index.php/cards/${id}`).then(response => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    },

    query() {
        return new Promise((resolve, reject) => {
            Vue.http.get('api/index.php/cards').then(response => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    },

    save(model) {
        return new Promise((resolve, reject) => {
            Vue.http.post('api/index.php/cards', model).then(response => {
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
    },

    save(cardId, model) {
        return new Promise((resolve, reject) => {
            Vue.http.post(`api/index.php/cards/${cardId}/tasks`, model).then(response => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    },

    delete(id) {
        return new Promise((resolve, reject) => {
            Vue.http.delete(`api/index.php/tasks/${id}`).then(response => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    },

    update(id, model) {
        return new Promise((resolve, reject) => {
            Vue.http.put(`api/index.php/tasks/${id}`, model).then(response => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    }

}
