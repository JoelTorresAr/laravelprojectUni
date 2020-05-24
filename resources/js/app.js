require('./bootstrap');

// --Vue--
window.Vue = require('vue');

//suport Componentes
Vue.component('spinner', require('./vue/widgets/Spinner').default);
//Vue.component('staff-table', require('./components/admin/staff/staffTable').default);

//suport Rutas
import router from './vue/plugins/routes'

//support Formularios
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//support vue-the-mask
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

//support vuetify
import vuetify from './vue/plugins/vuetify'

//support Laravel permission to vuejs
import LaravelPermissionToVueJS from './vue/plugins/laravel-permission-to-vuejs'
Vue.use(LaravelPermissionToVueJS)

// support vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./vue/store/index"
const store = new Vuex.Store(storeData)

const app = new Vue({
    el: '#app',
    router,
    vuetify,
    store
});