<template>
  <div class="read">
    <NavigationComponent :title="title" />

    <iframe
      :src="getSearch"
      v-on:load="pageLoaded"
      class="content"
      id='frame'
    ></iframe>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import NavigationComponent from './NavigationComponent';

export default {
  components: { NavigationComponent },
  computed: {
    ...mapGetters(['getSearch']),
  },
  mounted() {
    this.$Progress.start();

    if (!this.getSearch && this.$route.query.q) {
      this.$store.dispatch("setSearch", this.$route.query.q);
    }
  },
  data() {
    return {
      title: ''
    }
  },
  methods: {
    /**
     * Complete the progress loader.
     */
    pageLoaded(e) {
      this.$Progress.finish();
    }
  }
};
</script>
