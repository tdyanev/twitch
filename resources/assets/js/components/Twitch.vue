<template>
<div class="twitch">
  <div class="container-fluid main">
    <div class="row">
      <div class="col-xs-9">
        <panel v-if="live.youtubeRunning"
          id="display"
          :title="live.messageBreak">
          <div class="video-wrapper">
          <iframe id="ytplayer" type="text/html"
          :src="youtubeSrc"
          frameborder="0"></iframe>
          </div>
        </panel>
        <panel :title="live.messageTitle" id="display" v-else>
        </panel>
      </div>

      <div class="col-xs-3 sidebar">
        <panel :title="live.cameraText"
          :style="{ height: live.cameraHeight, }"
          id="camera"
          v-if="live.cameraHeight">
          <img :src="live.cameraImageURL" v-if="live.cameraImageURL" />
          </panel>

        <panel :title="labels.info">
          <list :items="info"></list>
        </panel>

        <panel :title="labels.chat">
          <iframe :src="live.chatURL" width="100%"
            v-if="live.chatHeight"
            :height="live.chatHeight">
          </iframe>
        </panel>


      </div>
    </div>
  </div>
</div>

</template>

<script>
import Pusher from 'pusher-js';
import Panel from './Panel';
import List from './List';

export default {
  props: {
    items: {
      type: Object,
      default: () => {},
    },
    labels: {
      type: Object,
      default: () => {},
    },
    banners: {
      type: Array,
    },
  },

  components: {
    Panel,
    List,
  },

  data() {
    const live = {...this.items};

    return {
      live,
      duration: 0,
      localTime: this.getLocalTime(),
    };
  },

  mounted() {
    this.pusher = new Pusher('566b8b10a9f3c0f4685d', {
      cluster: 'eu',
      encrypted: true
    });

    this.interval = setInterval(() => {
      this.duration++;
      this.localTime = this.getLocalTime();
    }, 60e3);


    let channel = this.pusher.subscribe('my-channel');


    channel.bind('my-event', data => {
      for (let key in data) {
        if (this.live.hasOwnProperty(key)) {
          this.$set(this.live, key, data[key]);
        }
      }
    });

  },

  beforeDestroy() {
    clearInterval(this.interval);
  },

  methods: {
    toUsd(value) {
      return `$${value}`;
    },

    formatMinutes(m) {
      var date = new Date(null);
      date.setMinutes(m); // specify value for SECONDS here
      return date.toISOString().substr(11, 5);
    },

    addZero(v) {
      return v < 10 ? '0' + v: v;
    },

    getLocalTime() {
      return new Date().toTimeString().substr(0, 5);
    },
  },

  computed: {
    balance() {
      return {
        'Инвестиции' : this.toUsd(this.live.invested),
        'Печалби' : this.toUsd(this.live.earned),
        'Общо' : this.toUsd(this.live.earned - this.live.invested),
      }
    },

    info() {
      return {
        [this.labels.delay] : this.live.delay,
        [this.labels.live] : this.formatMinutes(this.duration),
        [this.labels.localTime] : this.localTime,
      };
    },

    youtubeSrc() {
      return `https://www.youtube.com/embed/${
        this.live.youtubeURL}?start=${
        this.live.youtubeStart}&autoplay=1&controls=0&output=embed`;
    },
  },
}
</script>
