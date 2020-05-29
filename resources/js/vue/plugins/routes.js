import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

let routes = [{
        path: '/admin/dashboard',
        name: 'dashboard',
        component: require('../views/admin/Dahsboard.vue').default,
    },
    {
        path: '/admin/staff',
        name: 'staff',
        component: require('../views/admin/StaffTable').default
    },
    {
        path: '/admin/credentials',
        name: 'credentials',
        component: require('../views/admin/Credentials').default
    },
    {
        path: '/admin/permissions',
        name: 'permissions',
        component: require('../views/admin/Permissions').default
    },
    {
        path: '/admin/roles',
        name: 'roles',
        component: require('../views/admin/Roles').default
    },
    {
        path: '/admin/workstations',
        name: 'workstations',
        component: require('../views/admin/Workstations').default
    },
    {
        path: '/admin/workpositions',
        name: 'workpositions',
        component: require('../views/admin/Workpositions').default
    },
    {
        path: '/admin/cities',
        name: 'cities',
        component: require('../views/admin/Cities').default
    },
    {
        path: '/admin/districts',
        name: 'districts',
        component: require('../views/admin/Districts').default
    },
    {
        path: '/admin/subsidiaries',
        name: 'subsidiaries',
        component: require('../views/admin/Subsidiaries').default
    },
    {
        path: '/admin/offers',
        name: 'offers',
        component: require('../views/admin/Offers').default
    },
    {
        path: '/admin/providers',
        name: 'providers',
        component: require('../views/admin/Providers').default
    },
    {
        path: '/admin/categories',
        name: 'categories',
        component: require('../views/admin/Categories').default
    },
    {
        path: '/admin/igvs',
        name: 'igvs',
        component: require('../views/admin/Igvs').default
    },
    {
        path: '/admin/*',
        component: require('../views/404.vue').default
    },

]

export default new Router({
    routes: routes,
    mode: 'history'
})