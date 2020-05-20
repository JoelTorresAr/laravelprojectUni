import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

let routes = [{
        path: '/admin/dashboard',
        name: 'dashboard',
        component: require('./views/admin/Dahsboard.vue').default,
    },
    {
        path: '/admin/staff',
        name: 'staff',
        component: require('./views/admin/staff/StaffTable').default
    },
    {
        path: '/admin/credentials',
        name: 'credentials',
        component: require('./views/admin/credentials/Credentials').default
    },
    {
        path: '/admin/roles',
        name: 'roles',
        component: require('./views/admin/permissions/Role.vue').default
    },
    {
        path: '/admin/*',
        component: require('./views/404').default
    },

]

export default new Router({
    routes: routes,
    mode: 'history'
})