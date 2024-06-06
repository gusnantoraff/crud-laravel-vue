<template>
  <div class="login-container">
    <h2>Login</h2>
    <form @submit.prevent="submitLogin">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="username" id="username" v-model="form.username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="form.password" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <br>
    <p>Belum punya akun? <router-link to="/register">Daftar disini!</router-link></p>
  </div>
</template>

<script>
import { reactive, toRefs } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

export default {
  setup() {
    const router = useRouter();
    const store = useStore();

    const form = reactive({
      username: '',
      password: '',
    });

    const { username, password } = toRefs(form);

    const submitLogin = async () => {
      try {
        const response = await axios.post('/api/login', {
          username: username.value,
          password: password.value,
        });
        const token = response.data.token;
        const userRole = response.data.data.role;

        store.commit('setUserRole', userRole);
        store.commit('setToken', token);
        store.commit('setUsername', username);

        console.log('role:', userRole);
        console.log('token:', token);

        console.log('Login successful');

        if (userRole === 'admin') {
          router.push('/dataA');
        } else {
          router.push('/dataU');
        }
      } catch (error) {
        console.error('Login failed', error);
        alert('Invalid username or password. Please try again.');
      }
    };

    return {
      form,
      submitLogin,
    };
  },
};

</script>

<style scoped>
.login-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

button {
  background-color: #4caf50;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>
