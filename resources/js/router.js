import Vue from 'vue'
import Router from 'vue-router'
import PersonCard from './components/pages/personcard.vue'
import Second from './components/pages/secondpg.vue'
import Third from './components/pages/thirdpg.vue'

Vue.use(Router)

const routes = [
    {
        path: '/admin/app',
        component: PersonCard
    },
    {
        path: '/admin/secondpg',
        component: Second
    },
    {
        path: '/admin/thirdpg',
        component: Third
    }
]

export default new Router({
    mode: 'history',
    routes
})