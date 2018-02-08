<template>
<div class="form-group">
    <label :for="name">{{ name }}</label>
    <input type="text"
      :name="name" class="form-control"
      :id="name"
      @input="onChange"
      :value="value" />
</div>

</template>

<script>

import { EventBus } from '../EventBus';

export default {
  props: {
    item: {
      type: Object,
    },
  },

  components: {
  },

  data() {
    let name, value;
    for (let key in this.item) {
      name = key;
      value = this.item[key];
    }

    return {
      name,
      value,
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
    onChange($e) {
      EventBus.$emit('inputChange', {
        [this.name] : $e.target.value,
      });
    },
  },

  computed: {
  },
}
</script>
