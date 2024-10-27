import { createRouter, createWebHistory } from 'vue-router'
import ChessboardView from '../views/ChessboardView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/chessboard',
      name: 'chessboard',
      component: ChessboardView
    }
  ]
})

export default router
