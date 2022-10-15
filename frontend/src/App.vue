<template>
  <div id="app">
    <div class="container">
      <div class="row">
        <router-link to="/" class="nav-item nav-link">Home</router-link>
        <router-link to="/about" class="nav-item nav-link">Sobre</router-link>
        <router-link to="/estado/listar" class="nav-item nav-link">Estados</router-link>
        <router-link to="/estado/inserir" class="nav-item nav-link">Inserir Estado</router-link>
      </div>
      <div class="row">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'App',
  components: {}
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
