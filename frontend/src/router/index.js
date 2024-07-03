import { createRouter, createWebHistory } from 'vue-router';

import PublicLayout from '@/layouts/PublicLayout.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import HomeView from '@/views/HomeView.vue';
import LoginView from '@/views/LoginView.vue';
import RegisterView from '@/views/RegisterView.vue';
import DashboardView from '@/views/DashboardView.vue';
import custom from '@/assets/js/custom';
import ServidoresView from '@/views/ServidoresView.vue';
import VisualizarServerView from "@/views/VisualizarServerView.vue";
import ChatView from '@/views/ChatView.vue'
// Verifica o cookie de autenticação
const loggedIn = custom.getCookie('token-session');

const routes = [
  {
    path: '/',
    component: PublicLayout,
    children: [
      { path: '', name: 'home', component: HomeView },
      { path: 'login', name: 'login', component: LoginView },
      { path: 'register', name: 'register', component: RegisterView }
    ]
  },
  {
    path: '/',
    component: MainLayout,
    meta: { requiresAuth: true },
    children: [
      { path: 'dashboard', name: 'dashboard', component: DashboardView },
      { path: 'servidores', name: 'servidores', component: ServidoresView },
      { path: '/servidores/:id', name: 'visualizarServer', component: VisualizarServerView },
      { path: '/servidores/:id/channel/:idChannel', name: 'ChatView', component: ChatView },
    ]
  }
];

// Criação do roteador
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});


// Guardião global para verificação de autenticação
router.beforeEach((to, from, next) => {

  if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
    next('/login'); // Redireciona para a página de login se não estiver autenticado
  } else {
    next(); // Permite a navegação
  }
});

export default router;
