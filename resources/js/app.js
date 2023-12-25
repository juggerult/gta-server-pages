import './bootstrap';
import { createApp } from "vue";
import axios from 'axios';
import MainHeader from './src/MainHeader.vue';
import Router from './src/router/router.js';

createApp(MainHeader)
    .use(Router)
    .mount('#app');
