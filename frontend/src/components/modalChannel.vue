<template>
  <div>
    <div class="modal fade" id="modalCadastrarChannel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Canal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="simpleinput" class="form-label">Nome do Canal</label>
              <input type="text" id="simpleinput" v-model="nomeChannel" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" @click="criarChannel">Confirmar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import custom from '@/assets/js/custom';
export default {
  name: 'ModalChannel',
  data() {
    return {
      nomeChannel: ''
    };
  },
  methods: {
    async criarChannel() {
      try {
        let token = custom.getCookie('token-session');
        const id = this.$route.params.id;
        let Json_dados = {
          NOME: this.nomeChannel,
          ID_GUILD: id
        }
        $('#modalCadastrarChannel').modal('hide');
        custom.loading('CADASTRANDO');
        const response = await custom.postDados(`api/guilds/${id}/channel`, JSON.stringify(Json_dados), token);
        if (response.status === 'success') {
          this.$emit('channelCriado', { ID_CHANNEL: response.ID_CHANNEL, NOME_CHANNEL: this.nomeChannel.toUpperCase(), });
          this.nomeChannel = '';
        }
        custom.statusAlert(response);
      } catch (error) {
        custom.statusAlert(error);
        console.error('Erro ao criar o channel:', error);
      }

    },


  }



}
</script>

<style></style>