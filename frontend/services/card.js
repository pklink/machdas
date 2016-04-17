import Vue from 'vue'
import Promise from 'promise'
import eventEmitter from './event-emitter'

export default {

    create(model) {
        return new Promise((resolve, reject) => {
            Vue.http.post('api/index.php/cards', model).then((response) => {
                eventEmitter.emit('cards.created', response.data)
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    },

    get(id) {
        return new Promise((resolve, reject) => {
            Vue.http.get(`api/index.php/cards/${id}`).then((response) => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    },

    query() {
        return new Promise((resolve, reject) => {
            Vue.http.get('api/index.php/cards').then((response) => {
                resolve(response.data)
            }, error => {
                reject(error)
            })
        })
    },

    update(model) {
        return new Promise((resolve, reject) => {
            Vue.http.put(`api/index.php/cards/${model.id}`, model).then(() => {
                eventEmitter.emit('cards.updated', model)
                resolve(model)
            }, error => {
                reject(error)
            })
        })
    }

}
