<template>
<div class="banner-rotator">
  <img ref="image" :src="current" />
</div>
</template>

<script>

export default {
  props: {
    items: {
      type: Array,
      default: () => [],
    },
    time: {
      type: Number,
      default: 30e3,
    },
  },


  data() {
    return {
      currentId: 0,
    };
  },

  mounted() {
    if (this.items.length > 1) {
      this.tick();
    }
  },

  methods: {
    tick() {
      this.timeout = setTimeout(() => this.changeImage(), this.time);
    },

    changeImage() {

      console.log(this.$refs);
      let $image = $(this.$refs.image);

      $image.fadeOut('slow', () => {
        this.currentId = (this.currentId + 1) % this.items.length;

  //      $(this.$refs.image).fadeIn('slow', this.tick);
        $image.fadeIn('slow', this.tick);
      });

    }
  },

  computed: {
    current() {
      return this.items[this.currentId];
    },
  },
}
</script>
