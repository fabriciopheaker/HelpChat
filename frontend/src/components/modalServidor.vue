<template>
  <div>
    <div class="modal fade" id="modalCadastrarServidor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Servidor</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="simpleinput" class="form-label">Nome do Servidor</label>
              <input type="text" id="simpleinput" v-model="nomeServidor" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" @click="criarServidor">Confirmar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import custom from '@/assets/js/custom';
export default {
  name: 'ModalServidor',
  data() {
    return {
      nomeServidor: ''
    };
  },
  methods: {
    async criarServidor() {
      try {
        let token = custom.getCookie('token-session');
        let Json_dados = {
          NOME: this.nomeServidor
        }
        $('#modalCadastrarServidor').modal('hide');
        custom.loading('CADASTRANDO');
        const response = await custom.postDados('api/guilds', JSON.stringify(Json_dados), token);
        console.log(response);
        if (response.status === 'success') {
          this.$emit('servidorCriado', { ID_GUILD: response.ID_GUILD, NOME_GUILD: this.nomeServidor.toUpperCase(), });
          this.nomeServidor = '';
        }
        custom.statusAlert(response);
      } catch (error) {
        custom.statusAlert(error);
        console.error('Erro ao criar o servidor:', error);
      }
    },


  }



}
</script>

<style></style>