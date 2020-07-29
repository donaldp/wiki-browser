<template>
  <header class="navigation">
    <nav>
      <router-link to="/">
        <button>
          <i class='fa fa-angle-left'></i>
        </button>
      </router-link>

      <p class="title">{{ title }}</p>
    </nav>
  </header>
</template>

<script>
export default {
  props: ['title']
}
</script>