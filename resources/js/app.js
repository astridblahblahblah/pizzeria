import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';

import './bootstrap'
import './assets/css/app.css'

import Pizzas from './pages/pizzas/index.vue';
import PizzaEdit from './pages/pizzas/edit.vue';

const routes = [
    { path: '/pizzas', component: Pizzas },
    { path: '/pizzas/:id/edit', component: PizzaEdit },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp(App);
app.use(router);
app.mount('#app');

