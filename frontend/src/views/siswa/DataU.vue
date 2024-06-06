<script>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';
import Pagination from '@/components/Pagination.vue';
import Navbar from '@/components/Navbar.vue';
import { useStore } from 'vuex';


export default {
  setup() {
    const store = useStore();
    const posts = ref([]);
    const currentPage = ref(1);
    const totalPages = ref(1);

    const userRole = computed(() => store.getters.userRole);

    onMounted(async () => {
      loadData();
    });

    const loadData = () => {
      axios.get('/api/siswa')
        .then((response) => {
          posts.value = response.data.data.data;
          currentPage.value = response.data.data.current_page;
          totalPages.value = response.data.data.last_page;
        })
        .catch((error) => {
          console.error(error.response.data);
        });
    };

    const loadPage = (page) => {
      axios.get(`/api/siswa?page=${page}`)
        .then((response) => {
          posts.value = response.data.data.data;
          currentPage.value = response.data.data.current_page;
        })
        .catch((error) => {
          console.error(error.response.data);
        });
    };

    const postDelete = (id) => {
        axios.delete(`/api/siswa/${id}`)
          .then(() => {
            console.log('Post deleted successfully');
            posts.value = posts.value.filter((siswa) => siswa.id !== id);
          })
          .catch((error) => {
            console.error(error.response.data);
          });
    };

    return {
      posts,
      postDelete,
      currentPage,
      totalPages,
      loadPage,
      userRole
    };
  },
  components: {
    Pagination,
    Navbar
  },
};
</script>

<template>
  <Navbar />
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h4>DATA PENDUDUK</h4>

            <hr>

            <table class="table table-striped table-bordered mt-4">

              <thead class="thead-dark">
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Kota</th>
                  <th scope="col">Provinsi</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(siswa, index) in posts" :key="index">
                  <td>{{ siswa.nama }}</td>
                  <td>{{ siswa.alamat }}</td>
                  <td>{{ siswa.kota }}</td>
                  <td>{{ siswa.provinsi }}</td>
                  <td>{{ siswa.email }}</td>
                  <td class="text-center">
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row justify-content-center">
              <div class="col-md-3">
                <pagination :current-page="currentPage" :total-pages="totalPages" @page-change="loadPage" />
              </div>
            </div>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
body {
  background: lightgray;
}
</style>