import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;



window.Echo = new Echo({
  broadcaster: 'reverb',
  key: 'fds0pkiene3pwgsfbune',
  wsHost: window.location.hostname,
  wsPort: 9000,
  wssPort: 9000,
  forceTLS: false,
  enabledTransports: ['ws', 'wss'],
});




const app = createApp(App)

app.use(router)

app.mount('#app')
