<template>
  <div class="register-container">
    <h2>Register</h2>
    <form @submit.prevent="submitRegister">
      <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" id="name" v-model="form.name" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="form.email" required>
      </div>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="form.username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="form.password" required>
      </div>
      <button type="submit">Register</button>
    </form>
    <br>
    <p>Sudah punya akun? <router-link to="/login">Login disini!</router-link></p>
  </div>
</template>

<script>
import { reactive, toRefs } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const router = useRouter();

    const form = reactive({
      name: '',
      email: '',
      username: '',
      password: '',
    });

    const { name, email, username, password } = toRefs(form);

    const submitRegister = async () => {
      try {
        await axios.post('/api/register', {
          name: name.value,
          email: email.value,
          username: username.value,
          password: password.value,
        });

        router.push('/login');
      } catch (error) {
        console.error('Registration failed', error);
      }
    };

    return {
      form,
      submitRegister,
    };
  },
};
</script>

<style scoped>
.register-container {
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
