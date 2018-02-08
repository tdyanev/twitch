<template>
<div class="panel panel-primary">
  <div class="panel-heading" v-if="title">
    <div class="panel-title">{{ title }}</div>
  </div>
  <div class="panel-body"><slot></slot>
  </div>
</div>
</template>

<script>

export default {
  props: {
    title: {
      type: String,
      default: '',
    }
  },

}
</script>
