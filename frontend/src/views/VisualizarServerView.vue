<template>
  <div class="container my-5">
    <div class="mb-3">
      <h1>Detalhes do Servidor</h1>
    </div>

    <h3>Servidor: {{ servidor.NOME_GUILD }}</h3>
    <p>ID Servidor: {{ servidor.ID_GUILD }}</p>
    <div>
      <div class="d-flex justify-content-end">
        <button class="mx-2 px-3 btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrarChannel">Novo Canal</button>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Canal</th>
            <th scope="col" class="d-flex justify-content-center">Operações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="channel in channels" :key="channel.ID_CHANNEL">
            <td>{{ channel.ID_CHANNEL }}</td>
            <td>{{ channel.NOME_CHANNEL }}</td>
            <td>
              <div class="d-flex justify-content-center">
                <button class="mx-2 px-3 btn btn-success" @click="showChannel(channel.ID_CHANNEL)">Entrar</button>
              </div>
            </td>
            <!-- Renderize mais campos conforme necessário -->
          </tr>
        </tbody>
      </table>


    </div>


    <modal-channel @channelCriado="adicionarChannel" />
  </div>
</template>

<script>
import custom from '@/assets/js/custom';
import modalChannel from '../components/modalChannel.vue';

export default {
  components: { modalChannel },
  data() {
    return {
      servidor: {},
      channels: {}
    };
  },
  mounted() {
    this.getServidor();
    this.getChannels();
  },
  methods: {
    async getServidor() {
      const id = this.$route.params.id;
      try {
        let token = custom.getCookie('token-session');
        const response = await custom.getDados(`api/guilds/${id}`, null, token);
        if (response.status === 'success') {
          this.servidor = response.guilds;
        }
      } catch (error) {
        console.error('Erro ao buscar os detalhes do servidor:', error);
      }
    },

    async getChannels() {
      const id = this.$route.params.id;
      try {
        let token = custom.getCookie('token-session');
        const response = await custom.getDados(`api/guilds/${id}/channel`, null, token);
        if (response.status === 'success') {
          this.channels = response.channels;
        }
      } catch (error) {
        console.error('Erro ao buscar os detalhes do servidor:', error);
      }
    },

    async showChannel(idChannel) {
      const id = this.$route.params.id;
      this.$router.push(`/servidores/${id}/channel/${idChannel}`);
    },


    adicionarChannel(novoChannel) {
      this.channels.push(novoChannel);
    }

  }

};
</script>

<style scoped>
.container {
  min-width: 1000px;
}
</style>