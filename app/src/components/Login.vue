<template>
  <div class="login-container">
    <!-- Header -->
    <header class="header">
      <h1>	
        PORTAL SISTEMAS | SERIN</h1>
    </header>

    <div class="login-box">
      <div>
        <a href="/" class="logo-link">Bem-Vindo(a)!</a>
      </div>

      <form @submit.prevent="login">
        <!-- Campo Username -->
        <div class="form-group">
          <input
            v-model="username"
            type="text"
            class="form-control"
            id="username"
            placeholder="Digite seu usuário"
            required
          />
        </div>

        <!-- Campo Password -->
        <div class="form-group password-group">
          <input
            v-model="password"
            :type="passwordVisible ? 'text' : 'password'"
            class="form-control"
            id="password"
            placeholder="Digite sua Senha"
            required
          />
          <!-- Botão para visualizar/ocultar senha -->
          <button
            type="button"
            class="btn-show-password"
            @click="togglePassword"
          >
            <i :class="passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
          </button>
        </div>

        <!-- Mensagem de erro (caso algum campo não esteja preenchido) -->
        <div v-if="errorMessage" class="error-message">
          <p>{{ errorMessage }}</p>
        </div>

        <!-- Checkbox Remember Me -->
        <div class="form-group remember-me">
          <label>
            <input type="checkbox" v-model="rememberMe" /> Lembrar-me
          </label>
        </div>

        <!-- Botão de Login -->
        <button type="submit" class="btn-login">Entrar</button>
        
        <!-- Link Esqueceu a Senha -->
        <div class="forgot-password-link">
          <a href="#">Esqueceu a senha?</a>
        </div>
      </form>
    </div>

    <!-- Rodapé -->
    <footer class="footer">
      <p>&copy; Copyright 2012 - 2024 - SERIN - Todos os Direitos Reservados
        SERIN - 3ª Avenida, nº 390, Plataforma IV, 3º andar - Centro Administrativo da Bahia CEP 41.745-005 - Salvador - Bahia - Brasil</p>
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: "",
      password: "",
      passwordVisible: false, // Controla visibilidade da senha
      rememberMe: false,
      errorMessage: "", // Armazenar mensagem de erro
    };
  },
  methods: {
    login() {
      // Verificação de campos vazios
      if (!this.username || !this.password) {
        this.errorMessage = "Por favor, preencha todos os campos."; // Mensagem de erro
      } else {
        this.errorMessage = ""; // Limpa a mensagem de erro

        // Lógica de login (substitua com a lógica real)
        console.log({
          username: this.username,
          password: this.password,
          rememberMe: this.rememberMe,
        });

        // Aqui você pode adicionar a lógica para enviar o formulário ao servidor, como uma requisição API
      }
    },
    togglePassword() {
      // Alterna entre mostrar/ocultar senha
      this.passwordVisible = !this.passwordVisible;
    },
  },
};
</script>

<style scoped lang="scss">
@import '@/assets/styles/variables'; 
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap'); /* Importando a fonte Poppins */

/* Fundo com imagem personalizada */
.login-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-image: url('@/assets/images/background-login.png'); 
  background-size: contain; 
  background-repeat: no-repeat;
  background-position: center;
  color: #fff;
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}

/* Header */
.header {
  width: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  text-align: center;
  padding: 20px 0;
  font-size: 1.5rem;
  font-weight: 600;
  position: absolute;
  top: 0;
  left: 0;
}

/* Caixa do formulário */
.login-box {
  background-color: rgba(255, 255, 255, 0.788); /* Fundo branco com opacidade leve */
  padding: 40px;
  border-radius: 15px;
  width: 350px;
  text-align: center;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.2); /* Contorno para melhorar contraste */
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}

/* Título logo SIS */
.logo-link {
  font-size: 1.5rem;
  text-decoration: none; /* Remover sublinhado */
  font-weight: 700; /* Peso mais grosso */
  color: $azul-marinho;
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}
.logo-link:hover {
  color: $azul-forte; /* Alterar a cor ao passar o mouse */
}

/* Campos do formulário */
.form-group {
  margin-bottom: 20px;
  position: relative;
}
.form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  background: rgba(255, 255, 255, 0.082);
  color: $preto ;
  font-size: 1.1rem; /* Fonte um pouco maior */
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}
.form-control::placeholder {
  color: $azul-marinho;
  font-size: 1.1rem; /* Fonte um pouco maior */
}
.form-control:focus {
  outline: none;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid $azul-marinho;
}

/* Botão de visualizar senha */
.password-group {
  position: relative;
}
.btn-show-password {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  border: none;
  background: none;
  color: $azul-marinho;
  cursor: pointer;
  font-size: 1.2rem;
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}
.btn-show-password:hover {
  color: $azul-marinho;
}

/* Botão de Login */
.btn-login {
  width: 100%;
  padding: 05px 15px;
  border: none;
  border-radius: 25px;
  background-color: $azul-marinho;
  color: $branco;
  font-size: 1.2rem;
  font-weight: 700; /* Peso mais grosso */
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}
.btn-login:hover {
  background-color: $azul-forte;
}

/* Checkbox Remember Me */
.remember-me {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  font-size: 0.9rem;
  color: $azul-marinho;
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}
.remember-me input {
  margin-right: 5px;
}

/* Link Esqueceu a senha */
.forgot-password-link {
  margin-top: 20px;
  font-size: 1.1rem; /* Fonte um pouco maior */
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}
.forgot-password-link a {
  color: $azul-marinho;
  text-decoration: none;
}
.forgot-password-link a:hover {
  color: $azul-forte; /* Troca a cor ao passar o mouse */
}
.forgot-password-link a:focus {
  outline: none;
}

/* Estilo para a mensagem de erro */
.error-message {
  color: red;
  font-size: 1rem;
  margin-top: 10px;
}
/* Estilo do Rodapé */
.footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  text-align: center;
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  padding: 10px;
  font-size: 0.9rem;
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}

.footer a {
  color: #fff;
  text-decoration: none;
  margin-left: 5px;
}
.footer a:hover {
  color: #ff5733;
}

</style>
