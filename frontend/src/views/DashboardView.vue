<template>

</template>

<script>
import custom from '@/assets/js/custom'
export default {
  methods: {
    async logout() {
      try {
        //fabricio@coletek.com
        let token = custom.getCookie('token-session')
        let response = await custom.postDados('api/auth/logout', '', token);
      } catch (error) {
        console.log(error);
      }
      custom.destroyCookie('token-session')
      this.$router.push('/'); // Redireciona para a página de login
    }
  }
}
</script>

<style></style>