export default {
  getMode: (state) => state.mode,
  getSearch: (state) => state.search,
  getResults: (state) => state.results,
  getClass: (state) => state.mode === 'wikipedia' ? 'fa fa-wikipedia-w' : 'fa fa-globe',
  getPlaceholder: (state) => state.mode === 'wikipedia' ? 'Search wikipedia' : 'Enter URL',
  isLoading: (state) => state.loading,
}
