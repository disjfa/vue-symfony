<template>
  <div class="container">
    <form @submit.prevent="postMovie()">
      <h1>Create movie</h1>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" placeholder="Movie name" v-model="movie.name" class="form-control">
      </div>
      <div class="form-group">
        <label for="releaseDate">Release date</label>
        <date-picker id="releaseDate" :format="customDate" v-model="movie.releaseDate"  :input-class="'form-control'"></date-picker>
      </div>
      <button type="submit" class="btn btn-primary">Add movie</button>
    </form>
  </div>
</template>

<script>
import DatePicker from 'vuejs-datepicker';
import dateFormat from 'dateformat';

export default {
  name: 'CreateMovie',
  components: {
    DatePicker
  },
  data() {
    return {
      movie: {
        name: '',
        releaseDate: new Date(),
      }
    }
  },
  mounted() {
    this.$store.dispatch('loadMovieToken');
  },
  methods: {
    customDate(dateInput) {
      const date = new Date(dateInput);
      return dateFormat(date, 'yyyy-mm-dd');
    },
    postMovie() {
      const { name, releaseDate } = this.movie;
      this.$store.dispatch('postMovie', {
        name,
        release_date: this.customDate(releaseDate),
      });
    }
  }
};
</script>
