<template>
  <div class="container">
    <form @submit.prevent="patchMovie()" v-if="movie">
      <h1>Edit {{movie.name}}</h1>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" placeholder="Movie name" v-model="movie.name" class="form-control">
      </div>
      <div class="form-group">
        <label for="releaseDate">Release date</label>
        <date-picker id="releaseDate" :format="customDate" v-model="movie.releaseDate" :input-class="'form-control'"></date-picker>
      </div>
      <button type="submit" class="btn btn-primary">Update movie</button>
    </form>
  </div>
</template>

<script>
import DatePicker from 'vuejs-datepicker';
import dateFormat from 'dateformat';

export default {
  name: 'EditMovie',
  components: {
    DatePicker
  },
  mounted() {
    this.$store.dispatch('loadMovieToken');
  },
  computed: {
    // arrow functions can make the code very succinct!
    movie() {
      const { id } = this.$route.params;
      const movie = this.$store.getters.getMovieById(id);
      if (movie.releaseDate) {
        movie.releaseDate = this.customDate(movie.releaseDate.date);
        return movie;
      }
    },
  },
  methods: {
    customDate(dateInput) {
      const date = new Date(dateInput);
      return dateFormat(date, 'yyyy-mm-dd');
    },
    patchMovie() {
      const { id, name, releaseDate } = this.movie;
      this.$store.dispatch('patchMovie', {
        id,
        name,
        release_date: this.customDate(releaseDate),
      });
    }
  }
};
</script>
