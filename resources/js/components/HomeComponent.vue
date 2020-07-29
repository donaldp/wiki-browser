<template>
  <div class="container">
    <div class="row">
      <div :class="headerClass">
        <span class="logo" :style="invalid ? 'color: red': ''">
          <p>browse</p> <i class='fa fa-globe'></i>
        </span>
        <div class="input-group search">
          <div class="input-group-btn">
            <button
              type="button"
              :title="getMode"
              class="btn btn-default dropdown-toggle"
              style="width: 33px;"
              data-toggle="dropdown"
            >
              <i :class="getClass" style="width: 23px;"></i>
            </button>
            <ul class="dropdown-menu">
              <li @click="updateMode('Wikipedia')">Wikipedia</li>
              <li @click="updateMode('Browse')">Browse</li>
            </ul>
          </div>
          <input type="text" class="form-control" v-on:keyup.enter="submit" v-model="searchInput" :placeholder="getPlaceholder" :disabled="isLoading"/>
          <span class="input-group-btn">
            <button id="btn-search" @click="submit()" class="btn btn-default" :disabled="isLoading || invalid">
              <span :class="submitClass"></span>
            </button>
          </span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <ul class="results">
          <li class="article" v-for="(result, key) in getResults" :key="key">
            <template v-if="result !== 'empty'">
              <router-link :to="'/read/' + result.page">
                <p class='url'>{{ result.url }}</p>
                <h3 class='title'>{{ result.title }}</h3>
              </router-link>

              <p class='summary ellipsis' v-html="result.summary"></p>
            </template>

            <template v-else>
              <h5>Your search did not match any wikipedia articles.</h5>

              Suggestions:

              <ul>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>
              </ul>
            </template>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";

export default {
  computed: {
    ...mapState(['search']),
    ...mapGetters(["getMode", "getSearch", "getResults", "getClass", "getPlaceholder", "isLoading"]),
    searchInput: {
      set: function (value) {
        if (this.getMode == 'wikipedia') {
          return this.$store.dispatch("setSearch", value);
        }

        if (/^(http|https):\/\/[^ "]+$/.test(value)) {
          this.invalid = false;
          return this.$store.dispatch("setSearch", value);
        }

        this.invalid = true;
      },
      get: function() {
        return this.getSearch;
      }
    },
    submitClass: {
      get: function () {
        return this.isLoading ? 'fa fa-spinner fa-spin' : 'fa fa-search';
      }
    },
    headerClass: {
      get: function () {
        return this.getResults.length > 0 ? 'col-md-8 header has-results' : 'col-md-6 header';
      }
    }
  },
  data() {
    return {
      invalid: false,
    }
  },
  methods: {
    /**
     * Update mode.
     *
     * @param {String} mode
     * @returns {void}
     */
    updateMode(mode) {
      this.$store.dispatch("setSearch", '');
      this.$store.dispatch("setMode", mode);
    },

    /**
     * Submit search / browse.
     *
     * @returns {void}
     */
    submit() {
      if (this.getMode == 'wikipedia') {
        return this.$store.dispatch("find", this.getSearch);
      }

      this.$router.push({ name: 'browse', query: { q: this.getSearch } });
    }
  }
};
</script>
