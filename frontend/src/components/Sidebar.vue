<template>
  <aside class="sidebar">
    <ul>
      <li><router-link to="/dashboard">Dashboard</router-link></li>
      <li><router-link to="/servidores">Servidores</router-link></li>
    </ul>
  </aside>
</template>

<script>
export default {
  name: 'Sidebar'
};
</script>

<style scoped>
.sidebar {
  width: 250px;
  height: calc(100vh - 60px);
  /* altura total menos a altura do header */
  background-color: #343a40;
  color: #fff;
  position: fixed;
  top: 60px;
  /* alinhado com a altura do header */
  left: 0;
  padding: 1rem;
  box-sizing: border-box;
}
</style>
