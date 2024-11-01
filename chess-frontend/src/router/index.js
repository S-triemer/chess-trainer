import { createRouter, createWebHistory } from 'vue-router'
import ChessboardView from '../views/ChessboardView.vue'
import LoginView from '../views/LoginView.vue'
import UserView from '../views/UserView.vue'
import RegisterView from '../views/RegisterView.vue'

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
    },
    {
      path: '/user',
      name: 'userPage',
      component: UserView
    },
    {
      path: '/register',
      name: 'registerPage',
      component: RegisterView
    }
  ]
})

export default router
