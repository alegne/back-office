require('./bootstrap');

require('alpinejs');


// VueJS

window.Vue = require('vue');

Vue.component('etudiant-filter-page', require('./components/EtudiantFilter.vue').default);

const app = new Vue({
    el: '#etudiant-filter',
});
