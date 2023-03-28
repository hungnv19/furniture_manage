require('./bootstrap');

import { createApp } from 'vue';

import $ from "jquery";
import { configure, defineRule } from "vee-validate";



import DashBroad from './components/DashBroad.vue';

import CategoryCreate from './components/category/create.vue';
import CategoryEdit from './components/category/edit.vue';

import UserCreate from './components/user/create.vue';
import UserEdit from './components/user/edit.vue';

import ProductCreate from './components/product/create.vue';
import ProductEdit from './components/product/edit.vue';

import CustomerCreate from './components/customer/create.vue';
import CustomerEdit from './components/customer/edit.vue';

import LoginForm from './components/auth/login/index.vue';
import RegisterForm from './components/auth/register/index.vue';

import BookingCreate from './components/booking/create.vue';
import BookingEdit from './components/booking/edit.vue';

import StockEdit from './components/stock/edit.vue';

import CalendarShow from './components/booking/calendar.vue';



const app = createApp({});

app.component("dash-broad", DashBroad);

app.component("category-create", CategoryCreate);
app.component("category-edit", CategoryEdit);

app.component("booking-create", BookingCreate);
app.component("booking-edit", BookingEdit);

app.component("user-create", UserCreate);
app.component("user-edit", UserEdit);

app.component("product-create", ProductCreate);
app.component("product-edit", ProductEdit);

app.component("customer-create", CustomerCreate);
app.component("customer-edit", CustomerEdit);

app.component("stock-edit", StockEdit);

app.component("calendar-show", CalendarShow);

app.component("login-form", LoginForm);
app.component("register-form", RegisterForm);



app.mount("#app");