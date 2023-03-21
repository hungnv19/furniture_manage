require('./bootstrap');

import { createApp } from 'vue';
import DashBroad from './components/DashBroad.vue';


const app = createApp({});
app.component("dash-broad", DashBroad);
app.mount("#app");