import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router';
import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

// Defina as rotas
const routes = [
  { path: '/', component: Login },
  { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } }, // Rota protegida
];

// Criação do roteador
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Interceptor para verificação de autenticação
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('auth_token');
  
  // Se o usuário não estiver autenticado e tentar acessar o dashboard, redireciona para o login
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!token) {
      next('/');
    } else {
      next();
    }
  } else {
    next(); // Rota pública, segue normalmente
  }
});

// Criação e montagem da app Vue
const app = createApp(App);
app.use(router);
app.mount('#app');
