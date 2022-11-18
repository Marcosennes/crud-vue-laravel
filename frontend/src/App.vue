<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div id="title-text">
        <a class="navbar-brand" href="#">CRUD</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <router-link to="/" class="nav-item nav-link">Estados</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/cidade/listar" class="nav-item nav-link">Cidades</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/motion" class="nav-item nav-link">Motion</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/redis" class="nav-item nav-link">Redis</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/estudos" class="nav-item nav-link">Estudos</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/login" class="nav-item nav-link">Login</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/logged" class="nav-item nav-link">Logado</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/redefinir_senha" class="nav-item nav-link">Redefinir Senha</router-link>
          </li>
        </ul>
      </div>
    </nav>
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
#title-text{
  margin-left: 20px;
}
</style>
