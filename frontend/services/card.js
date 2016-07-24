import Vue from 'vue'
import Promise from 'promise'
import eventEmitter from './event-emitter'

export default {

    create(model) {
        return new Promise((resolve, reject) => {
            Vue.http.post('api/index.php/cards', model).then((response) => {
                eventEmitter.emit('cards.created', response.json())
                resolve(response.json())
            }, error => {
                reject(error)
            })
        })
    },

    delete(model) {
        return new Promise((resolve, reject) => {
            Vue.http.delete(`api/index.php/cards/${model.id}`).then(() => {
                eventEmitter.emit('cards.deleted', model)
                resolve()
            }, error => {
                reject(error)
            })
        })
    },

    get(id) {
        return new Promise((resolve, reject) => {
            Vue.http.get(`api/index.php/cards/${id}`).then((response) => {
                resolve(response.json())
            }, error => {
                reject(error)
            })
        })
    },

    query() {
        return new Promise((resolve, reject) => {
            Vue.http.get('api/index.php/cards').then((response) => {
                resolve(response.json())
            }, error => {
                reject(error)
            })
        })
    },

    update(model) {
        return new Promise((resolve, reject) => {
            Vue.http.put(`api/index.php/cards/${model.id}`, model).then(() => {
                eventEmitter.emit('cards.updated', model)
                resolve()
            }, error => {
                reject(error)
            })
        })
    }

}
