
require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('negociacao-component', require('./components/NegociacaoComponent.vue').default);

const app = new Vue({
    el: '#app',
});
