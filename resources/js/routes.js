//Authentication
const login = require('./components/auth/LoginComponent.vue').default
const register = require('./components/auth/RegisterComponent.vue').default
const forgot = require('./components/auth/ForgotPasswordComponent.vue').default
const logout = require('./components/auth/LogoutComponent.vue').default
const home = require('./components/HomeComponent.vue').default

// employees
const employeeCreate = require('./components/employee/CreateComponent.vue').default
const employeeIndex = require('./components/employee/IndexComponent.vue').default
const employeeEdit = require('./components/employee/EditComponent.vue').default

//suppliers
const supplierCreate = require('./components/supplier/CreateComponent.vue').default
const supplierIndex = require('./components/supplier/IndexComponent.vue').default
const supplierEdit = require('./components/supplier/EditComponent.vue').default

//categories
const categoryCreate = require('./components/category/CreateComponent.vue').default
const categoryIndex = require('./components/category/IndexComponent.vue').default
const categoryEdit = require('./components/category/EditComponent.vue').default

//products
const productCreate = require('./components/product/CreateComponent.vue').default
const productIndex = require('./components/product/IndexComponent.vue').default
const productEdit = require('./components/product/EditComponent.vue').default

//expense
const expenseCreate = require('./components/expense/CreateComponent.vue').default
const expenseIndex = require('./components/expense/IndexComponent.vue').default
const expenseEdit = require('./components/expense/EditComponent.vue').default


//Salary
const salaryEmployee = require('./components/salary/EmployeeSalaryComponent.vue').default
const paySalary = require('./components/salary/CreateComponent.vue').default
const paidSalary = require('./components/salary/IndexComponent.vue').default
const viewSalary = require('./components/salary/ViewSalaryComponent.vue').default
const salaryEdit = require('./components/salary/EditComponent.vue').default

//Product stock
const productStock = require('./components/product/StockComponent.vue').default
const editStock = require('./components/product/EditStockComponent.vue').default

export const routes = [

    // authentication starts
    { path: '/', component: login, name: 'login' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forgot-password', component: forgot, name: 'forgot' },
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/home', component: home, name: 'home' },

    //employee starts
    { path: '/employee/create', component: employeeCreate, name: 'employee-create' },
    { path: '/employees', component: employeeIndex, name: 'employee-index' },
    { path: '/employees/edit/:id', component: employeeEdit, name: 'employee-edit' },

    //supplier starts
    { path: '/suppliers/create', component: supplierCreate, name: 'supplier-create' },
    { path: '/suppliers', component: supplierIndex, name: 'supplier-index' },
    { path: '/suppliers/edit/:id', component: supplierEdit, name: 'supplier-edit' },

    //category starts
    { path: '/categories/create', component: categoryCreate, name: 'category-create' },
    { path: '/categories', component: categoryIndex, name: 'category-index' },
    { path: '/categories/edit/:id', component: categoryEdit, name: 'category-edit' },

    //product starts
    { path: '/products/create', component: productCreate, name: 'product-create' },
    { path: '/products', component: productIndex, name: 'product-index' },
    { path: '/products/edit/:id', component: productEdit, name: 'product-edit' },

    //Expense starts
    { path: '/expenses/create', component: expenseCreate, name: 'expense-create' },
    { path: '/expenses', component: expenseIndex, name: 'expense-index' },
    { path: '/expenses/edit/:id', component: expenseEdit, name: 'expense-edit' },

    //Salary starts
    { path: '/employees/salary', component: salaryEmployee, name: 'employee-salary' },
    { path: '/pay-salary/:id', component: paySalary, name: 'pay-salary' },
    { path: '/paid/salaries', component: paidSalary, name: 'paid-salary' },
    { path: '/view-salary/:id', component: viewSalary, name: 'view-salary' },
    { path: '/salaries/edit/:id', component: salaryEdit, name: 'salary-edit' },

    //stocks start
    { path: '/product/stocks', component: productStock, name: 'product-stock' },
    { path: '/stocks/edit/:id', component: editStock, name: 'edit-stock' },


]