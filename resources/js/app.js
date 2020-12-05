/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

window.Vue = require('vue')
import router from './router'
import store from './store'

Vue.component('layout', require('./components/layout.vue').default)

const app = new Vue({
    el: '#app',
    router,
    store,
    computed: {
        name: {
            get() {
                return this.$store.state.name
            },
            set(value) {
                this.$store.commit('updateName', value)
            }
        }
    }
})