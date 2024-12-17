<template>
    <nav class="print:hidden border-b border-gray-100 bg-gradient-to-r from-sky-900 via-sky-800 to-sky-900">
      <!-- Primary Navigation Menu -->
      <div class="print:hidden navbar">
        <div class="flex h-16 justify-between">
          <div class="flex">
            <!-- Logo -->
            <div class="flex flex-shrink-0 items-center">
              <router-link :to="route('dashboard')">
                <!-- <img src="/path/to/logo.png" alt="Logo" class="h-8 w-8"/> -->
              </router-link>
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-8 md:-my-px md:ml-10 md:flex">
              <router-link class="nav-link" :to="route('dashboard')">Dashboard</router-link>
              <!-- Adicione mais links conforme necessário -->
            </div>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <!-- Dropdown de Configurações -->
            <div class="relative ml-3">
              <jet-dropdown align="right" width="48">
                <template #trigger>
                  <button class="botao-foto-perfil">
                    <img class="imagem-foto-perfil" :src="user.profile_photo_url" :alt="user.name"/>
                  </button>
                </template>
                <template #content>
                  <!-- Gerenciamento de conta -->
                  <div class="block px-4 py-2 text-xs text-gray-400">Gerenciar conta</div>
                  <jet-dropdown-link :href="route('profile.show')">Perfil</jet-dropdown-link>
                  <jet-dropdown-link :href="route('usuarios.index')" v-if="user.isAdmin">Usuários</jet-dropdown-link>
                  <jet-dropdown-link :href="route('module.index')" v-if="user.isAdmin">Módulos</jet-dropdown-link>
                  <div class="border-t"></div>
                  <!-- Logout -->
                  <form @submit.prevent="logout">
                    <jet-dropdown-link as="button">Sair</jet-dropdown-link>
                  </form>
                </template>
              </jet-dropdown>
            </div>
          </div>
          <!-- Hamburger -->
          <div class="-mr-2 flex items-center sm:hidden">
            <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="hamburger">
              <svg class="h-6 w-6" stroke="#d8eefc" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </nav>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import JetDropdown from '@/jetstream/Components/Dropdown.vue';
  import JetDropdownLink from '@/jetstream/Components/DropdownLink.vue';
  
  // Definindo a função route manualmente
  function route(name) {
    const routes = {
      'dashboard': '/dashboard',
      'profile.show': '/profile',
      'usuarios.index': '/usuarios',
      'module.index': '/modules',
      'logout': '/logout'
    };
    return routes[name] || '/';
  }
  
  const showingNavigationDropdown = ref(false);
  const user = ref({
    profile_photo_url: 'path/to/profile/photo.jpg',
    name: 'User Name',
    isAdmin: true
  });
  
  const router = useRouter();
  
  function logout() {
    router.push(route("logout"));
  }
  </script>
  
  <style scoped>
  .navbar {
    @apply mx-auto max-w-screen-2xl px-4;
  }
  
  .hamburger {
    @apply inline-flex justify-center items-center p-2 text-gray-400 rounded-md transition hover:bg-sky-500 focus:outline-none focus:bg-sky-500 focus:text-gray-500;
  }
  
  .botao-foto-perfil {
    @apply flex rounded-full border-2 border-transparent text-sm transition focus:border-white focus:shadow focus:outline-none;
  }
  
  .imagem-foto-perfil {
    @apply h-8 w-8 rounded-full object-cover;
  }
  </style>