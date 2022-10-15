<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">CRUD</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <router-link to="/estado/listar" class="nav-item nav-link">Estados</router-link>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" href="#">Cidades</a> -->
            <router-link to="/about" class="nav-item nav-link">Sobre</router-link>
          </li>
        </ul>
      </div>
    </nav>
    <!-- <router-link to="/estado/inserir" class="nav-item nav-link">Inserir Estado</router-link> -->
    <div class="container">
      <router-view></router-view>
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
}
</style>
