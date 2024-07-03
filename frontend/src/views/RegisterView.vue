<template>
  <form @submit.prevent="registerUser">
    <div>
      <h1 class="text-center"> Registro</h1>
    </div>

    <div class="mb-3">
      <label for="emailaddress" class="form-label">Nome</label>
      <input class="form-control" type="text" id="NOME_REGISTER" v-model="nome" required="" placeholder="Entre com seu nome">
    </div>

    <div class="mb-3">
      <label for="emailaddress" class="form-label">Email</label>
      <input class="form-control" type="email" id="EMAIL_REGISTER" v-model="email" required="" placeholder="Entre com seu email">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Senha</label>
      <div class="input-group input-group-merge">
        <input type="password" id="SENHA_REGISTER" v-model="password" class="form-control" placeholder="Entre com sua senha">
      </div>
    </div>


    <div class="mb-3 mb-0 text-center">
      <button class="btn btn-primary" type="submit"> REGISTRAR </button>
    </div>

  </form>
</template>

<script>
import custom from '@/assets/js/custom'


export default {
  data() {
    return {
      nome: '',
      email: '',
      password: ''
    };
  },
  methods: {
    async registerUser() {
      const userData = {
        NOME: this.nome.toUpperCase(),
        EMAIL: this.email.toUpperCase(),
        PASSWORD: this.password
      };

      try {
        const response = await custom.postDados('api/auth/register', userData);
        // Lida com a resposta de sucesso, como redirecionar o usuário ou exibir uma mensagem
      } catch (error) {
        console.error('Erro ao registrar usuário:', error);
        // Lida com o erro, como exibir uma mensagem ao usuário
      }
    }
  }

};
</script>

<style></style>