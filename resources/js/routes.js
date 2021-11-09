
const login = require('./components/auth/LoginComponent.vue').default
const register = require('./components/auth/RegisterComponent.vue').default
const forgot = require('./components/auth/ForgotPasswordComponent.vue').default
const logout = require('./components/auth/LogoutComponent.vue').default
const home = require('./components/HomeComponent.vue').default

// employee
const employeeCreate = require('./components/employee/CreateComponent.vue').default
const employeeIndex = require('./components/employee/IndexComponent.vue').default
const employeeEdit = require('./components/employee/EditComponent.vue').default


export const routes = [
    { path: '/', component: login, name: 'login' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forgot-password', component: forgot, name: 'forgot' },
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/home', component: home, name: 'home' },

    //employee starts
    { path: '/employee/create', component: employeeCreate, name: 'employee-create' },
    { path: '/employees', component: employeeIndex, name: 'employee-index' },
    { path: '/employees/edit/:id', component: employeeEdit, name: 'employee-edit' },
]