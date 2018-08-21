require('./bootstrap');
window.Vue = require('vue');

Vue.component('tasks', require('./components/Tasks.vue'));

const app = new Vue({
    el: '#app'
});
