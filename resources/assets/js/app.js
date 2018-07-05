
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');
var Inputmask = require('inputmask');
window.download = require("downloadjs");
window.EventBus = new Vue();
window.currencyFormatter = require('currency-formatter');

Vue.directive('input-mask-currency', {
	bind: function(el) {
		//new Inputmask()
		Inputmask('currency',{prefix: "R$", radixPoint: ",", autoUnmask: true}).mask(el);
	},
});

Vue.directive('focus', {
    inserted: function (el) {
        el.focus()
    }
});


import {ServerTable,Event} from 'vue-tables-2';
import {Pagination} from 'vue-pagination-2';
import VueCircle from "vue2-circle-progress";
import _ from 'lodash'; 
import VueRangedatePicker from 'vue-rangedate-picker';

Vue.use(ServerTable);
Vue.use(VueRangedatePicker);

Vue.component('youcon-component', require('./components/Youcon.vue') );
Vue.component('simulacao-app', require('./components/Simulacao.vue') );
Vue.component('btn-favorite', require('./components/Favorite.vue') );
Vue.component('vue-circle', VueCircle);
Vue.component('rangedate-picker', VueRangedatePicker);
Vue.component('app-bemvindo', require('./components/Bemvindo.vue'));
Vue.component('tesouros-app', require('./components/Tesouros.vue'));
//Vue.component('list', require('./components/ListComponent.vue') );

//Vue.use(ServerTable, [options = {}], [useVuex = false], [theme = 'bootstrap3'], [template = 'default']);

/*Vue.component('vue-list-component', require('./components/ListComponent.vue'));
window.addEventListener('load', function () {
	const app = new Vue({
	    el: '#vue-list',
	});
});*/