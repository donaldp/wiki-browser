export default {
  /**
   * Set mode.
   */
  setMode: ({commit}, payload) => {
    commit('setMode', payload)
  },

  /**
   * Set search.
   */
  setSearch: ({commit}, payload) => {
    commit('setSearch', payload)
  },

  /**
   * Set loading value.
   */
  setLoading: ({commit}, payload) => {
    commit('setLoading', payload)
  },

  /**
   * Find wikipedia results.
   */
  find: ({commit}, payload) => {
    commit('activateLoader', true)

    axios
      .post('/search', {
        search: payload
      })
      .then(response => {
        commit('setResults', response.data.results)
        commit('activateLoader', false)
      })
  },
}
