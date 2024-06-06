import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import 'bootstrap/dist/css/bootstrap.css';
import 'jquery/dist/jquery.min';
import 'popper.js/dist/popper.min';
import 'bootstrap/dist/js/bootstrap.min';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.baseURL = `http://localhost:8000`;

import store from './store/store';
const app = createApp(App);


app.use(router);

app.use(store);

app.mount('#app');
