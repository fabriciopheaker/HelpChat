<template>
  <div class="container">
    <main class="content">
      <div class="col-12 col-lg-7 col-xl-9">
        <div class="position-relative">
          <div class="chat-messages p-4">
            <!-- mensagens dos users -->

            <div v-for="message in messages" :key="message.ID_CHAT">
              <div v-if="message.AUTHOR === true" class="chat-message-right pb-4">
                <div>
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                  <div class="text-muted small text-nowrap mt-2">{{ message.HORARIO }}</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                  <div class="font-weight-bold mb-1">{{ message.NOME }}(Você)</div>
                  {{ message.MSG }}
                </div>
              </div>

              <div class="chat-message-left pb-4" v-else>
                <div>
                  <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                  <div class="text-muted small text-nowrap mt-2">{{ message.HORARIO }}</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                  <div class="font-weight-bold mb-1">{{ message.NOME }}</div>
                  {{ message.MSG }}
                </div>
              </div>
            </div>
            <!-- fim das msgs dos users -->
          </div>
        </div>

        <div class="flex-grow-0 py-3 px-4 border-top">

          <form @submit.prevent="EnviarMsg()" class="input-group">
            <input type="text" class="form-control" v-model="msg" placeholder="Escreva sua mensagem">
            <button class="btn btn-primary">Enviar</button>
          </form>

        </div>

      </div>
    </main>
  </div>
</template>

<script>
import '@/assets/css/app-saas.min.css'
import '@/assets/css/icons.min.css'
import custom from '@/assets/js/custom';




export default {
  name: 'Chat',




  data() {
    return {
      msg: '',
      messages: []
    };
  },
  mounted() {
    this.getAllMensagens(),

      Echo.channel('chatroom').listen('.ChatMessage', (message) => {
        console.log(message);
        this.messages.push(message);
        // Atualize sua interface ou execute qualquer ação necessária
      });


  },
  methods: {
    async EnviarMsg() {
      const id = this.$route.params.id;
      const idChannel = this.$route.params.idChannel;
      try {
        let token = custom.getCookie('token-session');
        let Json_dados = {
          MSG: this.msg,
          ID_GUILD: id,
          ID_CHANNEL: idChannel
        }
        const response = await custom.postDados(`api/guilds/${id}/channel/${idChannel}/messages`, JSON.stringify(Json_dados), token);
        if (response.status === 'success') {
          this.msg = ''
        }
      } catch (error) {
        console.log(error);
        //console.error('Erro ao buscar os detalhes do servidor:', error);
      }
    },

    async getAllMensagens() {
      const id = this.$route.params.id;
      const idChannel = this.$route.params.idChannel;

      try {
        let token = custom.getCookie('token-session');
        const response = await custom.getDados(`api/guilds/${id}/channel/${idChannel}/messages`, null, token);
        if (response.status === 'success') {
          this.messages = response.messages; // Atualiza o array de mensagens com os dados recebidos
        }
      } catch (error) {
        console.log(error);
        //console.error('Erro ao buscar os detalhes do servidor:', error);
      }
    },

    async deletarMsg(id) {
      console.log(id);
    }

  }


};



</script>



<style>
.container {
  min-width: 1000px;
}

.chat-online {
  color: #34ce57
}

.chat-offline {
  color: #e4606d
}

.chat-messages {
  display: flex;
  flex-direction: column;
  max-height: 800px;
  overflow-y: scroll
}

.chat-message-left,
.chat-message-right {
  display: flex;
  flex-shrink: 0
}

.chat-message-left {
  margin-right: auto
}

.chat-message-right {
  flex-direction: row-reverse;
  margin-left: auto
}

.py-3 {
  padding-top: 1rem !important;
  padding-bottom: 1rem !important;
}

.px-4 {
  padding-right: 1.5rem !important;
  padding-left: 1.5rem !important;
}

.flex-grow-0 {
  flex-grow: 0 !important;
}

.border-top {
  border-top: 1px solid #dee2e6 !important;
}
</style>