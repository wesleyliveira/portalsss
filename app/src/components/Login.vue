<template>
  <div class="login-container">
    <!-- Header -->
    <div class="top-line"></div>
    <header class="header">
      <img src="/banner-portal.png" alt="Logo" class="logo">
      <h1>Portal Sistemas | SERIN</h1>
    </header>

    <div class="login-box">
      <div>
        <a href="/" class="logo-link">Bem-Vindo(a)!</a>
      </div>

      <form @submit.prevent="login">
        <!-- Campo Username -->
        <div class="form-group">
          <input
            v-model="email"
            type="email"
            class="form-control"
            id="email"
            placeholder="Digite seu e-mail"
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
            placeholder="Digite sua senha"
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
        <div v-if="error" class="error-message">
          <p>{{ error }}</p>
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
      <div class="bottom-line"></div> <!-- Linha adicional no rodapé -->
      <p>&copy; Copyright 2012 - 2024 - SERIN - Todos os Direitos Reservados
        SERIN - 3ª Avenida, nº 390, Plataforma IV, 3º andar - Centro Administrativo da Bahia CEP 41.745-005 - Salvador - Bahia - Brasil</p>
    </footer>
  </div>

</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      email: "",
      password: "",
      passwordVisible: false, // Controla visibilidade da senha
      error: "", // Mensagem de erro global
      errors: {}, // Mensagens de erro específicas para campos
      rememberMe: false,
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

      // Verificação de campos vazios
      if (!this.email || !this.password) {
        this.error = "Por favor, preencha todos os campos."; // Mensagem de erro global
        return;
      }

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
@import '@fortawesome/fontawesome-free/css/all.min.css';



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

/* Linha acima do Header */
.top-line {
  width: 100%;
  height: 15px; /* Fina */
  background-color: #003366; /* Azul marinho */
  position: fixed; /* Fixa no topo */
  top: 0;
  left: 0;
  z-index: 999; /* Fica acima do header */
}
/* Header */
.header {
  width: 100%;
  background-color: #F4F7FA; /* Cor de fundo similar à imagem */
  color: #666666; /* Cor do texto */
  font-size: 1.5rem;
  font-weight: 600;
  display: flex;
  justify-content: space-between; /* Alinha os itens */
  align-items: center; /* Alinha verticalmente */
  padding: 10px 20px;
  position: fixed;
  top: 10px;
  left: 0;
  z-index: 1000;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

.logo {
  width: 200px; /* Tamanho da imagem */
}

/* Personalizando o estilo do h1 */
h1 {
  flex-grow: 1; /* Para manter a centralização */
  text-align: center; /* Centraliza o texto */
  margin: 0; /* Remove qualquer margem padrão */
  font-size: 2rem; /* Tamanho maior para o título */
  color: #696969; /* Cor mais escura para o texto */
  font-family: 'Orbitron', sans-serif; /* Fonte Orbitron */
  letter-spacing: 2px; /* Espaçamento entre as letras */
  font-weight: 700; /* Peso mais forte para o título */
  padding: 0 20px; /* Adiciona um pouco de espaçamento nas laterais */
  text-shadow: 
    2px 2px 4px rgba(19, 19, 19, 0.3), /* Sombra mais forte com maior deslocamento */
    -2px -2px 4px rgba(0, 0, 0, 0.2), /* Sombra no lado oposto para criar um efeito mais volumoso */
    3px 3px 6px rgba(0, 0, 0, 0.15); /* Sombra mais difusa e maior para dar mais profundidade */
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
  text-align: center; /* Centraliza o texto */
  display: block; /* Garante que o elemento ocupe toda a largura disponível */
  margin-bottom: 20px; /* Espaço inferior */
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
  color: $place-holder; /* Cor do placeholder */
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
  font-size: 1rem;
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
  font-size: 1rem; /* Fonte um pouco maior */
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

  color: $branco;
  padding: 1px;
  font-size: 0.9rem;
  font-family: 'Poppins', sans-serif; /* Aplica a fonte Poppins */
}
/* Linha abaixo do Rodapé */
.bottom-line {
  width: 100%;
  height: 12px; /* Fina */
  background-color: #003366; /* Azul marinho */
  position: fixed; /* Fixa na parte inferior */
  bottom: 0;
  left: 0;
  z-index: 999; /* Fica acima do rodapé */
}


.footer a {
  color: #fff;
  text-decoration: none;
  margin-left: 5px;
  
}
.footer a:hover {
  color: #ff5733;
}

.html, body {
  overflow: hidden;
  height: 100%;
}


</style>
