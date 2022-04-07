import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/register',
    name: 'register',
    component: () => import( '../views/Register.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import( '../views/Login.vue')
  },
  {
    path: '/loginAdmin',
    name: 'loginAdmin',
    component: () => import( '../views/LoginAdmin.vue')
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('../views/Dashboard.vue')
  },
  {
    path: '/DbAdmin',
    name: 'DbAdmin',
    component: () => import('../views/DbAdmin.vue')
  },
  {
    path: '/edit/:id',
    name: 'edit',
    component :()=>import('../views/editRdv.vue')
  },
  {
    path: '/editClient/:id',
    name: 'editClient',
    component :()=>import('../views/editClient.vue')
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
