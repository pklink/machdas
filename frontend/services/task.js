import Vue from 'vue'
import Promise from 'promise'
import eventEmitter from './event-emitter'

export default {

    countByCards() {
        return new Promise((resolve, reject) => {
            Vue.http.get('api/index.php/cards/tasks/count').then(response => {
                resolve(response.json())
            }, error => {
                reject(error)
            })
        })
    },

    create(cardId, model) {
        return new Promise((resolve, reject) => {
            Vue.http.post(`api/index.php/cards/${cardId}/tasks`, model).then(response => {
                eventEmitter.emit('tasks.created', response.json())
                resolve(response.json())
            }, error => {
                reject(error)
            })
        })
    },

    delete(model) {
        return new Promise((resolve, reject) => {
            Vue.http.delete(`api/index.php/tasks/${model.id}`).then(() => {
                eventEmitter.emit('tasks.deleted', model)
                resolve()
            }, error => {
                reject(error)
            })
        })
    },

    queryByCardId(id, params) {
        return new Promise((resolve, reject) => {
            Vue.http.get(`api/index.php/cards/${id}/tasks`, params).then(response => {
                resolve(response.json())
            }, error => {
                reject(error)
            })
        })
    },

    update(id, model) {
        return new Promise((resolve, reject) => {
            Vue.http.put(`api/index.php/tasks/${id}`, model).then(response => {
                eventEmitter.emit('tasks.updated', response)
                resolve()
            }, error => {
                reject(error)
            })
        })
    }

}
