export default {
  /**
   * Set mode.
   */
  setMode: (state, payload) => {
    state.mode = payload.toLowerCase();
  },

  /**
   * Set search.
   */
  setSearch: (state, payload) => {
    state.search = payload;
  },

  /**
   * Set wikipedia results.
   */
  setResults: (state, payload) => {
    state.results = payload;
  },

  /**
   * Set loading value.
   */
  activateLoader: (state, payload) => {
    state.loading = payload;
  }
}
