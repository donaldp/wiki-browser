<template>
  <div class="read">
    <NavigationComponent :title="title" />

    <div class="content" v-html="content"></div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import NavigationComponent from './NavigationComponent';

export default {
  components: { NavigationComponent },
  computed: {
    ...mapGetters(['getSearch', 'getMode']),
    title: {
      get: function () {
        return this.$route.params.page.replace(/_/g, ' ');
      }
    }
  },
  mounted() {
    this.$Progress.start();

    this.getContent();
  },
  data() {
    return {
      content: ''
    }
  },
  methods: {
    /**
     * Get page content.
     *
     * @returns {void}
     */
    getContent () {
      axios
        .post('/content/', {
          page: this.$route.params.page
        })
        .then(response => {
          this.$Progress.finish();
          this.content = response.data.results;
        })
        .catch(error => {
          this.$Progress.fail();
        })
    }
  }
};
</script>
