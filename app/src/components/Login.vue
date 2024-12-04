<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">
            <!-- Exibe a mensagem de erro global -->
            <div v-if="error" class="alert alert-danger">
              {{ error }}
            </div>

            <section class="login-section">
              <form @submit.prevent="login">
                <!-- Erro de email -->
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    v-model="email"
                    type="email"
                    class="form-control"
                    id="email"
                    required
                  />
                  <div v-if="errors.email" class="text-danger mt-2">{{ errors.email }}</div>
                </div>
                <!-- Erro de senha -->
                <div class="form-group">
                  <label for="password">Senha</label>
                  <input
                    v-model="password"
                    type="password"
                    class="form-control"
                    id="password"
                    required
                  />
                  <div v-if="errors.password" class="text-danger mt-2">{{ errors.password }}</div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Login</button>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../axios";
import { useRouter } from "vue-router";

export default {
  data() {
    return {
      email: "",
      password: "",
      error: "", // Mensagem de erro global
      errors: {}, // Mensagens de erro específicas para campos
    };
  },
  mounted() {
    // Verifica se o usuário já está autenticado
    const token = localStorage.getItem("auth_token");
    if (token) {
      this.$router.push("/dashboard"); // Redireciona para o dashboard se estiver autenticado
    }
  },
  methods: {
    async login() {
      // Limpa os erros anteriores
      this.errors = {};
      this.error = "";

      try {
        // Chamada da API para fazer o login
        const response = await axios.post(
          "/login",
          {
            email: this.email,
            password: this.password,
          },
          {
            withCredentials: true, // Permite que os cookies sejam enviados
          }
        );
        localStorage.setItem("auth_token", response.data.token);
        this.$router.push("/dashboard"); // Redireciona para o dashboard após login
      } catch (error) {
        // Se a resposta do erro for de validação
        if (error.response) {
          if (error.response.status === 422) {
            // Exibe os erros de validação (se houver)
            this.errors = error.response.data.errors;
          } else if (error.response.status === 401) {
            this.error = "As credenciais fornecidas são inválidas.";
          } else {
            this.error = "Erro desconhecido. Tente novamente.";
          }
        } else {
          // Caso de erro de rede ou falta de resposta da API
          this.error = "Erro de conexão. Tente novamente mais tarde.";
        }
      }
    },
  },
};
</script>

<style scoped>
/* Estilos para o formulário com imagem de fundo */

/* Certifique-se de substituir a URL da imagem pelo caminho correto */
.login-section {
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url('/path/to/your/image.jpg'); /* Imagem de fundo */
  background-size: cover;
  background-position: center;
  padding: 20px;
  border-radius: 20px;
  border: none;
  height: 100vh; /* Para preencher toda a altura da tela */
}

/* Estilo para os campos de entrada */
.form-group {
  position: relative;
  margin: 20px 0;
  width: 100%;
}

.form-group label {
  position: absolute;
  top: 10px;
  left: 10px;
  color: #ff7070;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.form-group input {
  width: 100%;
  padding: 12px 15px;
  border: 1px solid rgba(110, 0, 0, 0.6);
  border-radius: 10px;
  background-color: rgba(26, 26, 26, 0.3); /* Fundo levemente opaco */
  color: #000000;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.form-group input:focus {
  outline: none;
  border-color: #ff6f61;
  background-color: rgba(255, 255, 255, 0.5); /* Fundo mais claro no foco */
}

.form-group input:focus + label,
.form-group input:valid + label {
  top: -10px;
  font-size: 0.8rem;
}

/* Estilo do botão de login */
button {
  width: 100%;
  padding: 12px;
  border-radius: 25px;
  border: none;
  background-color: #ff6f61;
  color: #ffffff;
  font-size: 1.2rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

button:hover {
  background-color: #ff5a47;
}
</style>
