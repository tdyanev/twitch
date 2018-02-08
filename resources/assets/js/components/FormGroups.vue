<template>
<div>
  <group v-for="(group, key) in groups"
    :items="findItems(group)"
    :label="group"
    :key="key">
  </group>
</div>

</template>

<script>

import Group from './Group';

export default {
  props: {
    items: {
      type: Object,
      default: () => {},
    },
    groups: {
      type: Array,
      default: () => [],
    },
  },

  components: {
    Group,
  },

  data() {
    return {
    };
  },

  mounted() {
    //console.log(this.items);
  },

  beforeDestroy() {
  },

  methods: {
    findItems(group) {
      const items = [];

      for(let item in this.items) {
        if (item.includes(group)) {
          items.push({
            [item]: this.items[item],
          });
        }
      }
      return items;
    },
  },

  computed: {
  },
}
</script>
