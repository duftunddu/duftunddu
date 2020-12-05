import Vue from 'vue'
import Router from 'vue-router'
import First from './components/pages/first.vue'
import Second from './components/pages/second.vue'
import Third from './components/pages/third.vue'

Vue.use(Router)

const routes = [
    {
        path: '/ad/first',
        component: First
    },
    {
        path: '/ad/second',
        component: Second
    },
    {
        path: '/ad/third',
        component: Third
    }
]

export default new Router({
    mode: 'history',
    routes
})