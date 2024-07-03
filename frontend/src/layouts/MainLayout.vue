<template>
  <div class="main-layout">
    <Header />
    <Sidebar />
    <div class="content">
      <router-view></router-view>
    </div>
    <Footer />
  </div>
</template>

<script>
import '@/assets/css/app-saas.min.css'
import '@/assets/css/icons.min.css'
import custom from '@/assets/js/custom'
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';
import Footer from '@/components/Footer.vue';


export default {
  components: { Header, Sidebar, Footer },
  name: 'MainLayout',
};


</script>



<style scoped>
.main-layout {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

.content {
  margin-left: 250px;
  /* Largura da sidebar */
  margin-top: 60px;
  /* Altura do header */
  margin-bottom: 60px;
  /* Altura do footer */
  padding: 1rem;
  overflow-y: auto;
  flex-grow: 1;
}
</style>