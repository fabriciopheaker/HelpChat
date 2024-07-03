<template>
  <header>
    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />
    <div class="wrapper">
      <nav>
        <div v-if="!authenticated">
          <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/login">Login</RouterLink>
          <RouterLink to="/register">Registrar</RouterLink>
        </div>

        <!-- Link para usuário conectado -->
        <div v-if="authenticated">
          <RouterLink to="/dashboard"><button class="btn btn-success px-4"> Entrar</button></RouterLink>
        </div>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<script>
import '@/assets/css/app-saas.min.css';
import '@/assets/css/icons.min.css';
import custom from '@/assets/js/custom';

export default {
  data() {
    return {
      authenticated: false // Supondo que inicialmente o usuário não está autenticado
    };
  },
  mounted() {
    this.conectado();
  },
  methods: {
    async conectado() {
      let token = custom.getCookie('token-session');
      this.authenticated = token ? true : false; // Corrigido para atribuir a variável do componente
    }
  }
};
</script>

<style scoped>
/* Estilos do componente */
</style>
