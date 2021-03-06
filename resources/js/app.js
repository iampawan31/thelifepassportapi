/* eslint-disable no-unused-vars */
/* eslint-disable no-useless-escape */
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

//load custom js files
require("./jquery-migrate.min.js");
require("./jquery.easing.min.js");
require("./jquery.showLoading.min.js");
require("./modal.js");
require("./autosize.min.js");
require("./jquery.mask.js");
require("./password.js");
require("./jquery-ui.js");
require("./jquery.mousewheel.min.js");
require("./select2.min.js");
require("./mCustomScrollbar.concat.min.js");
require("./jquery-mousewheel.js");

import Vue from "vue";
import VueRouter from "vue-router";
import { ValidationProvider, extend } from "vee-validate";
import {
    required,
    max,
    alpha_spaces,
    alpha_num,
    email,
    required_if,
    regex
} from "vee-validate/dist/rules";
import VeeValidateLaravel from "vee-validate-laravel";
import VueSweetalert2 from "vue-sweetalert2";
import VueMask from "v-mask";
import "sweetalert2/dist/sweetalert2.min.css";

import { routes } from "./routes";

extend("max", max);
extend("alpha_spaces", alpha_spaces);
extend("email", email);
extend("alpha_num", alpha_num);
extend("required_if", required_if);
extend("regex", regex);
extend("required", {
    ...required,
    message: "This {_field_} is required"
});

extend("is_phone", value => {
    var phoneRegex = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    if (value.match(phoneRegex)) {
        return true;
    }
    return "Phone Number should be valid and should contain 10 digits";
});

extend("address", value => {
    var addressRegex = /^[\w .,!?-]+$/;
    if (value.match(addressRegex)) {
        return true;
    }

    return "The {_field_} must contain only Alphanumeric and Special Characters (,.-?!)";
});

extend("date", value => {
    var dateRegex = /^(?:(0[1-9]|1[012])[\/.](0[1-9]|[12][0-9]|3[01])[\/.](19|20)[0-9]{2})$/;
    if (value.match(dateRegex)) {
        return true;
    }

    return "The {_field_} must be a valid date (mm/dd/yyyy)";
});

extend("website", value => {
    var addressRegex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
    if (value.match(addressRegex)) {
        return true;
    }

    return "The {_field_} must be a valid URL";
});

Vue.use(VueRouter);
Vue.use(VeeValidateLaravel);
Vue.use(VueSweetalert2);
Vue.use(VueMask);

const router = new VueRouter({
    routes
});
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
Vue.component(
    "personal-info",
    require("./components/personalinfo/Index.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component("ValidationProvider", ValidationProvider);

const app = new Vue({
    el: "#page",
    router
});
