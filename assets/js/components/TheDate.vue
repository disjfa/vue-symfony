<template>
  <div>{{aa}}</div>
</template>
<script>
import dateFormat from 'dateformat';

export default {
  name: 'TheDate',
  props: {
    date: Object,
  },
  computed: {
    aa() {
      const { date } = this.date;
      return dateFormat(date, 'yyyy-mm-dd');
    }
  }
}
</script>
