import { createStore } from 'vuex';

export default createStore({
  state: {
    user: {
      role: 'guest',
      username: null,
    },
    token: null,
  },
  mutations: {
    setUserRole(state, role) {
      state.user.role = role;
    },
    setToken(state, token) {
      state.token = token;
    },
    setUsername(state, username) {
      state.user.username = username;
    },
    logout(state) {
      state.user.role = 'guest';
      state.user.username = null;
      state.token = null;
    },
  },
  actions: {
    logout({ commit }) {
      commit('logout');
    },
  },
  getters: {
    userRole: (state) => state.user.role,
    isAuthenticated: (state) => !!state.token,
    authToken: (state) => state.token,
    username: (state) => state.user.username,
  },
});
