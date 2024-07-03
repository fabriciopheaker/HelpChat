<template>
  <form @submit.prevent="loginUser">
    <div>
      <h1 class="text-center"> Login </h1>
    </div>

    <div class="mb-3">
      <label for="emailaddress" class="form-label">Email</label>
      <input v-model="email" class="form-control" type="email" id="email" required="" placeholder="Entre com seu email">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Senha</label>
      <div class="input-group input-group-merge">
        <input type="password" v-model="password" id="password" class="form-control" placeholder="Entre com sua senha">
      </div>
    </div>

    <div class="mb-3 mb-3">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="LEMBRAR" checked>
        <label class="form-check-label" for="checkbox-signin">Lembrar-me</label>
      </div>
    </div>

    <div class="mb-3 mb-0 text-center">
      <button class="btn btn-primary" type="submit"> Conectar </button>
    </div>
  </form>
</template>

<script>
import custom from '@/assets/js/custom'


export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async loginUser() {
      const userData = {
        email: this.email.toUpperCase(),
        password: this.password
      };
      try {
        custom.loading('Carregando');
        await custom.getDados('sanctum/csrf-cookie');
        let response = await custom.postDados('api/auth/login', userData);
        let token = response.token_id;
        if (token) {
          custom.setCookie('token-session', token, 7 * 24 * 60);
          window.location.href = '/dashboard'
        }
      } catch (error) {
        console.log(error);
      }
      Swal.close()
    }
  }

};
</script>

<style></style>