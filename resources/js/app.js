/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import vueStore from './store';
import VueProgressBar from 'vue-progressbar';

Vue.use(Vuex);
Vue.use(VueRouter);

const store = new Vuex.Store(
  vueStore
);

Vue.use(VueProgressBar, {
  color: '#1a0dab',
  failedColor: 'red',
  height: '2px'
});

import Home from './components/HomeComponent';
import Read from './components/ReadComponent';
import Browse from './components/BrowseComponent';

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/read/:page',
      name: 'read',
      component: Read,
    },
    {
      path: '/browse',
      name: 'browse',
      component: Browse,
    },
  ],
});

const app = new Vue({
  el: '#app',
  router,
  store
});
