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





const app = createApp({});

app.component("dash-broad", DashBroad);

app.component("category-create", CategoryCreate);
app.component("category-edit", CategoryEdit);

app.component("user-create", UserCreate);
app.component("user-edit", UserEdit);

app.component("product-create", ProductCreate);
app.component("product-edit", ProductEdit);

app.component("customer-create", CustomerCreate);
app.component("customer-edit", CustomerEdit);



app.mount("#app");