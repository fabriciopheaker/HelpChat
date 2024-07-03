<template>

  <div class="ServidoresTable mt-5">
    <div class="d-flex justify-content-end">
      <button class="mx-2 px-3 btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrarServidor">Novo Servidor</button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Operações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="guild in guilds" :key="guild.ID_GUILD">
          <td>{{ guild.ID_GUILD }}</td>
          <td>{{ guild.NOME_GUILD }}</td>
          <td>
            <div class="d-flex justify-content-center">
              <button class="mx-2 px-3 btn btn-success" @click="showGuild(guild.ID_GUILD)">Entrar</button>
              <button class="mx-2 px-3 btn btn-danger" @click="deleteServidor(guild.ID_GUILD)">Excluir</button>
            </div>
          </td>
          <!-- Renderize mais campos conforme necessário -->
        </tr>
      </tbody>
    </table>
  </div>

  <modal-servidor @servidorCriado="adicionarServidor" />


</template>

<script>
import custom from '@/assets/js/custom';
import modalServidor from '../components/modalServidor.vue';
export default {
  components: { modalServidor },
  data() {
    return {
      guilds: [],
      nomeServidor: ''
    };
  },
  mounted() {
    this.getGuild();
  },
  methods: {
    async getGuild() {
      try {
        let token = custom.getCookie('token-session')
        const response = await custom.getDados('api/guilds', null, token)
        if (response.status == 'success') {
          this.guilds = response.guilds;
        }
      } catch (error) {
        console.error('Erro ao buscar os servidores:', error);
      }
    },

    async deleteServidor(id) {
      try {
        let token = custom.getCookie('token-session')
        custom.loading('DELETANDO');
        const response = await custom.deleteDados(`api/guilds/${id}`, null, token)
        if (response.status == 'success') {
          this.guilds = this.guilds.filter(guild => guild.ID_GUILD !== id);
        }
      } catch (error) {
        console.error('Erro ao buscar os servidores:', error);
      }
      Swal.close();
    },
    async showGuild(id) {
      this.$router.push(`/servidores/${id}`);
    },

    adicionarServidor(novoServidor) {
      this.guilds.push(novoServidor);
    }

  }
};
</script>

<style scoped>
.ServidoresTable {
  min-width: 700px;
}
</style>