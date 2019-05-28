/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('rtl-bootstrap');
// require('./bootstrap');

$ = require('jquery');
$.fn.load = function (callback) {
    jQuery(window).on("load", callback)
};
window.Vue = require('vue');
require('dropzone');
require('./my-vue');

// require('./footer-reveal.min');
require('./home');


