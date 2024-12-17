import Login from './Pages/Auth/Login.vue';
import Dashboard from './Pages/Dashboard.vue';

const routes = [
  { path: '/', component: Login, meta: { requiresAuth: false } },
  { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } },
];

export default routes;