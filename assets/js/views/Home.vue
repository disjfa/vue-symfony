<template>
  <div class="container">
    <h1>Home</h1>
    <div v-for="movie in movies" :key="movie.id">
      <h3>
        <router-link :to="{name: 'movie-edit', params: {id: movie.id}}">
          {{movie.name}}
        </router-link>
      </h3>
      <the-date :date="movie.releaseDate"></the-date>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import TheDate from './../components/TheDate.vue'

export default {
  name: 'home',
  components: {
    TheDate
  },
  mounted() {
    this.$store.dispatch('loadMovies');
  },
  computed: mapState({
    // arrow functions can make the code very succinct!
    movies: state => state.movies.data,
  }),
};
</script>
