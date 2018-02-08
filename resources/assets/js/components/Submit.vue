<template>
<div class="form-group">
  <button @click.prevent="submit" type="submit" class="btn btn-success">
    <slot></slot>
  </button>
  <span class="status" v-if="showStatus">
    {{ statusMsg }}
  </span>
</div>

</template>

<script>

import { EventBus } from '../EventBus';

export default {
  props: {
    fields: {
      type: Object,
    },
    url: {
      type: String,
    },
  },

  components: {
  },

  data() {

    return {
      params: { ...this.fields },
      showStatus: false,
      statusMsg: '',
    };
  },

  mounted() {
    EventBus.$on('inputChange',
      obj => this.params = Object.assign(this.params, obj)
    );
  },

  beforeDestroy() {
  },

  methods: {
    submit() {
      axios.post(this.url, this.params)
        .then(r => {
          this.statusMsg = r.status === 200 ? 'Data updated' :
            'There was an error';
          this.showStatus = true;

          setTimeout(() => this.showStatus = false, 5e3);

        });
    },
  },

  computed: {
  },
}
</script>
