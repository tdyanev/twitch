<template>
<ul class="list-group">
  <li class="list-group-item" v-for="(val, key) in items">
      <span class="badge">{{ val }}</span>
      {{ key }}
  </li>
</ul>
</template>

<script>

export default {
  props: {
    items: {
      type: Object,
      default: () => {},
    }
  },

}
</script>
