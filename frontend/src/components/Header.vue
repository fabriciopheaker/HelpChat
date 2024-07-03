<template>
  <header class="header">

    <div class="btnD">
      <form @submit.prevent="logout">
        <button class="btn btn-danger px-3">Sair</button>
      </form>

    </div>

  </header>
</template>

<script>
import custom from '@/assets/js/custom';

export default {
  name: 'Header',

  methods: {
    async logout() {
      let token = custom.getCookie('token-session');
      let result = await custom.postDados('api/auth/logout', null, token);
      // Limpar o cookie de autenticação
      if (result.status = 'success') {
        custom.destroyCookie('token-session');
      } else {
        console.log('Error ao destruir sessão');
      }

      // Redirecionar para a página de login
      this.$router.push('/login');
    }
  }

};
</script>

<style>
.header {
  width: 100%;
  height: 60px;
  background-color: #101111;
  display: flex;
  align-items: center;
  justify-content: center;
  border-bottom: 1px solid #dee2e6;
  position: fixed;
  top: 0;
  left: 0;
}

.btnD {
  display: flex;
  justify-content: end;
}
</style>
