import axios from 'axios';
import _ from 'lodash';
import Vue from 'vue';
import jQuery from 'jquery';
import moment from 'moment';

window.$ = window.jQuery = jQuery;
window.Vue = Vue;
window._ = _;
window.axios = axios;
window.moment = moment;

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    let ajaxSettings = {
        'cache': false,
//        'dataType': "jsonp",
        "async": true,
        "crossDomain": true,
        "headers": {
            "X-CSRF-TOKEN": token.content,
//            "X-Requested-With": "XMLHttpRequest",
            "Accept": "application/json",
//            "Content-Type": "application/json",
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Methods":"*",
            "Access-Control-Allow-Headers": "x-requested-with",
//            "Access-Control-Allow-Headers": "*",
        }
    }
    $.ajaxSetup(ajaxSettings);
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
