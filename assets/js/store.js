import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    settings: {
      theme: 'light',
    },
    movies: {
      token: '',
      data: [],
    },
  },
  getters: {
    getMovieById: (state) => (id) => {
      return Object.assign({}, state.movies.data.find(movie => movie.id === id));
    }
  },
  mutations: {
    setMovies(state, movies) {
      state.movies.data = movies;
    },
    setMovieToken(state, token) {
      state.movies.token = token;
    },
  },
  actions: {
    loadMovieToken(context) {
      fetch('/api/movies/token')
        .then((result) => {
          result
            .json()
            .then((data) => {
              const { token } = data;
              context.commit('setMovieToken', token);
            });
        });
    },
    loadMovies(context) {
      fetch('/api/movies')
        .then((result) => {
          result
            .json()
            .then((data) => {
              context.commit('setMovies', data);
            });
        });
    },
    postMovie(context, movie) {
      const { token } = context.state.movies;
      const data = {
        _token: token,
        ...movie,
      };
      fetch('/api/movies', {
        method: "POST",
        body: JSON.stringify(data)
      })
        .then(result => {
          console.log(result);
        });
    },
    patchMovie(context, movie) {
      const { token } = context.state.movies;
      const {id} = movie;
      delete movie.id;
      const data = {
        _token: token,
        ...movie,
      };
      fetch(`/api/movies/${id}`, {
        method: "PATCH",
        body: JSON.stringify(data)
      })
        .then(result => {
          console.log(result);
        });
    },
  },
});
