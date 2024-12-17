import axios from 'axios';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

// Certifique-se de que o axios envie cookies ou cabeçalhos de autenticação
axios.defaults.withCredentials = true;

axios.interceptors.request.use(config => {
  const token = localStorage.getItem('auth_token');
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});

export default axios;
