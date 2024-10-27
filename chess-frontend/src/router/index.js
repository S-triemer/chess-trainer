import { createRouter, createWebHistory } from 'vue-router'
import ChessboardView from '../views/ChessboardView.vue'
import LoginView from '../views/LoginView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/chessboard',
      name: 'chessboard',
      component: ChessboardView
    },
    {
      path: '/',
      name: 'login',
      component: LoginView
    }
  ]
})

export default router
