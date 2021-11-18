require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import { routes } from './routes';
// importing helpers class
import User from './helpers/User';

window.User = User;

//importing Sweet alert
import Swal from 'sweetalert2';
// const Swal = require('sweetalert2')
window.Swal = Swal;


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;

// importing Noty as a global 
import Notification from './helpers/Notification';
window.Notification = Notification;
window.bus = new Vue();

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})





const app = new Vue({
    el: '#app',
    router
});
