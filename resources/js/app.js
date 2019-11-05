/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//load custom js files
require('./jquery-migrate.min.js');
require('./jquery.easing.min.js');
require('./jquery.showLoading.min.js');
require('./modal.js');
require('./autosize.min.js');
require('./jquery.mask.js');
require('./password.js');
require('./jquery-ui.js');
require('./jquery.mousewheel.min.js');
require('./select2.min.js');
//require('./mCustomScrollbar.concat.min.js');

import Vue from 'vue';
//import Vuelidate from 'vuelidate';
import * as VeeValidate from 'vee-validate';
import VeeValidateLaravel from 'vee-validate-laravel';

//Vue.use(Vuelidate);

Vue.use(VeeValidate, {inject: true});
Vue.use(VeeValidateLaravel);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('personal-info', require('./components/personalinfo/Index.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#page'
});
