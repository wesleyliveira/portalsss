<script setup>
import { RouterView } from 'vue-router';
import Navbar from './components/NavBar.vue';
</script>

<template>
  <div>
    <Navbar />
    <div class="container mt-4">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>
.container {
  margin-top: 20px;
}
</style>