<template>
  <div class="landing-page text-center">
    <div class="landing-content">
      <h1 class="display-4">Selamat Datang</h1>
      <p class="lead">Silakan login atau daftar untuk mengakses Data Penduduk!</p>
      <router-link to="/login" class="btn btn-primary btn-lg">Login</router-link>
      <router-link to="/register" class="btn btn-success btn-lg">Daftar</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LandingPage',
}
</script>

<style scoped>
.landing-page {
  text-align: center;
  margin: 50px;
}

.landing-content {
  border: 2px solid #ddd;
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
}

h1 {
  font-size: 2em;
  margin-bottom: 20px;
}

p {
  font-size: 1.2em;
  margin-bottom: 30px;
}

router-link {
  margin-right: 10px;
  text-decoration: none;
  font-size: 1.2em;
}
</style>
