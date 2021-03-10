import axios from 'axios';
import _ from 'lodash';
import Vue from 'vue';
import jQuery from 'jquery';
import moment from 'moment';
import jstree from 'jstree/dist/jstree.min'

window.$ = window.jQuery = jQuery;
window.Vue = Vue;
window._ = _;
window.axios = axios;
window.moment = moment;
window.jstree = jstree;

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
//    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    let ajaxSettings = {
        'cache': false,
        "async": true,
        "crossDomain": true
    }
    $.ajaxSetup(ajaxSettings);
}
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
