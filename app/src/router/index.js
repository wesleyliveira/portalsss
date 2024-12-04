import { createRouter, createWebHistory } from 'vue-router'
import Login from '../components/Login.vue'
import Dashboard from '../components/Dashboard.vue'
import axios from '../axios'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: { requiresAuth: true, requiresAdmin: true },
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

router.beforeEach(async (to, from, next) => {
  const token = localStorage.getItem('auth_token')
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!token) {
      next({ name: 'login' })
    } else {
      try {
        const response = await axios.get('/user')
        const user = response.data
        if (to.matched.some(record => record.meta.requiresAdmin) && user.role !== 'admin') {
          next({ name: 'login' })
        } else {
          next()
        }
      } catch (error) {
        localStorage.removeItem('auth_token')
        next({ name: 'login' })
      }
    }
  } else {
    next()
  }
})

export default router