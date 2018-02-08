<template>
<div class="form-group">
  <label><a href="#"
    @click.prevent="open = !open">
    {{ label }}</a>
  </label>
  <div v-show="open">
    <form-elem v-for="(item, key) in items"
      :item="item"
      :key="key">
    </form-elem>
  </div>
</div>

</template>

<script>

import FormElem from './FormElem';

export default {
  props: {
    items: {
      type: Array,
      default: () => {},
    },
    label: {
      type: String,
    },
  },

  components: {
    FormElem,
  },

  data() {
    return {
      open: false,
    };
  },

  mounted() {
  },

  beforeDestroy() {
  },

  methods: {
    findItems(group) {
      return this.items.filter((item) => item.includes(group));
    },
  },

  computed: {
  },
}
</script>
