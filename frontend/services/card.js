import Vue from 'vue'
import Promise from 'promise'

export default {

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
