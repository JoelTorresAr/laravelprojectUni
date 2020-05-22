require('./bootstrap');

// --Vue--
window.Vue = require('vue');

// Componentes
Vue.component('spinner', require('./vue/widgets/Spinner').default);
//Vue.component('staff-table', require('./components/admin/staff/staffTable').default);

// Rutas
import router from './vue/plugins/routes'

// Formularios
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// vue-the-mask
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

// vuetify
import vuetify from './vue/plugins/vuetify'

//Laravel permission to vuejs
import LaravelPermissionToVueJS from './vue/plugins/laravel-permission-to-vuejs';
Vue.use(LaravelPermissionToVueJS);

const app = new Vue({
    el: '#app',
    router,
    vuetify
});