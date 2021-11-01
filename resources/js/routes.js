
const login = require('./components/auth/LoginComponent.vue').default
const register = require('./components/auth/RegisterComponent.vue').default
const forgot = require('./components/auth/ForgotPasswordComponent.vue').default



export const routes = [
    { path: '/', component: login, name: 'login' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forgot-password', component: forgot, name: 'forgot' },
]