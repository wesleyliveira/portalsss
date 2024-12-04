<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref } from 'vue'

const isLoggedIn = ref(!!localStorage.getItem('auth_token')) // Verifica se o usuário está logado
</script>

<template>
  <div>
    <!-- Navbar será exibida apenas se o usuário estiver logado -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" v-if="isLoggedIn">
      <div class="container-fluid">
        <RouterLink class="navbar-brand" to="/">MeuApp</RouterLink>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/dashboard">Dashboard</RouterLink>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Se não estiver logado, exibe o link para Login -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" v-else>
      <div class="container-fluid">
        <RouterLink class="navbar-brand" to="/">PortalSSS</RouterLink>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>
.navbar {
  margin-bottom: 20px;
}
</style>
