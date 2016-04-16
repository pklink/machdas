import Vue from 'vue'
import Promise from 'promise'


export default {

    countByCards() {
        return new Promise((resolve, reject) => {
            Vue.http.get('api/index.php/cards/tasks/count').then(response => {
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
