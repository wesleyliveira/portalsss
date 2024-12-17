<template>
           <div class="min-h-screen print:min-h-fit print:bg-white bg-gray-50">

<Navbar/>

<!-- Page Heading -->
<header class="print:hidden bg-white shadow-sm" v-if="$slots.header">
    <div class="mx-auto max-w-screen-2xl px-4 py-4">
        <div class="grid grid-cols-1 sm:grid-cols-6">
            <div class="flex items-center sm:col-span-3">
                <h2 class="text-xl font-bold leading-tight text-gray-800">
                    <slot name="header"></slot>
                </h2>
            </div>
            <div class="flex items-center gap-2 leading-tight sm:col-span-3 sm:text-right md:justify-end">
                <slot name="header-area"></slot>
            </div>
        </div>
    </div>
</header>

<!-- Page Content -->
<main class="print:py-0 py-4">
    <slot></slot>
</main>

</div>

<div class="print:hidden bg-black/90 p-2">
<div class="mx-auto max-w-screen-2xl p-2 md:space-x-3 md:flex md:items-center">
    <img src="/logo_mono.png" alt="Logo do Governo do Estado da Bahia" class="mx-auto mb-2 h-24 md:mx-0 md:mb-0">
    <button @click="logout" class="button">Sair</button>
</div>
</div>


</template>
  
<script>
import axios from '../axios';

export default {
  data() {
    return {
      user: {}
    };
  },
  async created() {
    try {
      const response = await axios.get('/user');
      this.user = response.data;
    } catch (error) {
      console.error('Erro ao obter usuário:', error);
      if (error.response && error.response.status === 401) {
        localStorage.removeItem('auth_token');
        this.$router.push('/');
      }
    }
  },
  methods: {
    async logout() {
      try {
        await axios.post('/logout');
        localStorage.removeItem('auth_token');
        this.$router.push('/');
      } catch (error) {
        console.error('Erro ao efetuar logout:', error);
      }
    }
  }
};
</script>

  <style>

  .button{
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
  </style>
