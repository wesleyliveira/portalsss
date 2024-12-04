<template>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
              <p>Bem-vindo, {{ user.name }}</p>
              <button @click="logout" class="btn btn-danger">Logout</button>
            </div>
          </div>
        </div>
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
        this.$router.push('/');
      }
    },
    methods: {
      async logout() {
        try {
          await axios.post('/logout');
          localStorage.removeItem('auth_token');
          this.$router.push('/');
        } catch (error) {
          console.error('Erro ao fazer logout:', error);
        }
      }
    }
  };
  </script>